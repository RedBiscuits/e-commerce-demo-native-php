<?php

namespace App\Models;

class Furniture extends Product
{
    public function add($request)
    {

        $request['attributes'][0]['value'] = $request['attributes'][0]['value'] . 'x';
        $request['attributes'][1]['value'] = $request['attributes'][1]['value'] . 'x';
        $request['attributes'][2]['value'] = $request['attributes'][2]['value'] . ' ';

        $this->create($request);
    }
}
