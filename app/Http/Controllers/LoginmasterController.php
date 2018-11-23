<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RestHelper as rh;
use Session;

class LoginmasterController extends Controller
{
    /**
     * login page function
     *
     * @return void
     * @author
     **/
    public function login(Request $request)
    {
        if ($request->session()->has(config('custom.session_pre').'quickuser')) {

            return redirect()->route('home');

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

        $para = [
            "username" => $request->username,
            "password" => $request->password,
            "IP"       => \Request::ip(),
            "Browser"  => $request->header('User-Agent'),
        ];

        $route = "login";

        $data = rh::callQuick('login', $para);
        

        if (is_array($data)) {
            Session::flash('message', $data['message']);
        }

        if (isset($data->status) && $data->status == 200) {
            if (isset($data->data->id) && $data->data->id == 1) {
                $request->session()->put(config('custom.session_pre').'quickuser', $request->username);
                $request->session()->put(config('custom.session_pre').'jwttoken', $data->token);
                $request->session()->put(config('custom.session_pre').'hashmake', sha1(time(true)));
                $route = 'home';
            } else {
                $route = 'login';
            }
        }

        return redirect()->route($route);
    }

    /**
     * logout function
     *
     * @return redirect
     * @author
     **/
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->forget(config('custom.session_pre').'jwttoken');
        return redirect()->route('login');
    }

}