<?php

namespace App\Http\Controllers;

use App\Actions\DashboardAction;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(DashboardAction $action)
    {
        return view('pages.dashboard', $action->generalAnalytics());
    }
}
