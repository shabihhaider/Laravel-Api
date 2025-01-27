<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponses;
    
    public function include(string $relationship) : bool { // Check if the relationship is included in the request
        $param = request()->get('include'); // Get the include parameter from the URL
 
        if (!isset($param)) { // If the include parameter is not set, return false
            return false;
        }

        $includedValues = explode(',', strtolower($param)); // Split the include parameter by comma and convert to lowercase

        return in_array(strtolower($relationship), $includedValues); // Check if the relationship is included
    }
}
