<?php

namespace App\Service;


use App\Models\Product;
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
        if (session()->has('cart')) {
            return session()->get('cart');
        }
        return null;
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
        if (!$cart) {
            return false;
        }
        foreach ($cart as $key => $item) {
            if (((int) $item[0]) === $id) {
                $item[1] += $quantity;
                $cart[$key] = $item;
                session()->put($cart);
                return true;
            }
        }
        $cart[] = [$id, $quantity];
        session()->put($cart);
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
