<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;

class SwaggerController extends Controller
{
    public function get()
    {
        return view('swagger');
    }
}
