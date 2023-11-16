<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //  index
    public function index(Request $request)
    {
        //  menghapus session
        //  **
        $request->session()->forget('sesiis_userid');
        $request->session()->forget('sesiis_username');
        $request->session()->forget('sesiis_level');
        $request->session()->forget('sesiis_dept');

        //  return view
        //  **
        return view('login');
    }
    //  post login
    public function postLogin(Request $request)
    {
        // return $_SERVER;
        $server_name = (isset($_SERVER['SERVER_NAME']))? // check if SERVER_NAME is set
        $_SERVER['SERVER_NAME'] :                    // if yes, use HTTP header value
        php_uname("n");
        // return $_POST;
        //  daftarpustaka
        //  https://www.parthpatel.net/php-json-decode-function/

        //  variable
        $userid     = $request->username;
        $userpass   = $request->password;

        //  cek ip access
        //  **
        // if (str_contains($_SERVER['SERVER_NAME'], '136.198.117.') || str_contains($_SERVER['SERVER_NAME'], 'localhost'))
        // {
            //  mengambil data dari json
            //  **
            // $response = Http::get('http://136.198.117.118/custom_backend/response/cek_login.php', [
            $response = Http::get('https://svr1.jkei.jvckenwood.com/custom_backend/response/cek_login.php', [
                'userid' => $userid,
                'userpass' => $userpass,
                'ipaddress' => getenv("REMOTE_ADDR"),
                // 'sql'        => "call sync_check_login {$userid}, {$userpass}, {getenv(\"REMOTE_ADDR\")}"
            ]);
            // return $response;
        // }
        // else
        // {
        //     //  mengambil data dari json
        //     //  **
        //     $response = Http::get('https://svr1.jvckenwood.co.id/custom_backend/response/cek_login.php', [
        //         'userid' => $userid,
        //         'userpass' => $userpass,
        //         'ipaddress' => getenv("REMOTE_ADDR"),
        //         // 'sql'        => "call sync_check_login {$userid}, {$userpass}, {getenv(\"REMOTE_ADDR\")}"
        //     ]);
        // }

        //  cek response message
        //  **
        // $obj = json_decode($response);
        // return $obj;
        if ($response['message'] == 'Failure')
        {
            return redirect('/login')->with('status', 'Wrong email and password combination.');
        }

        //  buat session
        //  **
        $request->session()->put('sesiis_userid',$response['data']["userid"]);
        $request->session()->put('sesiis_username',$response['data']["username"]);
        $request->session()->put('sesiis_level',$response['data']["level"]);
        $request->session()->put('sesiis_dept',$response['data']["dept"]);

        //  return view
        //  **
        return redirect('/inpermonth');
    }
}
