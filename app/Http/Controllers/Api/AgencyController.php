<?php

namespace App\Http\Controllers\Api;

use App\Models\Agency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgencyController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =   Agency::with(array('country' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('city' => function ($query) {
            $query->select('id', 'name');
        }))->get();

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
            'name'             => 'required|string|max:70',
            'fullname'         => 'required|string|max:200',
            'tel'              => 'required|string|max:30',
            'email'            => 'required|string|max:100|unique:agencies',
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'address'          => 'required|string|max:200',
            'status'           => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return Agency::create($data);
    }
    //store
    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        $this->storeCreate($request->all());
        return ['status'=>true];
    }

    //update validate
    protected function updateValidator(array $data, $result)
    {
        return Validator::make($data, [
            'name'             => 'required|string|max:70',
            'fullname'         => 'required|string|max:200',
            'tel'              => 'required|string|max:30',
            'email'            => 'required|string|max:100|unique:agencies,email, '.$result->id,
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'address'          => 'required|string|max:200',
            'status'           => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        return $result->update($data);
    }
    public function update($id, Request $request)
    {
        $result =  Agency::findOrFail($id);

        $this->updateValidator($request->all(), $result)->validate();

        $this->updateCreate($request->all(), $result);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $result =  Agency::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result =  Agency::findOrFail($id);
        $result->delete();
        return ['status'=>true];
    }
}
