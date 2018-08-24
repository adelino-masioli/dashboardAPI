<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\SchoolContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolContentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  SchoolContent::with(array('school' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('language' => function ($query) {
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
            'language_id'      => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return SchoolContent::create($data);
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
            'language_id'      => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $school)
    {
        return $school->update($data);
    }
    public function update($id, Request $request)
    {
        $school =  SchoolContent::findOrFail($id);

        $this->updateValidator($request->all(), $school)->validate();

        $this->updateCreate($request->all(), $school);
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $school =  SchoolContent::findOrFail($id);
        return $school;
    }

    public function delete($id, Request $request)
    {
        $school =  SchoolContent::findOrFail($id);
        $school->delete();
        return ['status'=>true];
    }
}
