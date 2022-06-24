<?php

namespace App\Service;


use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class CartService
 * @package App\Service
 * @author Fudio101
 * Date: 05/05/2022
 * Time: 12:03
 */
class CartService
{
    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function getCart(): mixed
    {
        return session()->get('cart', []);
    }

    /**
     * @param  int  $id
     * @param  int  $quantity
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function addCart(int $id, int $quantity): bool
    {
        $cart = $this->getCart();
        foreach ($cart as $key => $item) {
            if (((int) $item[0]) === $id) {
                $item[1] += $quantity;
                $cart[$key] = $item;
//                dd($cart[$key]);
                session()->put('cart', $cart);
                return true;
            }
        }
        $cart[] = [$id, $quantity];
        session()->put('cart', $cart);
        return true;
    }

    /**
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function getTotal(): int
    {
        $cart = $this->getCart();
        if (!$cart) {
            return 0;
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += Product::query()->find($item[0])->first()->price;
        }
        return $total;
    }

    /**
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function count(): int
    {
        $cart = $this->getCart();
        if (!$cart) {
            return 0;
        }
        $counter = 0;
        foreach ($cart as $item) {
            $counter += (int) $item[1];
        }
        return $counter;
    }

    /**
     * @param  array  $cardItems
     * @return bool
     */
    final public function updateCard(array $cardItems): bool
    {
        $cart = [];
        foreach ($cardItems as $item) {
            if (((int) $item[1]) > 0) {
                $cart[] = $item;
            }
        }
        session()->put('cart', $cart);
        return true;
    }

    /**
     * @param  int  $id
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function deleteCardItem(int $id): bool
    {
        \session()->regenerate();
        $cart = $this->getCart();

        foreach ($cart as $index => $item) {
            if (((int) $item[0]) === $id) {
                unset($cart[$index]);
                \session()->put('cart', $cart);
                return true;
            }
        }
        return false;
    }

    /**
     * @param  Discount  $discount
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function applyCoupon(Discount $discount): bool
    {
        if ($discount) {
            if ($discount->expirationDay <= 0) {
                session()->flash('alert-error', 'Coupon code has expired');
                return false;
            }

            if ($this->getTotal() < $discount->payment_limit) {
                session()->flash('alert-error', 'Total is less than coupon limit');
                return false;
            }

            if ($discount->limit_number - $discount->number_used <= 0) {
                session()->flash('alert-error', 'Mã giảm giá đã hết lần sử dụng');
                return false;
            }

            session()->flash('alert-success', 'Use successful coupon');
            \session()->flash('coupon', [$discount->code, $discount->discount]);
            return true;

        }

        session()->flash('alert-error', 'Invalid coupon code');
        return false;
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function getCoupon(): mixed
    {
        \session()->keep('coupon');
        return \session()->get('coupon');
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function getCoupon1(): mixed
    {
        return \session()->get('coupon');
    }

    /**
     * @return void
     */
    final public function destroy(): void
    {
        \session()->forget('cart');
    }
}
