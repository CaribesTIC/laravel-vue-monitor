<?php

namespace App\Http\Controllers;
use Goutte\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Print_;

class ScraperAmazon extends Controller
{

    private $results = array();

    public function scraper(Request $request)
    {      
              
        try{
            //https://gitanswer.com/httpclient-cannot-catch-transportexception-error-php-symfony-519249390
            $client = new Client();
            $url = "https://www.amazon.com/-/es/Ananda-BT-resoluci%C3%B3n-Bluetooth-auriculares-compatible/dp/B07X52DHH8/ref=sr_1_14?__mk_es_US=%C3%85M%C3%85%C5%BD%C3%95%C3%91&keywords=headphones&qid=1639508815&sr=8-14";
            $response = $client->request('POST', $url);
            $divprice = $response->filter('.apexPriceToPay');
            return $price = $divprice->filter('.a-offscreen')->text();  
        }catch(\Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception){
            die( $exception->getMessage() );
        }

        //echo "<pre>";
        //print_r($response);
        //return view("scraper");        
      
    }  
}
