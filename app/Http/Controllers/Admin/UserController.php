<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = User::query()->where('status', '=', 1)->get();
        $user = Auth::user();
        return view('admin.user.index', [
            'title' => 'User Management',
            'data' => $data,
            'user' => $user,
            'tag' => 'user',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $userGroups = UserGroup::all();
        return view('admin.user.create', [
            'title' => 'Add User Accounts',
            'userGroups' => $userGroups,
            'tag' => 'user',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->gender = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->password = $request->input('password');
        $result = $user->save();
        return $result ? redirect()->route('userIndex') : redirect()->back()->withInput();
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
     * @param  User  $user
     * @return Application|Factory|View
     */
    public function edit(User $user): View|Factory|Application
    {
        $userGroups = UserGroup::all();
        return view('admin.user.update', [
            'title' => 'Edit User Accounts',
            'userGroups' => $userGroups,
            'tag' => 'user',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->gender = $request->input('gender');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        if ($request->input('password') != null) {
            $user->password = $request->input('password');
        }
//        dd($user);
        $result = $user->save();
        return $result ? redirect()->route('userIndex') : redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $result = $user->delete();
        return $result ? \response()->json([
            'error' => false,
            'message' => 'Delete successfully',
        ]) : \response()->json([
            'error' => true,
            'message' => 'Can\'t delete user',
        ]);
    }
}
