<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){

        $services = Service::all();

        return response()->json($services);
    }

    public function show(Service $service){
        return response()->json($service);
    }
}
