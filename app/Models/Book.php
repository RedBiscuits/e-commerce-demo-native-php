<?php

namespace App\Models;

class Book extends Product
{
    public function add($request)
    {

        $request['attributes'][0]['value'] = $request['attributes'][0]['value'] . ' KG';


        $this->create($request);
    }
}
