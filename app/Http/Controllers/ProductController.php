<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Service\CartService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $products = Product::query()
            ->where('status', '=', 1)
            ->whereRaw('quantity - quantity_sold > 0')
            ->orderBy('quantity_sold', 'desc')
            ->paginate(15);
        $categories = Category::all();
        return \view('shop', [
            'title' => 'Shop',
            'secondTitle' => 'Everything you need',
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     */
    final public function search(Request $request): View|Factory|Application
    {
        $keywords = $request->input('keywords');
        $products = Product::query()
            ->where('status', '=', 1)
            ->whereRaw('quantity - quantity_sold > 0')
            ->where('name', 'LIKE', "%{$keywords}%")
            ->orWhere('detail', 'LIKE', "%{$keywords}%")
            ->orderBy('quantity_sold', 'desc')
            ->paginate(15);
        $categories = Category::all();
        return \view('shop', [
            'title' => 'Shop',
            'secondTitle' => 'Everything you need',
            'categories' => $categories,
            'products' => $products->appends($request->except('page')),
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
            $request->input('quantity') ?: 1);
        session()->flash('alert-success','Successfully added products to cart');
        return redirect()->back();
    }

    /**
     * @param  UpdateCartRequest  $request
     * @return JsonResponse
     */
    final public function updateCart(UpdateCartRequest $request): JsonResponse
    {
        $this->cartService->updateCard($request->input());
        return response()->json(['result' => true]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function deleteCardItem(Request $request): JsonResponse
    {
        $this->cartService->deleteCardItem($request->input('id'));
        session()->flash('alert-success', 'Delete item successfully');
        return response()->json(['result' => true]);
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    final public function applyCoupon(Request $request): RedirectResponse
    {
        $request->validate(['couponCode' => 'required|string|exists:discounts,code']);
        $discount = Discount::query()->where('code', '=', $request->input('couponCode'))->first();
        $this->cartService->applyCoupon($discount);
        return redirect()->back();
    }

    /**
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
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
        $coupon = $this->cartService->getCoupon();
        return \view('cart', [
            'title' => 'Cart',
            'secondTitle' => 'Best of your mind',
            'cart' => $cartItems,
            'total' => $total,
            'discount' => $coupon ? $coupon[1] : 0,
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
