<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Province;
use App\Service\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HomeController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @param  Request  $request
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function index(Request $request): Factory|View|Application
    {
        $products = Product::query()
            ->where('status', '=', 1)
            ->whereRaw('quantity - quantity_sold > 0')
            ->orderBy('quantity_sold', 'desc')
            ->limit(3)
            ->get();

        return \view('home', [
            'title' => 'Balo store',
            'products' => $products,
        ]);
    }

    /**
     * @return Factory|View|Application
     */
    final public function contact(): Factory|View|Application
    {
        return \view('contact', [
            'title' => 'Contact',
            'secondTitle' => 'Sent what you want',
        ]);
    }

    /**
     * @return Factory|View|Application
     */
    final public function about(): Factory|View|Application
    {
        return \view('about', [
            'title' => 'About',
            'secondTitle' => 'We sale fresh fruits',
        ]);
    }

    /**
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function checkout(): Factory|View|Application
    {
        $cart = $this->cartService->getCart();
        $cartItems = [];
        $total = 0;
        foreach ($cart as $item) {
            $product = Product::query()->find($item[0]);
            $temp = $product->price * $item[1];
            $cartItems[] = [$product, number_format($temp, 0, '', ',').' VND'];
            $total += $temp;
        }
        $coupon = $this->cartService->getCoupon();
        $provinces = Province::all();
        return \view('checkout', [
            'title' => 'Checkout',
            'secondTitle' => 'One more step',
            'cart' => $cartItems,
            'total' => $total,
            'discount' => $coupon ? $coupon[1] : 0,
            'provinces' => $provinces,
        ]);
    }

    final public function bill()
    {
        return \view('bill');
    }
}
