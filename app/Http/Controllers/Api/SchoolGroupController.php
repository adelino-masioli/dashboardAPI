<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\SchoolGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolGroupController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =  SchoolGroup::all();

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
            'name'        => 'required|string|max:255|unique:users',
            'description' => 'required|string|max:255',
            'status'      => 'required'
        ]);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return SchoolGroup::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'status'      => $data['status']
        ]);
    }
    //store
    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        $this->storeCreate($request->all());
        return ['status'=>true];
    }

    //update validate
    protected function updateValidator(array $data, $schoolgroup)
    {
        return Validator::make($data, [
            'name'        => 'required|string|max:255|unique:school_groups,name, '.$schoolgroup->id,
            'description' => 'required|string|max:255',
            'status'      => 'required'
        ]);
    }
    //update  create
    protected function updateCreate(array $data, $schoolgroup)
    {
        return $schoolgroup->update($data);
    }
    public function update($id, Request $request)
    {
        $schoolgroup =  SchoolGroup::findOrFail($id);

        $this->updateValidator($request->all(), $schoolgroup)->validate();

        $this->updateCreate($request->all(), $schoolgroup);
        return ['status'=>true];
    }

    public function delete($id, Request $request)
    {
        $schoolgroup =  SchoolGroup::findOrFail($id);
        $schoolgroup->delete();
        return ['status'=>true];
    }
}
