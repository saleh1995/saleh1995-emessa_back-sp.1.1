<?php 

namespace App\Http\Traits;


trait ApiResponseTrait{


  public function apiResponse($data, $message, $status=200, $success=true){
    $responseData = [
      'data' => $data,
      'message' => $message,
      'success' => $success,
      'status' => $status,
    ];


    return response()->json($responseData, $status);
  }
}