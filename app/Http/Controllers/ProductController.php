<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Service\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductController extends Controller
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
     */
    final public function index(): View|Factory|Application
    {
        return \view('shop', [
            'title' => 'Shop',
            'secondTitle' => 'Everything you need',
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return Application|Factory|View
     */
    final public function show(Product $product): View|Factory|Application
    {
        $products = Product::query()
            ->where('category_id', '=', $product->category->id)
            ->where('id', '!=', $product->id)
            ->where('status', '=', 1)
            ->whereRaw('quantity - quantity_sold > 0')
            ->orderBy('quantity_sold', 'desc')
            ->limit(3)
            ->get();
        return \view('product', [
            'title' => $product->name,
            'secondTitle' => 'A close look',
            'product' => $product,
            'products' => $products,
        ]);
    }

    /**
     * @param  AddCartRequest  $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function addCart(AddCartRequest $request): RedirectResponse
    {
        $this->cartService->addCart($request->input('productId'),
            $request->input('quantity') ? $request->input('quantity') : 1);
        return redirect()->back();
    }

    /**
     * @return Factory|View|Application
     */
    final public function cart(): Factory|View|Application
    {
        $cart = $this->cartService->getCart();
        $cartItems = [];
        $total = 0;
        foreach ($cart as $item) {
            $product = Product::query()->find($item[0]);
            $temp = $product->price * $item[1];
            $cartItems[] = [$product, $item[1], number_format($temp, 0, '', ',').' VND'];
            $total += $temp;
        }
        return \view('cart', [
            'title' => 'Cart',
            'secondTitle' => 'Best of your mind',
            'cart' => $cartItems,
            'total' => $temp,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
