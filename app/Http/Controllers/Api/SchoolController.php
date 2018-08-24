<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =   School::with(array('school_group' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('country' => function ($query) {
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
            'school_group_id'  => 'required',
            'name'             => 'required|string|max:70',
            'fullname'         => 'required|string|max:200',
            'tel'              => 'required|string|max:30',
            'email'            => 'required|string|max:100|unique:schools',
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'address'          => 'required|string|max:200',
            'status'           => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return School::create($data);
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
            'school_group_id'  => 'required',
            'name'             => 'required|string|max:70',
            'fullname'         => 'required|string|max:200',
            'tel'              => 'required|string|max:30',
            'email'            => 'required|string|max:100|unique:schools,email, '.$school->id,
            'country_id'       => 'required',
            'zone_id'          => 'required',
            'address'          => 'required|string|max:200',
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
        $school =  School::findOrFail($id);

        $this->updateValidator($request->all(), $school)->validate();

        $this->updateCreate($request->all(), $school);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $school =  School::findOrFail($id);
        return $school;
    }

    public function delete($id, Request $request)
    {
        $school =  School::findOrFail($id);
        $school->delete();
        return ['status'=>true];
    }
}
