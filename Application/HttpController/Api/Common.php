<?php
/**
 * User: GabrielCHEN
 * Date: 2019/3/20
 * Time: 14:10
 */

namespace App\HttpController\Api;


class Common extends AbstractBase
{
    function one()
    {
        $this->response()->write('this is api common one');
    }

    function two()
    {
        $this->response()->write('this is api common two');
    }
}
