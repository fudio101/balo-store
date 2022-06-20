<?php

namespace App\Service;


use App\Models\Product;
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
                session()->put('cart', $cart);
                return true;
            }
        }
        $cart[] = [$id, $quantity];
        session()->put('cart', $cart);
        return true;
    }

    /**
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function getTotal(): mixed
    {
        $cart = $this->getCart();
        if (!$cart) {
            return 0;
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += Product::query()->find($item[0])->get('price');
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
}
