<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:16
 */

namespace App\HttpController\Api;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;

class Index extends Controller;
{

    //测试路径 /index.html
    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write('hello world');
    }

    //测试路径 /test/index.html
    function test()
    {
        $this->response()->write('index controller test');
    }

    /*
     * protected 方法对外不可见
     *  测试路径 /hide/index.html
     */
    protected function hide()
    {
        var_dump('this is hide method');
    }

    protected function actionNotFound($action): void
    {
        $this->response()->withStatus(Status::CODE_NOT_FOUND);
        $this->response()->write("{$action} is not exist");
    }
}
