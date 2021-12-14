<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $params         = [
            'fullName'      => Auth::user()->name,
            'username'      => Auth::user()->username,
            'avatar'        => Auth::user()->avatar,
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


    public function updateUser( Request $request, $id )
    {
        $inputs         = $request->input();
        
        if ( $request->hasFile('photo') ) 
            if( $request->file('photo')->isValid() )
                $path = Storage::putFile('avatars', $request->file('photo') );
            else
                return back()->with('flashMessage',messageErrors( 406 ) );

        $dataToUpdate   = [
            'email'         => $inputs['email'],
            'name'          => $inputs['fullName'],
            'role '         => $inputs['fullName'] ?? 'STUDENT',
            'phoneNumber'   => $inputs['phoneNumber'] ,
            'avatar'        => $path,
        ];
       

        if( $inputs['password'] )
            $dataToUpdate['password']       = Hash::make( $inputs['password'] );

        $insertedID     = DB::table('users')->where('id',$id)->update($dataToUpdate);

        var_dump($insertedID);die;




        // if( $affected )
            // return back()->with('flashMessage', messageErrors( 200 ) );
        // else
            // return back()->with('flashMessage',messageErrors( 402 ) );
    } 
    
    
    public function updateProfile( Request $request )
    {
        $inputs         = $request->input();
        
        if ( $request->hasFile('photo') ) 
            if( $request->file('photo')->isValid() )
                $path = $request->file('photo')->store('avatars');
            else
                return back()->with('flashMessage',messageErrors( 406 ) );

        $dataToUpdate   = [
            'email'         => $inputs['email'],
            'name'          => $inputs['fullName'],
            'role'          => $inputs['role'] ?? 'STUDENT',
            'phoneNumber'   => $inputs['phoneNumber'] ,
            'avatar'        => $path,
        ];
       

        if( $inputs['password'] )
            $dataToUpdate['password']       = Hash::make( $inputs['password'] );

        $insertedID     = DB::table('users')->where('id', Auth::user()->id )->update($dataToUpdate);

        if( $insertedID )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }
}
