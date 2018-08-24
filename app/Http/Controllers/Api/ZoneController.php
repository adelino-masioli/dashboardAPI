<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  Zone::with(array('country' => function ($query) {
            $query->select('id', 'name');
        }))->limit(100)->get();
        if($result->count() > 0){
            return $result;
        }else{
            return ['status' => false];
        }
    }

    public static function filter($country_id)
    {
        $result =  Zone::select('id', 'name')->where('country_id', $country_id)->get();
        if($result->count() > 0){
            return $result;
        }else{
            return ['status' => false];
        }
    }

    //store validate
    protected function storeValidator(array $data)
    {
        return Validator::make($data, [
            'name'         => 'required|string|max:70',
            'country_id'   => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return Zone::create($data);
    }
    //store
    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        $this->storeCreate($request->all());
        return ['status' => true];
    }

    //update validate
    protected function updateValidator(array $data, $result)
    {
        return Validator::make($data, [
            'name'         => 'required|string|max:70',
            'country_id'   => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        return $result->update($data);
    }
    public function update($id, Request $request)
    {
        $result = Zone::findOrFail($id);

        $this->updateValidator($request->all(), $result)->validate();

        $this->updateCreate($request->all(), $result);
        return ['status' => true];
    }

    public function show($id, Request $request)
    {
        $result = Zone::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result = Zone::findOrFail($id);
        $result->delete();
        return ['status' => true];
    }
}
