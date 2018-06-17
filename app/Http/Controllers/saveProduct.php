<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class saveProduct extends Controller
{
   public function index(){
     try {

       // check to ensure that variables sent are correct
       if (empty($_REQUEST['quantity_in_stock']) || empty($_REQUEST['price_per_item']) || empty($_REQUEST['product_name'])) {
         throw new \Exception ("All fields are required: " . print_r($_REQUEST, true));
       }
       if (!is_numeric($_REQUEST['quantity_in_stock']) || !is_numeric($_REQUEST['price_per_item']) || floatval($_REQUEST['price_per_item']) < 0 || floatval($_REQUEST['quantity_in_stock']) < 0) {
         throw new \Exception ('Quantity in stock and Price per item must be numeric and greater than zero');
       }

       // create json object
       $json_line = json_encode(
         ['product_name' => htmlspecialchars($_REQUEST['product_name']),
          'quantity_in_stock' => htmlspecialchars($_REQUEST['quantity_in_stock']),
          'price_per_item' => htmlspecialchars($_REQUEST['price_per_item']),
          'datetime_submitted' => date(DATE_RFC2822),
          'total_value_number' => (floatval($_REQUEST['quantity_in_stock']) * floatval($_REQUEST['price_per_item']))]);

       // write line to file
       $f = fopen("products.json", 'a+');
       fwrite($f,  $json_line . "\n");
       fclose($f);
       return response()->json(array('msg' => 'saved', 'json_line' => $json_line, 200));

     } catch (Exception $e) {
       // bail out with exception
       return response()->json(array('error'=>$e->getMessage(), 500));
     }

   }
}
