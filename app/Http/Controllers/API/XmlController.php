<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XmlController extends Controller
{

    public function index()
    {
        $xmlExchangeString = file_get_contents(public_path('ExchangeRates.xml'));
        $xmlOrderString = file_get_contents(public_path('Orders.xml'));
        $xmlExchangeString = $this->loadXml($xmlExchangeString);
        $xmlOrderString = $this->loadXml($xmlOrderString);
        $currency = $_SERVER['QUERY_STRING'];
        $xml = $this->convertCurrency($xmlOrderString, $xmlExchangeString, $currency);
        $json = json_encode($xml);
        $phpArray = json_decode($json, true);

        return $phpArray;

    }

    private function loadXml ($xml) {
        //the XML provided comes in smart quotes, they need to be replace by double or single quotes
        $xml = str_replace('”','\'', $xml);
        $xmlObject = simplexml_load_string($xml);
        return $xmlObject ;
    }

    public function convertCurrency ($items, $currencyx, $nextC) {

    foreach ($items as $item) :

        if ($item->currency != $nextC){

                    $orderDate = date($item->date);
                    $prevC = $item->currency;
                    $convRate = $this->getConversionRate($currencyx, $orderDate, $prevC, $nextC);           
                    $item->total = round(($item->total * $convRate), 2);
                    $item->currency = $nextC;
                    foreach ($item->products->product as $product  ):
                        $product['price'] = round(($product['price'] * $convRate), 2);
                    endforeach;
            }
    endforeach;

    return $items;

    }

    public function getConversionRate ($currencyx, $date, $prevC, $nextC){

        foreach ($currencyx->currency as $currency):

            switch ($currency->code) {
                case 'GBP':
                    $code = 'GBP';
                break;
                case 'EUR':
                    $code = 'EUR';
                break;
            }

            if ($code == $prevC){
             
                foreach ($currency->rateHistory->rates as $rates):
                   if ($rates['date'] == $date){
                   

                    foreach ($rates->rate as $rate):

                        switch ($rate['code']) {
                            case 'GBP':
                                $code = 'GBP';
                            break;
                            case 'EUR':
                                $code = 'EUR';
                            break;
                        }
                             
                        echo $rate;
                        if ($code == $nextC){
                            return $rate['value'];
                        };
                    endforeach;
                   };
                endforeach;
            };

        endforeach;

        return 1;
    }

}