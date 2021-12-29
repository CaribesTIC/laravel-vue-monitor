<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "name" => "Fossil Nate",
            "description" => "Reloj casual de cuarzo para hombre, acero inoxidable y metal",
            "url_path" => "https://www.amazon.com/-/es/Fossil-Nate-casual-inoxidable-JR1401/dp/B008AXYWHQ/ref=sr_1_1?keywords=watches+for+men&qid=1640361651&sprefix=relojes%2Caps%2C133&sr=8-1",
            "img_path" => "https://m.media-amazon.com/images/I/41SnJtPpTQL._AC_SR38,50_.jpg"
        ]);
        
        Product::create([
            "name" => "Armani Exchange",
            "description" => "Reloj de vestir con cronógrafo para hombre, correa de piel, acero o silicona",
            "url_path" => "https://www.amazon.com/Armani-Exchange-cron%C3%B3grafo-silicona-Silicone/dp/B016Q1BZQO/ref=bmx_dp_o21fp2qo_16/134-4275714-7372052?pd_rd_w=O6j4N&pf_rd_p=862b4b8b-7a18-40e3-a54d-9d43f8d57f92&pf_rd_r=KB3F6XPB5ND8ZQVFYB6K&pd_rd_r=b52d6256-9889-4f4e-8555-4275ee0f823f&pd_rd_wg=ysMNj&pd_rd_i=B016Q1BZQO&psc=1",
            "img_path" => "https://m.media-amazon.com/images/I/41NZ0m0ksZL._AC_SR38,50_.jpg"
        ]);
        
        Product::create([
            "name" => "Invicta Reloj (modelo: 23860)",
            "description" => "De cuarzo de acero inoxidable para hombre con correa de silicona, negro, 32",
            "url_path" => "https://www.amazon.com/-/es/Invicta-cuarzo-inoxidable-hombre-silicona/dp/B0722JGR8X/ref=pd_sim_2/134-4275714-7372052?pd_rd_w=0hFQe&pf_rd_p=cf667c36-5137-43ea-a503-3c58067bc8ac&pf_rd_r=4N37E03N3GR2FTV56BJT&pd_rd_r=524764d5-970e-4ad8-b899-dbc5746ca7ae&pd_rd_wg=eHgeH&pd_rd_i=B0722JGR8X&psc=1",
            "img_path" => "https://m.media-amazon.com/images/I/51MJmXIyOaL._AC_SR38,50_.jpg"
        ]);
        
        Product::create([
            "name" => "Invicta Reloj (modelo: 24217)",
            "description" => "De cuarzo para hombre con correa de poliuretano, dos tonos, 29",
            "url_path" => "https://www.amazon.com/-/es/Invicta-cuarzo-hombre-correa-poliuretano/dp/B01N6RXH2C/ref=pd_sbs_4/134-4275714-7372052?pd_rd_w=A6WOk&pf_rd_p=3676f086-9496-4fd7-8490-77cf7f43f846&pf_rd_r=V8QKG3XC102GB3Y67SE9&pd_rd_r=9a35d74b-a664-4a92-a81f-639ec2a73ca8&pd_rd_wg=W5uSi&pd_rd_i=B01N6RXH2C&psc=1",
            "img_path" => "https://m.media-amazon.com/images/I/516IhyPTRsL._AC_SR38,50_.jpg"
        ]);
        
        Product::create([
            "name" => "Emporio Armani AR11105",
            "description" => "Reloj analógico con esfera azul para hombre",
            "url_path" => "https://www.amazon.com/-/es/Emporio-Armani-AR11105-anal%C3%B3gico-esfera/dp/B077C5LFN7/ref=pd_sbs_2/134-4275714-7372052?pd_rd_w=xWNeh&pf_rd_p=3676f086-9496-4fd7-8490-77cf7f43f846&pf_rd_r=PQ71D0YRXBH1YRGG8ZQJ&pd_rd_r=c1172ed2-9f22-45b3-878f-9639ab4c535b&pd_rd_wg=W6LVo&pd_rd_i=B077C5LFN7&psc=1",
            "img_path" => "https://m.media-amazon.com/images/I/41os2JdsIEL._AC_SR38,50_.jpg"
        ]);
        
        Product::create([
            "name" => "Emporio Armani Luigi",
            "description" => "Reloj de vestir de tres manecillas con movimiento de cuarzo para hombre",
            "url_path" => "https://www.amazon.com/-/es/Emporio-Armani-Luigi-manecillas-movimiento/dp/B00JGODRKQ/ref=pd_sbs_3/134-4275714-7372052?pd_rd_w=0I5JV&pf_rd_p=3676f086-9496-4fd7-8490-77cf7f43f846&pf_rd_r=4N37E03N3GR2FTV56BJT&pd_rd_r=524764d5-970e-4ad8-b899-dbc5746ca7ae&pd_rd_wg=eHgeH&pd_rd_i=B00JGODRKQ&psc=1",
            "img_path" => "https://m.media-amazon.com/images/I/51s4diCLX4L._AC_SR38,50_.jpg"
        ]);
        
    }
}
