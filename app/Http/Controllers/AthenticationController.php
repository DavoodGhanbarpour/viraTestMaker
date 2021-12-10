<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AthenticationController extends Controller
{

    public function index()
    {
        if( !Auth::check() )
            return view('pages.login.index');
        else
            return redirect('dashboard');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        
        if( $request->input('username') == '' || $request->input('password') == '' )
            return back()->with('flashMessage', messageErrors( 401 ) );


        $credentials = $request->validate([
            'username'  => ['required'],
            'password'  => ['required'],
        ]);
        
        if ( Auth::attempt($credentials) ) 
        {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
       
        return back()->with('flashMessage', messageErrors( 403 ) );
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('flashMessage', messageErrors(201) );
    }


}