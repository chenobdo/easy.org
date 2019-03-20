<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:31
 */

namespace App\Model\User;

use App\Model\Model;

class User extends Model
{
    protected $table = 'users';

    function register(Bean $bean)
    {
        return $this->dbConnector()->insert($this->table, $bean->toArray());
    }

    function delete(Bean $bean)
    {
        
    }
}
