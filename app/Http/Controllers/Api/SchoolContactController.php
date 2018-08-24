<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\SchoolContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolContactController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  SchoolContact::with(array('school' => function ($query) {
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
            'school_id'  => 'required',
            'name'       => 'required|string|max:100',
            'nickname'   => 'required|string|max:50',
            'occupation' => 'required|string|max:50',
            'status'     => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        $data['ismain'] = strtoupper($data['ismain']);
        return SchoolContact::create($data);
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
            'school_id' => 'required',
            'name' => 'required|string|max:100',
            'nickname' => 'required|string|max:50',
            'occupation' => 'required|string|max:50',
            'status' => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        $data['ismain'] = strtoupper($data['ismain']);
        return $result->update($data);
    }
    public function update($id, Request $request)
    {
        $result = SchoolContact::findOrFail($id);

        $this->updateValidator($request->all(), $result)->validate();

        $this->updateCreate($request->all(), $result);
        return ['status' => true];
    }

    public function show($id, Request $request)
    {
        $result = SchoolContact::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result = SchoolContact::findOrFail($id);
        $result->delete();
        return ['status' => true];
    }
}
