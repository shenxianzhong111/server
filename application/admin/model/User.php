<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/30
 * Time: 20:08
 */
namespace app\admin\model;

use think\Model;

class User extends Model
{
     function sel($account){
         $User = User::get(['account' => $account]);
         return $User;
     }
     function ins($data){
         $user = new User;
         $user->data($data);
         $user->save();
         if ($user) {
             return ['code'=>1,'data'=>'恭喜你'.$user->account.'，注册成功'];
         }else{
             return ['code'=>0,'data'=>$user->account.'，注册失败'];
         }

     }
}