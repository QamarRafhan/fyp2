<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request, User $model)
    {
        return view('users.index', ['users' => $model->paginate(
            $request->has('per_page') ?
                $request->input('per_page') :
                config('app.global.record_per_page')
        )]);
    }
}
