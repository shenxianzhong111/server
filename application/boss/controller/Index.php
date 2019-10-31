<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/9
 * Time: 8:57
 */
namespace app\boss\controller;

use app\boss\model\User;
use boss\Login;
use think\Db;
use think\Session;


class Index extends Login

{
    function index(){
//        if(!session('boss')){
//            $this->success('您尚未登录，请先去登录','admin/login/index');
//        }
        return $this->fetch();
    }
    function stop(){
        $stop=session('boss')[0]['account'];
        Session::destroy('boss');
        $this->success($stop.'退出成功','admin/login/index');

    }
    //删除
    function del($id){
        $data= Db::table('User')->where('id',$id)->delete();
        return[
            'code'=>0,
        ];
    }
    function edit($account,$key,$id){
        $d=new User();
        $d->up1($account,$key,$id);
    }
    function register($account){
        $account=substr($account,0,strlen($account)-1);
        $account=explode(',',$account);

        $count=0;
        foreach ($account as $val){
            $data= Db::table('User')->where('account',$val)->value('account');
            if(!$data){
                $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $len=strlen($str)-1;
                $randstr='';
                for($i=0;$i<11;$i++){
                    $num=mt_rand(0,$len);
                    $randstr .= $str[$num];
                }
                $password=md5(md5('000'.$randstr));
                $data = ['account' =>$val, 'password' =>$password,'key'=>$randstr,'error_time'=>'','user_type'=>2,'photo'=>''];
                Db::table('User')->insert($data);
                $count++;
            }
        }
//        dump($user->account);
        return [
            'success'=>'共注册成功用户'.$count.'位',
            'fail'=>'注册失败'.(count($account)-$count).'位'
        ];
    }
    function table($page,$limit){

        $date= Db::table('User')->select();
        $data['data']= Db::table('User')->limit($limit*($page-1),$limit)->select();
        $data['msg']='jjjj';
        $data['code']=0;
        $data['count']=count($date);
        return  $data;
    }
    function watch(){
//       $data= Db::table('User')->where('user_type',2)->select();
//        $this->assign('data',$data);
        return $this->fetch();
    }

}