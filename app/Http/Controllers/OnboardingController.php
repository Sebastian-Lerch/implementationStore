<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class OnboardingController extends Controller
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
    public function index(Request $request)
    {
        return view('onboardings.onboarding');
    }
}
