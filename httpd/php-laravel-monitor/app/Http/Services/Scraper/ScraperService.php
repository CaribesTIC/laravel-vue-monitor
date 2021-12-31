<?php
namespace App\Http\Services\Scraper;

//use PhpParser\Node\Expr\Print_;
use App\Models\Product;
use Goutte\Client;

class ScraperService
{
    private $_client;

    public function get(): Array
    {
        $products = Product::select("name","url_path", "img_path")->get();        
        $this->_client = new Client();
        foreach ($products as $product) {
            $scraper = $this->_scraper($product["url_path"]);            
            $product["price"] = $scraper ? $scraper["price"] : $scraper;
            $product["offer"] = $scraper ? $scraper["offer"] : $scraper;
            $product["saving"] = $scraper ? $scraper["saving"] : $scraper; 
            $product["percentage"] = $scraper ? $scraper["percentage"] : $scraper;
        }

        return $products->sortBy("percentage")->reverse()->toArray();
    }

    private function _scraper(String $url): Array | null
    {
        try {
            $response = $this->_client->request('POST', $url); //echo "<pre>";print_r($response);

            $values = $response
                ->filter("table[class='a-lineitem a-align-top'] > tr")
                ->each( fn($node) => $node->text() );                       

            return [
                "price" => explode("US", $values[0])[1],
                "offer" => explode("US", $values[1])[1],
                "saving"  => explode("US", $values[2])[1],
                "percentage" => explode(" ", explode("US", $values[2])[2])[1]
            ];            
        } catch(\Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception) {
            return null;//$exception->getMessage();//die( $exception->getMessage() );
        }       
    }
    
}

