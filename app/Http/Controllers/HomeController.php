<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
     */
    final public function checkout(): Factory|View|Application
    {
        return \view('checkout', [
            'title' => 'Checkout',
            'secondTitle' => 'One more step',
        ]);
    }
}
