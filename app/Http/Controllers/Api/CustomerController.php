<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =   Customer::with(array('country' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('type' => function ($query) {
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
            'name'             => 'required|string|max:50',
            'tel'              => 'required|string|max:20',
            'email'            => 'required|string|max:150',
            'type_id'          => 'required',
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'street'           => 'required|string|max:255',
            'status'           => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return Customer::create($data);
    }
    //store
    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        $this->storeCreate($request->all());
        return ['status'=>true];
    }

    //update validate
    protected function updateValidator(array $data, $school)
    {
        return Validator::make($data, [
            'name'             => 'required|string|max:50',
            'tel'              => 'required|string|max:20',
            'email'            => 'required|string|max:150',
            'type_id'          => 'required',
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'street'           => 'required|string|max:255',
            'status'           => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $school)
    {
        return $school->update($data);
    }
    public function update($id, Request $request)
    {
        $school =  Customer::findOrFail($id);

        $this->updateValidator($request->all(), $school)->validate();

        $this->updateCreate($request->all(), $school);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $school =  Customer::findOrFail($id);
        return $school;
    }

    public function delete($id, Request $request)
    {
        $school =  Customer::findOrFail($id);
        $school->delete();
        return ['status'=>true];
    }
}
