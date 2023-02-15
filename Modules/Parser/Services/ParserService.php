<?php

namespace Modules\Parser\Services;

use App\Models\Test;
use DiDom\Document;
use Illuminate\Support\Facades\Storage;
use Modules\Home\Models\Country;
use Modules\Parser\Contracts\IDataResource;

class ParserService implements IDataResource
{

    public function parse(Country $country)
    {
        $countryName = trim($country->translate('en')->name);

        $countryNameArr = explode(' ', $countryName);
        if (count($countryNameArr) > 1){
            $countryName = implode('+', $countryNameArr);
        }

        $url = 'https://www.numbeo.com/cost-of-living/country_result.jsp?country='.$countryName.'&displayCurrency=USD';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);
        curl_close($ch);

        $document = new Document($html);

        $exist = $document->find('form[action=https://www.numbeo.com/cost-of-living/city_result.jsp]');

        if (empty($exist)){
            return false;
        }
        //cost of live
        $cost = $document->find('li.disabled_on_small_devices_li');
        $cost_live = 0;
        if (!empty($cost)){

            $cost_live = $cost[1]->first('span.emp_number')->text();
            $cost_live = explode('₴', $cost_live);
            $cost_live = $cost_live[0];
            if(str_contains($cost_live, ',')){
                $cost_live = str_replace(',', '', $cost_live);
            }
            $cost_live = explode('.', $cost_live);
            $cost_live = intval($cost_live[0]);
        }
        //end cost of live

        //rent
        $rentElement = $document->find('td');
        $rent = 0;

        foreach ($rentElement as $rentVal){
            if(str_contains($rentVal, 'Apartment (1 bedroom) in City Centre')){
                $rent = $rentVal->nextSiblings();
                $rent = $rent[1]->text();
                if(str_contains($rent, ',')){
                    $rent = str_replace(',', '', $rent);
                }
                $rent = intval(explode('.', $rent)[0]);
            }
        }
        //end of rent

        //square_meter

        $square_meterElement = $document->find('td');
        $square_meter = 0;

        foreach ($square_meterElement as $square_meterVal){
            if(str_contains($square_meterVal, 'Price per Square Meter to Buy Apartment in City Centre')){
                $square_meter = $square_meterVal->nextSiblings();
                $square_meter = $square_meter[1]->text();
                if(str_contains($square_meter, ',')){
                    $square_meter = str_replace(',', '', $square_meter);
                }
                $square_meter = intval(explode('.', $square_meter)[0]);
            }
        }
        //end of square_meter


        $data = [
            'cost_live' => $cost_live,
            'rent' => $rent,
            'square_meter' => $square_meter,
        ];

        Storage::put('modules/'.$countryName.'_file.json', json_encode($data));

        return $data;

    }

//    public function saveInDB()
//    {
//        if (Storage::get('modules/Ukraine_file.json'))
//        {
//            $arr = json_decode(Storage::get('modules/Ukraine_file.json'), true);
//
//            foreach ($arr as $key => $value)
//            {
//                $model = new Test();
//                $model->fill(
//                    [
//                        'profession' => $key,
//                        'salary' => $value,
//                    ]
//                )->save();
//            }
//
//            if(file_exists(Storage::get('modules/Ukraine_file_SAVED.json')))
//            {
//                Storage::delete('modules/Ukraine_file_SAVED.json');
//            }
//
//            Storage::put('modules/Ukraine_file_SAVED.json', Storage::get('modules/Ukraine_file.json'));
//            Storage::delete('modules/Ukraine_file.json');
//
//        }
//    }
}
