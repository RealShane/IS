<?php


namespace app\common\exception;


use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;
use Throwable;


class Http extends Handle
{
    public function render($request, Throwable $e): Response
    {
        return json([
            'status' => config('status.failed'),
            'message' => $e -> getMessage(),
            'result' => NULL
        ]);
//        echo json_encode($e instanceof HttpException );exit();
//        // 参数验证错误
//        if ($e instanceof ValidateException) {
//            return json($e->getError(), 422);
//        }
//
//        // 请求异常
//        if ($e instanceof HttpException && $request->isAjax()) {
//            return response($e->getMessage(), $e->getStatusCode());
//        }
//
//        // 其他错误交给系统处理
//        return parent::render($request, $e);
    }

}

