<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = Category::query()->where('status', '=', 1)->get();
        return view('admin.category.index', [
            'title' => 'Product Category Management',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCategoryRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = new Category();
        $category->fill([
            'name' => $request->input('name'),
        ]);
        $category->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function edit(Category $category): JsonResponse
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCategoryRequest  $request
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        $category = Category::query()->find($request->input('id'));
        $category->fill([
            'name' => $request->input('name'),
        ]);
        $result = $category->save();
        return $result ? \response()->json([
            'error' => false,
            'message' => 'Change name successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t change name',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $result = $category->delete();
        return $result ? \response()->json([
            'error' => false,
            'message' => 'Delete successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t delete category',
        ]);
    }
}
