<?php

class NodeModel extends Model {
    /**
     * 获取  所有的节点
     */
    public function get_node($pid=0){
        $where="pid=".$pid." and  status=1 and is_menu=1";
        $list=$this->where($where)->order("sort asc")->select();
        
        #echo $this->getLastSql();
        
        return $list;
    }
    /**
     * 获取非管理员的节点
     */
    public function get_user_node($pid=0){
        $where="pid=".$pid." and  status=1 and is_menu=1";
        $list=M("Quanxianview")->where($where)->order("sort asc")->select();
        
        return $list;
    }
}

?>
