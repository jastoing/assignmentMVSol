<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
    public function index()
    {
        $user = Auth::user();
        $subs = $user->subs()->get();
        $pages = [];
        foreach ($subs as $sub) {
            foreach (unserialize($sub->pages) as $page) {
                $pages[]=$page;
            }
        }
        
        return view('home', compact('pages'));
    }

    public function get_page($slug)
    {
        $user = Auth::user();
        $subs = $user->subs()->get();
        $pages = [];
        foreach ($subs as $sub) {
            foreach (unserialize($sub->pages) as $page) {
                $pages[]=$page;
            }
        }
        return view($slug, compact('pages'));
    }
}
