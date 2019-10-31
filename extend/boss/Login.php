<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/11
 * Time: 20:46
 */
namespace boss;

use think\Controller;

class Login extends Controller
{
    function _initialize()
    {
        if(!session('boss')){
            $this->error('您尚未登录，请先去登录','admin/login/index');
        }
        //return $this->fetch();
    }

}