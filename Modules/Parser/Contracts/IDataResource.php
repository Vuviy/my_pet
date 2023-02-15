<?php

namespace Modules\Parser\Contracts;

use Modules\Home\Models\Country;

interface IDataResource
{
    public function parse(Country $country);

}
