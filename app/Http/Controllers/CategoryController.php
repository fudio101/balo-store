<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use App\Service\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CategoryController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function index(Category $category, Request $request): View|Factory|Application
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        $counter = $this->cartService->count();
        $categories = Category::all();

        //Pagination
        $totalProduct = Product::query()->where('status', '=', 1)
            ->where('category_id', '=', $category->id)
            ->count();
        $numProductsPerPage = 1;
        $maxPage = (int) ceil($totalProduct / $numProductsPerPage);
        //get current page
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
        ///END PHAN TRANG///

        $sort = (int) $request->get('sort', 0);

        $products = Product::query()->where('status', '=', 1)
            ->where('category_id', '=', $category->id);
        if ($sort === 1) {
            $products = $products->orderBy('price')->skip($offset)->take($numProductsPerPage)->get();
        } elseif ($sort === 2) {
            $products = $products->orderBy('price', 'desc')->skip($offset)->take($numProductsPerPage)->get();
        } else {
            $products = $products->orderBy('created_at', 'desc')->skip($offset)->take($numProductsPerPage)->get();
        }


        return view('category', [
            'title' => 'Balo Store',
            'cart' => $cart,
            'total' => $total,
            'counter' => $counter,
            'categories' => $categories,
            'currentPage' => $currentPage,
            'sort' => $sort,
            'maxPage' => $maxPage,
            'pageStart' => $pageStart,
            'pageEnd' => $pageEnd,
            'totalProduct' => $totalProduct,
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
