<?php
namespace App\Helpers;

use Session;

class RestHelper
{
    public static $url = '';

    /**
     * Call Rest Api
     *
     * @return void
     * @author
     **/

    public static function callRest($qpara, $para = [], $debug = 0, $method = 'POST')
    {
        if ($debug == 1) {

            return json_encode([
                "url"  => self::$url . $qpara,
                "para" => http_build_query($para),
                "jwt"  => Session::get(config('custom.session_pre') . 'jwttoken'),
            ]);
        }
        try {

            $client = new \GuzzleHttp\Client();
            $jwt    = (Session::has(config('custom.session_pre') . 'jwttoken')) ? Session::get(config('custom.session_pre') . 'jwttoken') : '';

            $request = $client->request($method, self::$url . $qpara, [
                'form_params' => $para,
                'headers'     => [
                    'Authorization' => 'bearer ' . $jwt,
                    'Accept'        => 'application/json',
                ],
            ]);

            $json = $request->getBody();
            $data = json_decode($json);

            $status = $request->getStatusCode();

            if ($status == 200) {

                $json = $request->getBody();
                $data = json_decode($json);

                $response->status = isset($data->status) ? $data->status : 500;

                if ($data->status == 200) {
                    $response = $data; // ok response
                } elseif ($data->status == 100) {
                    /* para mismach or validation not pass */
                    if (config("app.env") == 'production') {
                        $response->msg = "Something Misssing....";
                    } else {

                        $response->msg = $data->message;
                    }
                } elseif ($data->status == 300) {

                    $response->msg = $data->message;

                } elseif ($data->status == 400) {
                    if (config("app.env") == 'production') {
                        $response->msg = "Invalid request";
                    }

                } elseif ($data->status == 401) {
                    session()->flush();
                } else {
                    $response->msg = "Unknown Error";
                }

            } else {
                throw new \Exception('Failed');
            }

        } catch (\Exception $e) {

            $err         = new \stdClass();
            $err->status = $e->getCode();

            if (config("app.env") == 'production') {
                $err->message = "Server Exception";
            } else {
                $err->message = $e->getMessage();
            }

            if ($e->getCode() == '401') {
                session()->flush();
            }
            return $err;

        }

        return $response;
    }

    public static function callQuick($qpara = '', $para = [], $debug = 0)
    {
        self::$url = config('custom.url_s');
        return self::callRest($qpara, $para, $debug);
    }

}
