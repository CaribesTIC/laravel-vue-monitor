<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Goutte\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Services\Scraper\ScraperService;

class DashboardController extends Controller
{

    public function index(Request $request, GeneralSettings $settings): \Inertia\Response
    {
        $scraper = new ScraperService;        
        $products= $scraper->get($request, $settings);              
        return Inertia::render("Dashboard", [ "data" => $products ]);  
    }   

}
