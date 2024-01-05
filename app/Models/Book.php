<?php

namespace App\Models;

class Book extends Product
{
    public function add($request)
    {
        $request['attributes'] = array();

        // Add attributes to the array
        $attribute1 = array('name' => 'Weight:', 'value' => $request['weight'] . ' KG');

        $request['attributes'][] = $attribute1;

        $this->create($request);
    }
}
