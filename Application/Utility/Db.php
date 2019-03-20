<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:21
 */

namespace App\Utility;

use EasySwoole\EasySwoole\Config;
use Swoole\MySQL;

class Db
{
    private $db;

    function __construct()
    {
        $conf = Config::getInstance()->getConf('MYSQL');
        $this->db = new MySQL($conf['HOST'], $conf['USER'], $conf['PASSWORD'], $conf['DB_NAME']);
    }

    function dbConnector()
    {
        return $this->db;
    }
}
