<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\AgencyPropType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgencyPropTypeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =   AgencyPropType::get();

        if($result->count() > 0){
            return $result;
        }else{
            return ['status' => false];
        }
    }
}
