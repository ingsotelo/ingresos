<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        
    	$users = DB::select("SELECT * FROM ingresos.users");       
        $data = [
            'users' => $users,
        ];
        return view('users.show-users', $data);
    }
}
