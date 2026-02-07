<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Display the shop page.
     *
     * @return \Illuminate\View\View
     */
    public function shop()
    {
        return view('home.shop');
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('home.contact');
    }

    /**
     * Display the testimonial page.
     *
     * @return \Illuminate\View\View
     */
    public function testimonial()
    {
        return view('home.testimonial');
    }

    /**
     * Display the why us page.
     *
     * @return \Illuminate\View\View
     */
    public function why()
    {
        return view('home.why');
    }

    /**
     * Display the dashboard page (protected by auth middleware).
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('home.dashboard');
    }
}
