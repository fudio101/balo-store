<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Mail\Bill;
use App\Models\Discount;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Service\CartService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    final public function pay(PayRequest $request): RedirectResponse
    {
        //get cart from session
        $cart = $this->cartService->getCart();
        $orderDetails = [];
        foreach ($cart as $item) {
            $product = Product::query()->find($item[0]);
            if ($product) {
                $temp = new OrderDetail();
                $temp->fill([
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => $item[1],
                ]);
                $orderDetails[] = $temp;
            } else {
                $this->cartService->destroy();
                return Redirect::back()->withErrors('Invalid Product');
            }
        }

        $total = $this->cartService->getTotal();
        $coupon = $this->cartService->getCoupon1();
        $discount = null;
        if ($coupon) {
            $discount = Discount::query()
                ->where('code', '=', $this->cartService->getCoupon()[0])
                ->first();
            if (!$discount) {
                return Redirect::back()->withErrors('Invalid Coupon');
            }

            if ($total < $discount->payment_limit) {
                return Redirect::back()->withErrors('Subtotal is less than discount');
            }
        }

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');

        $hash = hash('md5', $name.$phone.$email.$address);
        do {
            $orderCode = strtoupper(substr($hash, random_int(0, 23), 9));
        } while (Order::query()->where('order_code', '=', $orderCode)->count() > 0);

        $order = new Order();

        $order->fill([
            'order_code' => $orderCode,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'total' => $total + 25000 - ($discount->discount ?? 0),
            'shipping_cost' => 25000,
            'coupon' => $discount->discount ?? 0,
            'district_id' => $request->input('district'),
            'detailed_address' => $address,
            'order_status_id' => 1,
        ]);

        $saveResult = $order->save();

        if ($saveResult) {
            if ($discount) {
                ++$discount->number_used;
                $result = $discount->save();
                if (!$result) {
                    return Redirect::back()->withErrors('Save discount error');
                }
            }
            foreach ($orderDetails as $i => $orderDetail) {
                $orderDetail->fill(['order_id' => $order->id]);
                $result = $orderDetail->save();
                if (!$result) {
                    return Redirect::back()->withErrors('Save discount error');
                }
            }
            $this->cartService->destroy();
        }

        $this->cartService->destroy();

        session()->flash('alert-success', 'Pay successfully');

        Mail::to($email)->send(new Bill());

        return Redirect::route('homepage');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
