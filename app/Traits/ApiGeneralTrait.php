<?php

namespace App\Traits;

trait ApiGeneralTrait
{
    //return an error message for api request
    public function returnErrorMsg($error_num, $msg) {
        return response()->json([
            'status' => false,
            'error' => $error_num,
            'message' => $msg
        ]);
    }

    //return a success message and data for api request
    public function returnSuccessMsg($msg, $error_num = '000') {
        return response()->json([
            'status' => true,
            'error' => $error_num,
            'message' => $msg,
        ]);
    }

    //return a success message and data for api request
    public function returnData($key, $value, $msg) {
        return response()->json([
            'status' => true,
            'error' => 000,
            'message' => $msg,
            $key => $value
        ]);
    }

}
