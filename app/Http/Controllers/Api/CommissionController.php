<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  Commission::with(array('school' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('item' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('company' => function ($query) {
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
            'school_id'        => 'required',
            'value'            => 'required|between:0,99.99',
            'company_id'       => 'required',
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return Commission::create($data);
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
            'school_id'        => 'required',
            'company_id'       => 'required',
            'value'            => 'required|between:0,99.99'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $school)
    {
        return $school->update($data);
    }
    public function update($id, Request $request)
    {
        $school =  Commission::findOrFail($id);

        $this->updateValidator($request->all(), $school)->validate();

        $this->updateCreate($request->all(), $school);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $school =  Commission::findOrFail($id);
        return $school;
    }

    public function delete($id, Request $request)
    {
        $school =  Commission::findOrFail($id);
        $school->delete();
        return ['status'=>true];
    }
}
