<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\SchoolFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolTransferController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  SchoolFee::with(array('school' => function ($query) {
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
            'name'             => 'required|string|max:255',
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return SchoolFee::create($data);
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
            'name'             => 'required|string|max:255',
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $school)
    {
        return $school->update($data);
    }
    public function update($id, Request $request)
    {
        $school =  SchoolFee::findOrFail($id);

        $this->updateValidator($request->all(), $school)->validate();

        $this->updateCreate($request->all(), $school);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $school =  SchoolFee::findOrFail($id);
        return $school;
    }

    public function delete($id, Request $request)
    {
        $school =  SchoolFee::findOrFail($id);
        $school->delete();
        return ['status'=>true];
    }
}
