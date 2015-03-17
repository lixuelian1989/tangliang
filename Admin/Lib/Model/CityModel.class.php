<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CityModel
 *
 * @author 李雪莲 <lixuelianlk@163.com>
 */
class CityModel extends Model {
    /**
     * 城市列表
     */
    public function citylist() {
        import("ORG.Util.Category");
        $cat = new Category('Area', array('region_id', 'parent_id', 'region_name', 'fullname'));
        $temp = $cat->getList();               //获取分类结构
        $level = array("0" => "国家", "1" => "省/直辖市", "2" => "市","3"=>"区/县");
        $list=array();
        foreach ($temp as $k => $v) {
            $temp[$k]['statusTxt'] = $v['agency_id'] == 1 ? "启用" : "禁用";
            $temp[$k]['chStatusTxt'] = $v['agency_id'] == 0 ? "启用" : "禁用";
            $temp[$k]['level'] = $level[$v['region_type']];
            $list[$v['region_id']] = $temp[$k];
        }
        unset($temp);
        return $list;
        
    }
    /**
     * 获取省份
     */
    public function getprovince($fid){
        $mod=M("Area");
        $list=$mod->where("parent_id=".$fid)->select();
        return $list;
    }
    /**
     * 获取province 下的所有city
     */
    public function getcity($id){
        $mod=M("Area");
        $list=$mod->where("parent_id=".$id." and agency_id=1")->select();
        return $list;
    }
    /**
     * 根据id获取 省份或者城市名称
     */
    public function getname($id){
        $mod=M("Area");
        $list=$mod->where("region_id=".$id." and agency_id=1")->field("region_name")->find();
        return $list['region_name'];
    }

}
