<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginIndex()
    {
        if (!Auth::check()) {
            return view('admin.authen.login', [
                'tag' => 'admin',
            ]);
        }
        return redirect()->intended('admin');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin');
        }
        return back()->with('status', 'Username or Password is wrong')->withInput();
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return Factory|View|Application
     */
    public function logout(Request $request): Application|Factory|View
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('admin.authen.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View|Application
     */
    public function index(): Application|Factory|View
    {
        $total = Product::query()->where('status', '=', 1)->get()->count();
        $total_ = Product::query()->select(DB::raw('SUM(quantity -quantity_sold ) AS total_'))->where('status', '=',
            1)->get();
        $orders = Order::query()->where('status', '=', 1)->get()->count();
        $deliveringOders = Order::query()->where('order_status_id', '=', 2)->get()->count();
        $deliveredOders = Order::query()->where('order_status_id', '=', 3)->get()->count();
        $revenue = Order::query()->select(DB::raw('SUM(GREATEST(total - coupon,0)) AS revenue'))->where('status', '=',
            2)->orWhere('status', '=', 3)->get();
        return view('admin.index', [
            'title' => 'Dashboard Page',
            'total' => $total,
            'total_' => $total_->get('total_') ?: 0,
            'orders' => $orders,
            'deliveringOders' => $deliveringOders,
            'deliveredOders' => $deliveredOders,
            'revenue' => $revenue->get('revenue') ?: 0,
            'tag' => 'admin',
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
