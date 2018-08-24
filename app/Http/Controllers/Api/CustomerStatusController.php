<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\CustomerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerStatusController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  CustomerStatus::get();
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
            'name'           => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return CustomerStatus::create($data);
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
            'name'           => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        return $result->update($data);
    }
    public function update($id, Request $request)
    {
        $result = CustomerStatus::findOrFail($id);

        $this->updateValidator($request->all(), $result)->validate();

        $this->updateCreate($request->all(), $result);
        return ['status' => true];
    }

    public function show($id, Request $request)
    {
        $result = CustomerStatus::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result = CustomerStatus::findOrFail($id);
        $result->delete();
        return ['status' => true];
    }
}
