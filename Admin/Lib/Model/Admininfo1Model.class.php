<?php

class Admininfo1Model extends Model {
    /**
     * 获取登录的后台管理员的所有信息
     */
    public function getinfo($a_id,$is_cl=1){
        if($_SESSION[C("ADMIN_AUTH_KEY")]){
            //超级管理员
            $map=array("a_id=".$a_id);
            $list=M("admininfoview")->where($map)->find();
            if($is_cl==1)
            $list['a_sex']=$list['a_sex']==1?"男":"女";
            return $list;
        }
    }
    
}

?>
