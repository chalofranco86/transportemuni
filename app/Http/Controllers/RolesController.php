<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function getUserByRole($role){
        $users = DB::table('users')->where('role', $role)->get();
        $userRole = auth()->user()->role;
        return view('admin.index', ['users' => $users, 'userRole' => $userRole]);
    }
}