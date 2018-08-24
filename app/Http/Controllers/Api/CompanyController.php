<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  Company::get();
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
            'name'          => 'required|string|max:255',
            'fullname'      => 'required|string|max:255',
            'email'         => 'required|string|email|max:100',
            'skype'         => 'required|string|max:100',
            'tel1'          => 'required|string|max:50',
            'tel2'          => 'required|string|max:50',
            'tel_emergency' => 'required|string|max:50',
            'street'        => 'required|string|max:255',
            'street2'       => 'required|string|max:255',
            'zone_id'       => 'required|max:10',
            'country_id'    => 'required|max:10',
            'city_id'       => 'required|max:10',
            'postcode'      => 'required|string|max:255',
            'notes'         => 'required|string',
            'status'        => 'required|max:10',
            'type_id'       => 'required|max:10',
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return Company::create($data);
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
            'name'          => 'required',
            'fullname'      => 'required',
            'email'         => 'required',
            'stype'         => 'required',
            'tel1'          => 'required',
            'tel2'          => 'required',
            'tel_emergency' => 'required',
            'street'        => 'required',
            'street2'       => 'required',
            'city'          => 'required',
            'zone_id'       => 'required',
            'country_id'    => 'required',
            'postcode'      => 'required',
            'notes'         => 'required',
            'status'        => 'required',
            'type_id'       => 'required',
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        return $result->update($data);
    }
    public function update($id, Request $request)
    {
        $result = Company::findOrFail($id);

        $this->updateValidator($request->all(), $result)->validate();

        $this->updateCreate($request->all(), $result);
        return ['status' => true];
    }

    public function show($id, Request $request)
    {
        $result = Company::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result = Company::findOrFail($id);
        $result->delete();
        return ['status' => true];
    }
}
