<?php
function success($key, $dbob, $status = 200, $message = '')
{
    $data                                = new \stdClass();
    $data->success['status']  = $status;
    $data->success['message'] = $message;
    $data->success['data']    = [
        $key => $dbob,

    ];
    return $data;
}
function errro($status, $message)
{
    $data                            = new \stdClass();
    $data->error['status']  = $status;
    $data->error['message'] = $message;
    return $data;
}
