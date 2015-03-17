<?php

/**
 * @author 李雪莲 <lixuelianlk@163.com>
 * 后台 登录
 * 2015-03-01 10:41
 */
class MyInfoAction extends CommonAction {

    public function index() {
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        
        $aimod=new Admininfo1Model();
        $a_id=$_SESSION[C('USER_AUTH_KEY')];
        $info=$aimod->getinfo($a_id);
        $this->assign("info",$info);
        
        $this->display();
    }
    /**
     * 编辑个人信息
     */
    public function editinfo(){
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        if(IS_POST){
            $uid=$_POST['uid'];
            $info=$_POST['info'];
            $amod=M("AdminInfo");
            $re=$amod->where("a_id=".$uid)->save($info);
            if($re){
                //记录管理员 log --------start
                $logmod=new LogModel();
                $logmod->addlog("修改了[个人信息]");
                //记录管理员 log --------end
                
                $this->success("操作成功",U("MyInfo/index"));
            }else{
                $this->error("没有更改任何内容");
            }
            exit;
        }
        $uid=$_GET['uid'];
        $amod=new Admininfo1Model();
        $info=$amod->getinfo($uid,0);
        $this->assign("info",$info);
        
        $this->display();
    }
    /**
     * 更改密码
     */
    public function updatepwd(){
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        if(IS_POST){
            $a_id=$_SESSION[C('USER_AUTH_KEY')];
            $oldpwd=trim($_POST['oldpwd']);
            $oldpwd_md5=  encrypt($oldpwd);
            $newpwd=trim($_POST['newpwd']);
            $newpwd_md5=  encrypt($newpwd);
            $newpwd2=  trim($_POST['newpwd2']);
            
            if($newpwd!=$newpwd2){
                $this->error("两次输入的密码不一致");
                exit;
            }
            $mod=M("Admin");
            $ainfo=$mod->where("a_id=".$a_id)->find();
            if($ainfo['a_pwd']!=$oldpwd_md5){
                $this->error("原来的密码输入错误");
                exit;
            }
            //修改密码
            $data=array(
                "a_pwd"=>$newpwd_md5,
                "a_pwd_md5"=>$newpwd
            );
            $res=$mod->where("a_id=".$a_id)->save($data);
            if($res){
                
                $logmod=new LogModel();
                $logmod->addlog("修改了[密码]");
                
                $this->success("操作成功");
                exit;
            }else{
                $this->error("操作失败");
                exit;
            }
        }
        $this->display();
    }
    
}
