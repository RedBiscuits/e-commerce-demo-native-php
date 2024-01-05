<?php

namespace App\Models;

class Furniture extends Product
{
    public function add($request)
    {
        // Assuming $request is an existing array
        $request['attributes'] = array();

        // Add attributes to the array
        $attribute1 = array('name' => 'Height:', 'value' => $request['height']);
        $attribute2 = array('name' => 'Width:', 'value' => $request['width']);
        $attribute3 = array('name' => 'Length:', 'value' => $request['length']);

        $request['attributes'][] = $attribute1;
        $request['attributes'][] = $attribute2;
        $request['attributes'][] = $attribute3;

        $this->create($request);
    }
}
