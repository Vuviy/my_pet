<?php

namespace Modules\Parser\Facade;

use Illuminate\Support\Facades\Facade;

class ParserService extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'Parser';
    }

}
