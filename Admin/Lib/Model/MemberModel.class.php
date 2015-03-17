<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberModel
 *
 * @author 李雪莲 <lixuelianlk@163.com>
 */
class MemberModel extends Model {
    /**
     * 检查用户名是否存在
     * @param type $name
     * @return type
     */
    public function check_name($name){
        $map=array("a_name"=>$name);
        return $this->where($map)->count();
    }
    /**
     * 添加会员
     * @param type $data
     * @param type $fujdata
     * @return int
     */
    public function add_member($data,$fujdata){
        
            $res=$this->add($data);
            if($res){
                $id=  $this->getLastInsID();
                //普通会员
                if($data['a_type']==1){
                    $mod=M("Webmember");
                    $fujdata['a_id']=$id;
                    $res2=$mod->add($fujdata);
                    
                    if($res2){
                        $return=array("status"=>1,"info"=>"会员添加成功");
                    }else{
                        $this->where(array("a_id"=>$id))->delete();
                        $return=array("status"=>0,"info"=>"附加信息添加失败");
                    }
                }else if($data['a_type']==2){
                    //工长
                    $mod=M("ForemanInfo");
                    $fujdata['f_id']=$id;
                    $res2=$mod->add($fujdata);
                    if($res2){
                        $return=array("status"=>1,"info"=>"会员添加成功");
                    }else{
                        $this->where(array("a_id"=>$id))->delete();
                        $return=array("status"=>0,"info"=>"附加信息添加失败");
                    }
                }else if($data['a_type']==3){
                    //店铺
                    $mod=M("Dianpu");
                    $fujdata['f_id']=$id;
                    $res2=$mod->add($fujdata);
                    if($res2){
                        $return=array("status"=>1,"info"=>"会员添加成功");
                    }else{
                        $this->where(array("a_id"=>$id))->delete();
                        $return=array("status"=>0,"info"=>"附加信息添加失败");
                    }
                }
                
                
                
                
            }else{
                $return=array("status"=>0,"info"=>"会员添加失败");
            }
        return $return;
    }
    /**
     * 获取年
     * @return int
     */
    public function getyear(){
        $year=array();
        $k=0;
        for($i=1990;$i<=date("Y");$i++){
            $year[$k]=$i;
            $k++;
        }
        return $year;
    }
    /**
     * 获取月
     * @return int
     */
    public function getmonth(){
        $year=array();
        $k=0;
        for($i=1;$i<=12;$i++){
            $year[$k]=$i;
            $k++;
        }
        return $year;
    }
    /**
     * 获取日
     * @return int
     */
    public function getday($year,$month){
        $day=array();
        $k=0;
        if($year%4==0&&$month==2){
            $end=29;
        }else{
            $end=28;
        }
        
        if($month==1||$month==3||$month==5||$month==7||$month==8||$month==10||$month==12){
            $end=31;
        }
        
        if($month==4||$month==6||$month==9||$month==11){
            $end=30;
        }
        
        for($i=1;$i<=$end;$i++){
            $day[$k]=$i;
            $k++;
        }
        return $day;
    }
    
    
    
    
}
