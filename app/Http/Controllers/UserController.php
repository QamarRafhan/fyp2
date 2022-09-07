<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Http\Middleware\Authenticate;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $model = User::query();

        if ($request->has('role')) {
            $model->where('role', $request->role);
        }
        return view('users.index', ['users' => $model->paginate(
            $request->has('per_page') ?
                $request->input('per_page') :
                config('app.global.record_per_page')
        )]);
    }
    public function edit(User $user)
    {
        // dd($user);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $data = $request->only($user->getFillable());
        //  dd($request->all());
        $user->fill($data);
        $user->save();


        return back()->withStatusSuccess(__('User Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if (Auth::User()->id != $user->id) {
            $user->delete();
            return redirect()->route('user.index')->withStatusSuccess(__('User deleted successfully.'));
        }
        abort(404);
    }
}
