<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Inertia\Inertia;
use App\Http\Services\Scraper\ScraperService;

class DashboardController extends Controller
{

    public function index(): \Inertia\Response
    {
        $scraper = new ScraperService;        
        $products= $scraper->get();                   
        return Inertia::render("Dashboard", [ "data" => $products ]);  
    }   

}
