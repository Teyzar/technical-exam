<?php 

    namespace App\Traits;

    trait HttpResponses {
        protected function success($data, $count = null, $message=null, $code=200) {
            return response()->json([
                'status' => 'Success',
                'message' => $message,
                'data' => $data
            ], $code);
        }

        protected function error($data, $message=null, $code) {
            return response()->json([
                'status' => 'Error',
                'message' => $message,
                'data' => $data
            ], $code);
        }
    }

?>