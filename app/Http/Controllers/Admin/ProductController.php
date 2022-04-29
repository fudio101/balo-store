<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportProductRequest;
use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\Routing\Loader\Configurator\ImportConfigurator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = Product::query()->select('*')->where('products.status', '=', 1)->get();
        return view('admin.product.index', [
            'title' => 'Product Management',
            'data' => $data,
            'tag' => 'product',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::all();
        $producers = Producer::all();
        return view('admin.product.create', [
            'title' => 'Add Product',
            'tag' => 'product',
            'categories' => $categories,
            'producers' => $producers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $avatar = $request->file('avatar')->store('public/photos/products');
        $avatar = preg_replace('/public/', 'storage', $avatar, 1);

        $result = array();
        foreach ($request->file('images') as $item) {
            $path = $item->store('public/photos/products');
            $path = preg_replace('/public/', 'storage', $path, 1);
            $result[] = $path;
        }
        $result = implode('#', $result);

        $product = new Product();
        $product->fill([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'avatar' => $avatar,
            'images' => $result,
            'detail' => $request->input('detail'),
            'producer_id' => $request->input('producer_id'),
            'price' => $request->input('price'),
        ]);
        $product->save();

        return redirect()->route('productIndex');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ImportProductRequest  $request
     * @param  Product  $product
     * @return JsonResponse
     */
    public function import(ImportProductRequest $request, Product $product): JsonResponse
    {
        $request->merge(['quantity' => $request->input('quantity') + $product->quantity]);
        $result = $product->update($request->all());

        return $result ? \response()->json([
            'error' => false,
            'message' => 'Import successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t import product',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $result = $product->delete();
        return $result ? \response()->json([
            'error' => false,
            'message' => 'Delete successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t delete product',
        ]);
    }


}
