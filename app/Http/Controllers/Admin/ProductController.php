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
use Illuminate\Support\Facades\Storage;
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
        $data = Product::query()
            ->where('status', '=', 1)
            ->paginate(20);
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
        $avatar = Storage::disk('s3')->putFile('photos/products', $request->file('avatar'));
        $result = array();
        if ($request->file('images')) {
            foreach ($request->file('images') as $item) {
                $path = Storage::disk('s3')->putFile('photos/products', $item);
                $result[] = $path;
            }
        }
        $result = count($result) > 0 ? implode('#', $result) : null;
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
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        $producers = Producer::all();
        return view('admin.product.update', [
            'title' => 'Add Product',
            'tag' => 'product',
            'categories' => $categories,
            'producers' => $producers,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        if ($request->file('avatar')) {
            $avatar = $product->avatar;
            if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
                Storage::disk('s3')->delete($avatar);
            }
            $avatar = Storage::disk('s3')->putFile('photos/products', $request->file('avatar'));;
            $product->avatar = $avatar;
        }

        if ($request->file('images')) {
            $imgs = $product->images;
            if (count($imgs) > 0) {
                foreach ($imgs as $img) {
                    if (!filter_var($img, FILTER_VALIDATE_URL)) {
                        Storage::disk('s3')->delete($img);
                    }
                }
            }
            $result = array();
            foreach ($request->file('images') as $item) {
                $path = Storage::disk('s3')->putFile('photos/products', $item);
                $result[] = $path;
            }
            $result = count($result) > 0 ? implode('#', $result) : null;
            $product->images = $result;
        }

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->detail = $request->input('detail');
        $product->producer_id = $request->input('producer_id');
        $product->price = $request->input('price');

        $result = $product->save();
        if ($result) {
            return redirect()->route('productIndex');
        } else {
            return back()->withInput();
        }
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
        $avatar = $product->avatar;
        if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
            Storage::disk('s3')->delete($avatar);
        }

        $imgs = $product->images;
        if (count($imgs) > 0) {
            foreach ($imgs as $img) {
                if (!filter_var($img, FILTER_VALIDATE_URL)) {
                    Storage::disk('s3')->delete($img);
                }
            }
        }


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
