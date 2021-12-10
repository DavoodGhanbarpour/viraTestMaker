<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile()
    {
        $params         = [
            'fullName'      => Auth::user()->name,
            'username'      => Auth::user()->username,
            'email'         => Auth::user()->email,
            'phoneNumber'   => Auth::user()->phoneNumber,
        ];
        return view('pages.profile.index', $params);
    }


    public function users()
    {
        $params     = [
            'users' => DB::table('users')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        return view('pages.users.index', $params);
    }


    public function editUser( $id )
    {
        $user           = DB::table('users')->select('*')->where([ [ 'trash', '<>', trashed() ], [ 'id', '=', $id ] ])->get()->first();
        if( !$user )
            return back()->with('flashMessage', messageErrors(402) );

        $params             = [
            'fullName'      => $user->name,
            'username'      => $user->username,
            'email'         => $user->email,
            'phoneNumber'   => $user->phoneNumber,
            'role'          => $user->role,
        ];

        return view('pages.users.user', $params);
    }


    public function deleteUser( $id )
    {
        if( Auth::user()->id == $id )
            return back()->with('flashMessage', messageErrors( 405 ) );

        $affected = DB::table('users')
              ->where('id', '=' ,$id)
              ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }
}
