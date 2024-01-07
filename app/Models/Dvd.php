<?php

namespace App\Models;

class Dvd extends Product
{
    public function add($request)
    {
        
        $request['attributes'][0]['value'] = $request['attributes'][0]['value'] . 'MB';

        $this->create($request);
    }
}