<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'users' => User::all()
        ]);
        }
}
