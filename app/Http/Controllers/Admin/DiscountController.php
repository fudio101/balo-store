<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = Discount::query()
            ->where('status', '=', 1)
            ->orderBy('expiration_date', 'desc')
            ->get();
        return view('admin.discount.index', [
            'title' => 'Discount Manager',
            'tag' => 'discount',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.discount.create', [
            'title' => 'Add Discount',
            'tag' => 'discount',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDiscountRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreDiscountRequest $request): RedirectResponse
    {
        if ($request->input('payment_limit') < $request->input('discount')) {
            return back()->withInput()->withErrors(['Payment limit must be greater than or equal to discount']);
        }
        $discount = new Discount();
        $discount->code = $request->input('code');
        $discount->discount = $request->input('discount');
        $discount->limit_number = $request->input('limit_number');
        $discount->payment_limit = $request->input('payment_limit');
        $discount->expiration_date = $request->input('expiration_date');
        $discount->description = $request->input('description');
        $result = $discount->save();
        return $result ? redirect()->route('discountIndex') : back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  Discount  $discount
     * @return Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Discount  $discount
     * @return Application|Factory|View
     */
    public function edit(Discount $discount): View|Factory|Application
    {
        return \view('admin.discount.update', [
            'title' => 'Edit Discount',
            'tag' => 'discount',
            'discount' => $discount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountRequest  $request
     * @param  Discount  $discount
     * @return Response
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        if ($request->input('payment_limit') < $request->input('discount')) {
            return back()->withInput()->withErrors(['Payment limit must be greater than or equal to discount']);
        }
        $discount->code = $request->input('code');
        $discount->discount = $request->input('discount');
        $discount->limit_number = $request->input('limit_number');
        $discount->expiration_date = $request->input('expiration_date');
        $discount->payment_limit = $request->input('payment_limit');
        $discount->description = $request->input('description');
        $result = $discount->save();
        return $result ? redirect()->route('discountIndex') : back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Discount  $discount
     * @return JsonResponse
     */
    public function destroy(Discount $discount): JsonResponse
    {
        $result = $discount->delete();

        return $result ? \response()->json([
            'error' => false,
            'message' => 'Delete successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t delete discount',
        ]);
    }
}
