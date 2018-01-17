<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 验证
     * @param Request $request
     * @return array|bool
     */
    public function verify(Request $request, $validation)
    {
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return array_map(function ($error) {
                return array_shift($error);
            }, $validator->errors()->messages());
        }
        return true;
    }

    /**
     * @param $msg
     * @param array $data
     * @return array
     */
    public function success($data = [] , $msg = 'success')
    {
        return [
            'code' => 0,
            'message' => $msg,
            'data' => $data
        ];
    }

    /**
     * @param $msg
     * @return array
     */
    public function failed($msg)
    {
        return [
            'code' => 1,
            'error' => $msg
        ];
    }

}
