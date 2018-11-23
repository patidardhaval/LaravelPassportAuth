<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * login page function
     *
     * @return void
     * @author
     **/
    public function login(Request $request)
    {

        if ($request->session()->has(config('custom.session_pre') . 'username')) {

            return redirect()->route('admin.home');

        } else {
            return view('login');
        }

    }

    /**
     * attempt login function
     *
     * @return void
     * @author
     **/

    public function checklogin(Request $request)
    {
        if ($request->username == 'admin') {
            $request->session()->put(config('custom.session_pre') . 'username', $request->username);
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('login');
        }

    }

    /**
     * logout function
     *
     * @return void
     * @author
     **/
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->forget(config('custom.session_pre') . 'username');
        return redirect()->route('login');
    }

    /**
     * home page function
     *
     * @return void
     * @author
     **/
    public function home(Request $request)
    {

        return view('mastergame');
    }

}
