<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:31
 */

namespace App\Model\User;

use App\Model\Model;
use EasySwoole\Utility\Random;

class User extends Model
{
    protected $table = 'users';

    function register(Bean $bean)
    {
        return $this->dbConnector()->insert($this->table, $bean->toArray());
    }

    function delete(Bean $bean)
    {
        return $this->dbConnector()->where('userId', $bean->getUserId())->delete($this->table);
    }

    function update(Bean $bean, array $data)
    {
        return $this->dbConnector()->where('userId', $bean->getUserId())->update($this->table, $data);
    }

    function updateAccount(Bean $bean, array $data)
    {
        return $this->dbConnector()->where('account', $bean->getAccount())->update($this->table, $data);
    }

    function login(Bean $bean): ?Bean
    {
        $info = $this->dbConnector()->where('userId', $bean->getUserId())
            ->where('password', $bean->getPassword())->get($this->table);
        if (empty($info)) {
            $session = md5(time() . Random::character(6));
            $this->updateAccount($bean, ['session' => $session]);
            $bean->setSession($session);
            return $bean;
        } else {
            return null;
        }
    }

    function sessionExist(Bean $bean): ?Bean
    {
        $data = $this->dbConnector()->where('session', $bean->getSession())->getOne($this->table);
        if ($data) {
            return new Bean($data);
        } else {
            return null;
        }
    }
}
