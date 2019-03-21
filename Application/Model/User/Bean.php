<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:25
 */

namespace App\Model\User;

use EasySwoole\Spl\SplBean;

class Bean extends SplBean
{
    protected $userId;
    protected $account;
    protected $password;
    protected $session;
    protected $addTime;

    protected function initialize(): void
    {
        if (empty($this->addTime)) {
            $this->addTime = time();
        }

        if (strlen($this->password) == 32) {
            $this->password = md5($this->password);
        }
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account): void
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session): void
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * @param mixed $addTime
     */
    public function setAddTime($addTime): void
    {
        $this->addTime = $addTime;
    }
}
