<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgencyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgencyImageController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public static function index()
    {
        $result =   AgencyImage::with(array('agency' => function ($query) {
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
        $messages = [
            'name.not_in' => 'The :attribute must be different from undefined.'
        ];
        return Validator::make($data, [
            'name'             => 'required|string|max:50|not_in:undefined',
            'url'              => 'required|image',
            'agency_id'        => 'required',
            'type_id'          => 'required',
            'status'           => 'required|not_in:undefined'
        ], $messages);
    }
    //store create
    protected function storeCreate(array $data)
    {
        return AgencyImage::create($data);
    }
    //store
    public function store(Request $request)
    {
        $this->storeValidator($request->all())->validate();
        $data = $request->all();
        if ($request->hasFile('url')) {
            $image = $request->file('url');
            $extension = $image->extension();
            $filename = str_slug($data['url'], '-').'-'.md5(date('H:i:s')).'.'.$extension;
            $data['url'] = $filename;
            $this->storeCreate($data);

            $destinationPath = public_path('/uploads/agencies');
            $image->move($destinationPath, $filename);
        }
        return ['status'=>true];
    }

    //update validate
    protected function updateValidator(array $data, $result)
    {
        $messages = [
            'name.not_in' => 'The :attribute must be different from undefined.'
        ];
        return Validator::make($data, [
            'name'             => 'required|string|max:50|not_in:undefined',
            'agency_id'        => 'required',
            'type_id'          => 'required',
            'status'           => 'required|not_in:undefined'
        ], $messages);
    }
    //update  create
    protected function updateCreate(array $data, $result)
    {
        return $result->update($data);
    }
    public function update( Request $request)
    {
        $id = $request->id;
        $result =  AgencyImage::findOrFail($id);
        $this->updateValidator($request->all(), $result)->validate();
        $data = $request->all();

        if ($request->hasFile('url')) {
            $image = $request->file('url');
            $extension = $image->extension();
            $filename = str_slug($data['url'], '-').'-'.md5(date('H:i:s')).'.'.$extension;
            $data['url'] = $filename;
            
            $destinationPath = public_path('/uploads/agencies');
            
            if(file_exists($destinationPath.'/'.$result->url)){ 
                unlink($destinationPath.'/'.$result->url);
            } 
            
            $this->updateCreate($data, $result);
            $image->move($destinationPath, $filename);
        }else{
            $this->updateCreate($request->all(), $result);
        }
        return ['status'=>true];
    }

    public function show($id, Request $request)
    {
        $result =  AgencyImage::findOrFail($id);
        return $result;
    }

    public function delete($id, Request $request)
    {
        $result =  AgencyImage::findOrFail($id);
        $destinationPath = public_path('/uploads/agencies');
        if(file_exists($destinationPath.'/'.$result->url)){ 
            unlink($destinationPath.'/'.$result->url);
        } 
        $result->delete();
        return ['status'=>true];
    }
}
