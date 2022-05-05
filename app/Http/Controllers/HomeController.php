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
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        $counter = $this->cartService->count();
        $categories = Category::all();

        //Pagination
        //calculate
        $totalProduct = Product::query()->where('status', '=', 1)->count();
        $numProductsPerPage = 10;
        $maxPage = (int) ceil($totalProduct / $numProductsPerPage);
        //get curent page
        $currentPage = $request->get('page', 1);
        $currentPage = $currentPage < 1 ? 1 : $currentPage;
        $currentPage = $currentPage > $maxPage ? $maxPage : $currentPage;

        $pageStart = $currentPage - 2;
        $pageEnd = $currentPage + 2;

        if ($currentPage < 4) {
            $pageStart = 1;
            $pageEnd = $maxPage > 5 ? ($pageStart + 4) : $maxPage;
        } elseif ($currentPage > $maxPage - 3) {
            $pageEnd = $maxPage;
            $pageStart = $maxPage > 5 ? ($pageEnd - 4) : 1;
        }

        $offset = ($currentPage - 1) * $numProductsPerPage;

        $products = Product::query()->where('status', '=', 1)->skip($offset)->take($numProductsPerPage)->get();

        $catProducts = [];
        foreach ($categories as $item) {
            $catProducts[] = Product::query()->where('category_id', '=', $item->id)->limit(5)->get();
        }
        return view('index', [
            'title' => 'Balo Store',
            'cart' => $cart,
            'total' => $total,
            'counter' => $counter,
            'categories' => $categories,
            'maxPage' => $maxPage,
            'products' => $products,
            'currentPage' => $currentPage,
            'pageStart' => $pageStart,
            'pageEnd' => $pageEnd,
            'catProducts' => $catProducts,
        ]);
    }
}
