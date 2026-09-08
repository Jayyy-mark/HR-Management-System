<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use DB;

class RegisterController extends Controller
{
    /** Show the registration page */
    public function register()
    {
        $roles = DB::table('role_type_users')->get();
        return view('auth.register', compact('roles'));
    }

    /** Store New User */
    public function storeUser(Request $request)
    {
        // saveNewuser validates input, saves, flashes, and redirects
        return (new User())->saveNewuser($request);
    }
}