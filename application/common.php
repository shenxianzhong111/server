<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function regular_test($regular,$val,$obj){
    $result=preg_match($regular, $val);
    if(!$result){
        return [
          'code'=>0,
            'data'=>'输入'.$obj.'格式不正确!'
        ];
    }
}
function yzm($test){
    if(!captcha_check($test)){
        return[
            'code'=>0,
            'data'=>'验证码错误，请重新输入验证码 '
        ];
    }
}

function md($password){
    $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $len=strlen($str)-1;
    $randstr='';
    for($i=0;$i<11;$i++){
        $num=mt_rand(0,$len);
        $randstr .= $str[$num];
    }
    return [
        'password'=>md5(md5($password.$randstr)),
        'key'=>$randstr
    ];
}