<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/29
 * Time: 16:57
 */

namespace app\admin\controller;


use app\admin\model\User;
use think\Controller;

class register extends Controller
{
    function register(){
        return  $this->fetch();
    }

    function done($account,$tel,$password1,$password2,$test){
        $re1=regular_test('/^(13|15|18|19)[\d]{9}$/',$account,'账号');
        if ($re1['code']) return $re1;
        $re2=regular_test('/^[\d]{5}$/',$tel,'电话验证码');
        if ($re2['code']) return $re2;
        $re3=regular_test('/^[\d]{2,6}$/',$password1,'密码');
        if ($re3['code']) return $re3;
        $re4=regular_test('/^[\d]{2,6}$/',$password2,'确认密码');
        if ($re4['code']) return $re4;
        $re5=regular_test('/^[\d]{5}$/',$test,'验证码');
        if ($re5['code']) return $re5;
        if(yzm($test)) return yzm($test);
        $d=new User();
        $a=$d->sel($account);
        if ($a) return ['code'=>0, 'data'=>'该账户已经存在，请直接登录'] ;

        $md=md($password1);
        return $d->ins([
                'account'  =>  $account,
                'password' =>  $md['password'],
                'key' =>  $md['key'],
                'user_type' =>  2,
        ]);
    }
}