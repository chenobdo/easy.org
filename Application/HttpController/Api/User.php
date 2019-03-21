<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:12
 */

namespace App\HttpController\Api;

use EasySwoole\Http\Message\Status;
use App\Model\User\Bean;
use App\Utility\SysConst;
use App\Model\User\User as UserModel;

class User extends AbstractBase
{
    protected $authTime;

    protected $who;

    protected function onRequest(?string $action): ?bool
    {
        $token = $this->request()->getRequestParam('token');
        if ($token == '123') {
            $this->authTime = time();
            $token = $this->request()->getCookieParams(SysConst::COOKIE_USER_SESSION_NAME);
            $bean = new Bean(['session' => $token]);
            $model = new UserModel();
            $bean = $model->sessionExist($bean);
            if ($bean) {
                $this->who = $bean;
                return true;
            } else {
                $this->writeJson(Status::CODE_UNAUTHORIZED, null, '权限验证失败');
            }
        } else {
            $this->writeJson(Status::CODE_UNAUTHORIZED, null, '权限验证失败');
            return false;
        }
    }

    function info()
    {
        $this->response()->write('auth time is ' . $this->authTime);
        $this->writeJson(Status::CODE_OK, $this->who->toArray());
    }
}
