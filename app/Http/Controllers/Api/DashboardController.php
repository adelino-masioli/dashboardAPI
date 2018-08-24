<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Agency;
use App\Models\Customer;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $schools  = School::count();
        $agencies = Agency::count();
        $clients  = Customer::count();
        $users    = User::count();
        $sumary   = ['schools'=>$schools, 'agencies'=>$agencies, 'clients'=>$clients, 'users'=>$users];
        return $sumary;
    }
}
