<?php
namespace App\Http\Services\Scraper;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Goutte\Client;
use PhpParser\Node\Expr\Print_;
use App\Models\Product;
use App\GeneralSettings;

class ScraperService
{
    private $_client;    

    public function get(Request $request, GeneralSettings $settings): LengthAwarePaginator
    {
        $products = Product::select("name","url_path", "img_path")->paginate($settings->default_pagination);        
        $this->_client = new Client();
        foreach ($products as $product) {
            $scraper = $this->_scraper($product["url_path"]);
            $isArray = is_array($scraper);
            $product["price"] = $isArray ? $scraper["price"] : $scraper;
            $product["offer"] = $isArray ? $scraper["offer"] : $scraper;
            $product["save"] = $isArray ? $scraper["save"] : $scraper;
        }
        return $products;
    }

    private function _scraper(String $url): Array | String
    {
        try {
            $response = $this->_client->request('POST', $url); //echo "<pre>";print_r($response);

            $values = $response
                ->filter("table[class='a-lineitem a-align-top'] > tr")
                ->each( fn($node) => $node->text() );                       

            return [
                "price" => explode("US", $values[0])[1],
                "offer" => explode("US", $values[1])[1],
                "save"  => explode("US", $values[2])[2]
            ];            
        } catch(\Symfony\Component\HttpClient\Exception\TransportException | \Exception | \Throwable $exception) {
            return "Node empty";//$exception->getMessage();//die( $exception->getMessage() );
        }       
    }
    
}
