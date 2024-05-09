<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function apiResponse($success , $message , $data = null ,$formateDate, $statusCode = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'date'=>$formateDate,
        ],$statusCode);
    }

    // protected function successResponse($success , $message , $data = null , $statusCode = 200)
    // {
    //     return $this->apiResponse(true , $message , $data , $statusCode);
    // }

    protected function errorResponse( $message ,  $statusCode = 400)
    {
        return $this->apiResponse(false , $message , null , $statusCode);
    }

    // protected function notfoundResponse( $message )
    // {
    //     return response()->json([
    //         'status' => false,
    //         'message' => $message,
    //         'code' => 404
    //     ]);
    // }
}
