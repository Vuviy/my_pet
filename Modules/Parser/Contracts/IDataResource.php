<?php

namespace Modules\Parser\Contracts;

interface IDataResource
{
    public function parse($url);
    public function saveInDB();

}
