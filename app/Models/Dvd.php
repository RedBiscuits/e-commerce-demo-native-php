<?php

namespace App\Models;

class Dvd extends Product
{
    public function add($request)
    {
        // Set attributes
        $request['attributes'] = array();

        // Add attributes to the array
        $attribute1 = array('name' => 'Size:', 'value' => $request['size'] . ' MB');
    
        $request['attributes'][] = $attribute1;
        
        $this->create($request);
    }
}