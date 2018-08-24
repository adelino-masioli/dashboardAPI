<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use RegistersUsers;

    //get all
    public static function index()
    {
        $result =   User::get();

        if($result->count() > 0){
            return $result;
        }else{
            return ['status' => false];
        }
    }
    //login
    protected function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'        => 'required|string|max:255',
                'username'    => 'required|string|max:255|unique:users',
                'email'       => 'required|string|email|max:255|unique:users',
                'password'    => 'required|string|min:6|confirmed',
                'superuser'   => 'required',
                'status'      => 'required',
                'type'        => 'required',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            }else{
                User::create([
                    'name'        => $request['name'],
                    'username'    => str_slug($request['username'], '-'),
                    'email'       => $request['email'],
                    'password'    => Hash::make($request['password']),
                    'superuser'   => $request['superuser'],
                    'status'      => $request['status'],
                    'type'        => $request['type'],
                ]);
                return ['status'=>true];
            }
        }catch(\Exception $e){
            return ['status'=>false];
        }
    }
    //login
    protected function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = auth()->user();
            $user->token = $user->createToken('email')->accessToken;
            return $user;
        }else{
            return ['status'=>'Username or password is invalid'];
        }
    }

    public function validateToken(Request $request)
    {
        return response($request->token, 200);
        $user =  $request->user();
        return ['status'=>true];
        $user->token = $user->createToken('email')->accessToken;
        if($user){
            return $user->token;
        }else{
            return ['status'=>false];
        }
    }


    public function show(Request $request)
    {
        $user =  $request->user();
        $user->token = $user->createToken('email')->accessToken;
        return $user;
    }

    public static function update(Request $request)
    {
        $user = $request->user();
        try{
            if($request['password']){
                $validator = Validator::make($request->all(), [
                    'name'       => 'required|string|max:255',
                    'username'   => 'required|string|max:255|unique:users,username, '.$user->id,
                    'email'      => 'required|string|email|unique:users,email, '.$user->id,
                    'password'   => 'required|string|min:6|confirmed',
                    'superuser'  => 'required',
                    'status'     => 'required',
                    'type'       => 'required',
                ]);
                if ($validator->fails()) {
                    return $validator->errors();
                }
                $data = $request->all();
                $data['username'] = str_slug($data['username'], '-');
                $user->update($data);
                $user->token = $user->createToken('email')->accessToken;
                return ['status'=>true];
            }else{
                $validator = Validator::make($request->all(), [
                    'name'        => 'required|string|max:255',
                    'username'    => 'required|string|max:255|unique:users,username, '.$user->id,
                    'email'       => 'required|string|email|unique:users,email, '.$user->id,
                    'superuser'   => 'required',
                    'status'      => 'required',
                    'type'        => 'required',
                ]);
                if ($validator->fails()) {
                    return $validator->errors();
                }
                $data = $request->all();
                $data['username'] = str_slug($data['username'], '-');

                $user->update($data);
                $user->token = $user->createToken('email')->accessToken;
                return ['status'=>true];
            }
        }catch(\Exception $e){
            return ['status'=>false];
        }
    }
    public function delete($id, Request $request)
    {
        try{
            $user =  User::findOrFail($id);
            $user->delete();
            return ['status'=>true];

        }catch(\Exception $e){
            return ['status'=>true];
        }
    }
}
