<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = Order::query()->where('status', '=', 1)
            ->orderBy('order_status_id', 'asc')
            ->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', [
            'title' => 'Order Management',
            'data' => $data,
            'tag' => 'order',
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
     * @param  StoreOrderRequest  $request
     * @return Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrderRequest  $request
     * @return JsonResponse
     */
    public function updateStatus(Request $request): JsonResponse
    {
        $order = Order::query()->find($request->input('id'));
        $order->order_status_id = $request->input('order_status_id');
        $result = $order->save();

        return $result ? \response()->json([
            'error' => false,
            'message' => 'Success',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Error',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return Application|Factory|View
     */
    public function show(Order $order): View|Factory|Application
    {
        $data = OrderDetail::query()->where('order_details.order_id', '=', $order->id)
            ->get();
        $subtotal = 0;
        foreach ($data as $item) {
            $subtotal += $item->quantity * $item->price;
        }
        return \view('admin.order.detail', [
            'title' => 'Order Details',
            'data' => $data,
            'subtotal' => $subtotal,
            'order' => $order,
            'tag' => 'order',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order  $order
     * @return Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  Order  $order
     * @return Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order  $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
