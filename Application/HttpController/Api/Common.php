<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:10
 */

namespace App\HttpController\Api;

use App\Model\User\Bean;
use App\Utility\SysConst;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Rule;
use EasySwoole\Validate\Validate;
use App\Model\User\User as UserModel;

class Common extends AbstractBase
{
    function register()
    {
        $this->response()->write('this is api common one');
        $rule = new Rule();
        $rule->add('account', 'account字段错误')->withRule(Validate::REQUIRED);
        $rule->add('password', 'password字段错误')->withRule(Validate::REQUIRED)
            ->withRule(Validate::MIN_LEN, 6)
            ->withRule(Validate::MAX_LEN, 16);
        $v = $this->validateParams($rule);
        if (!$v->hasError()) {
            $bean = new Bean($v->getRuleData());
            $model = new UserModel();
            $ret = $model->register($bean);
            if ($ret) {
                $this->writeJson(Status::CODE_OK, ['userId' => $ret], '注册成功');
            } else {
                $this->writeJson(Status::CODE_BAD_REQUEST, null, '注册失败，账户可能已经存在');
            }
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $v->getErrorList()->first()->getMessage());
        }
    }

    function login()
    {
        $this->response()->write('this is api common two');
        $rule = new Rule();
        $rule->add('account', 'account字段错误')->withRule(Validate::REQUIRED);
        $rule->add('password', 'password字段错误')->withRule(Validate::REQUIRED);
        $v = $this->validateParams($rule);
        if (!$v->hasError()) {
            $bean = new Bean($v->getRuleData());
            $model = new UserModel();
            $ret = $model->login($bean);
            if ($ret) {
                $this->response()->setCookie(SysConst::COOKIE_USER_SESSION_NAME, $bean->getSession(), time() + SysConst::COOKIE_USER_SESSION_TTL);
                $this->writeJson(Status::CODE_OK, $bean->toArray());
            } else {
                $this->writeJson(Status::CODE_UNAUTHORIZED, null, '账户或密码错误');
            }
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $v->getErrorList()->first()->getMessage());
        }
    }
}
