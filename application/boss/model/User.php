<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/28
 * Time: 14:43
 */

namespace app\boss\model;
use think\Model;
class User extends Model
{
    function up1($account,$key,$id){
        $User = User::get($id);

        echo $account;

        $User->account     = $account;
       echo $User->account ;
//        $User->key    = $key;
        $User->save();
        //return 111;
    }
}