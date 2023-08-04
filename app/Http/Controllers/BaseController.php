<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /* return success error ....
     * @param
     */
    public function sendResponse($result,$message){
        $response = [
            'success'   => true,
            'data'      => $result,
            'message'   => $message,
        ];
        return response()->json($response,200);
    }

    /*
     * return error
     * @param string error
     */

    public function sendError($error,$errorMessage = [],$code = 400){
        $response = [
            'success'   => false,
            'message'   => $error,
        ];

        if(!empty($errorMessage)){
                $response['data']  =  $errorMessage;
        }
        return response()->json($response,$code);
    }

}
