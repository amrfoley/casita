<?php

namespace App\Http\Controllers;

use App\Http\Traits\Feeds;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Feeds;

    public function index()
    {
        $key = env('MAPS_KEY');
        $feeds = $this->getFeeds();
        // dd($feeds);
        return view('home', compact(['key', 'feeds']));
    }
}
