<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;

class DashboardController extends Controller
{
    public function index(){
        FacadesGate::authorize('access_dashboard');
        return view('admin.dashboard');
    }
}
