<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\RepairingRequet;
use App\Models\User;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $total_cat = Category::all()->count();
        $total_vehicle = Vehicle::all()->count();
        $total_user = User::all()->count();
        $total_company = Company::all()->count();
        return view('dashboard', compact('total_cat', 'total_vehicle', 'total_user', 'total_company'));
    }
}
