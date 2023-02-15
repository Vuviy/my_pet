<?php

namespace Modules\Parser\Services;

use App\Models\Test;
use DiDom\Document;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Modules\Parser\Contracts\IDataResource;

class UkraineService implements IDataResource
{
    public function parse($url)
    {
        $document = new Document($url, true);
        $items = $document->find('a.chart-horizontal');

        $arr = [];

        foreach ($items as $item){
            $arr[$item->first('.chart-category')->text()] = intval( preg_replace("/[^0-9]/", '',$item->first('.chart-data-digits')->text()));
        }
        Storage::put('modules/Ukraine_file.json', json_encode($arr));
    }

    public function saveInDB()
    {

        if (Storage::get('modules/Ukraine_file.json'))
        {
            $arr = json_decode(Storage::get('modules/Ukraine_file.json'), true);

            foreach ($arr as $key => $value)
            {
                $model = new Test();
                $model->fill(
                    [
                        'profession' => $key,
                        'salary' => $value,
                    ]
                )->save();
            }

            if(file_exists(Storage::get('modules/Ukraine_file_SAVED.json')))
            {
                Storage::delete('modules/Ukraine_file_SAVED.json');
            }

            Storage::put('modules/Ukraine_file_SAVED.json', Storage::get('modules/Ukraine_file.json'));
            Storage::delete('modules/Ukraine_file.json');

        }
    }
}
