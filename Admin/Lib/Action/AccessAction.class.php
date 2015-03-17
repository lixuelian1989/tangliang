<?php

class AccessAction extends CommonAction {

    /**
      +----------------------------------------------------------
     * 管理员列表
      +----------------------------------------------------------
     */
    public function index() {
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);

        $this->assign("list", D("Access")->adminList());
        $this->display();
    }

    public function nodeList() {
        parent::_initalize();
        $systemConfig=  $this->systemConfig;
        $this->assign("systemConfig",$systemConfig);
        $this->assign("list", D("Access")->nodeList());
        $this->display();
    }

    public function roleList() {
        parent::_initalize();
        $systemConfig=  $this->systemConfig;
        $this->assign("systemConfig",$systemConfig);
        
        $this->assign("list", D("Access")->roleList());
        $this->display();
    }

    public function addRole() {
        parent::_initalize();
        $systemConfig=$this->systemConfig;
        $this->assign("systemConfig",$systemConfig);
        
        if (IS_POST) {
            $this->checkToken();
            #header('Content-Type:application/json; charset=utf-8');
            $res=D("Access")->addRole();
            if($res['status']){
                $this->success($res['info'],$res['url']);
            }
            else{
                $this->error($res['info']);
            }
            exit;
        } else {
            $this->assign("info", $this->getRole());
            $this->display("editRole");
        }
    }

    public function editRole() {
        parent::_initalize();
        $systemConfig=  $this->systemConfig;
        $this->assign("systemConfig",$systemConfig);
        if (IS_POST) {
            $this->checkToken();
            $msg=D("Access")->editRole();
            if($msg['status']){
                $this->success($msg['info'],$msg['url']);
            }else{
                $this->error($msg['info']);
            }
            exit;
        } else {
            $M = M("Role");
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if (empty($info['id'])) {
                $this->error("不存在该角色", U('Access/rolelist'));
            }
            $this->assign("info", $this->getRole($info));
            $this->display();
        }
    }

    public function opNodeStatus() {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(D("Access")->opStatus("Node"));
    }

    public function opRoleStatus() {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(D("Access")->opStatus("Role"));
    }

    public function opSort() {
        $M = M("Node");
        $datas['id'] = (int) $this->_post("id");
        $datas['sort'] = (int) $this->_post("sort");
        header('Content-Type:application/json; charset=utf-8');
        if ($M->save($datas)) {
            echo json_encode(array('status' => 1, 'info' => "处理成功"));
        } else {
            echo json_encode(array('status' => 0, 'info' => "处理失败"));
        }
    }

    public function editNode() {
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
            
        if (IS_POST) {
            $this->checkToken();
            header('Content-Type:application/json; charset=utf-8');
            #echo json_encode();
            $resmsg=D("Access")->editNode();
            if($resmsg['status']){
                $this->success($resmsg['info']);
            }else{
                $this->error($resmsg['info']);
            }
            exit;
        } else {
            $M = M("Node");
            $info = $M->where("id=" . (int) $_GET['id'])->find();
            if (empty($info['id'])) {
                $this->error("不存在该节点", U('Access/nodelist'));
            }
            $this->assign("info", $this->getPid($info));
            $this->display();
        }
    }

    public function addNode() {
        parent::_initalize();
        
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        
        if (IS_POST) {
            $this->checkToken();
            #header('Content-Type:application/json; charset=utf-8');
            $msg=D("Access")->addNode();
            if($msg['status']){
                $this->success($msg['info']);
            }else{
                $this->error($msg['info']);
            }
            exit;
        } else {
            $this->assign("info", $this->getPid(array('level' => 1)));
            $this->display("editNode");
        }
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function addAdmin() {
        if (IS_POST) {
            //保存账户
            $this->checkToken();

            $acmod = new AccessModel();
            $info = $acmod->addAdmin();
            if ($info['status'] == 1) {
                $this->success($info['info'], $info['url']);
            } else {
                $this->error($info['info']);
            }
        } else {
            parent::_initalize();
            $systemConfig = $this->systemConfig;
            $this->assign("systemConfig", $systemConfig);

            $this->assign("info", $this->getRoleListOption(array('role_id' => 0)));
            $this->display();
        }
    }

    public function delAdmin() {
        $M = M("Admin");
        $aid = (int) $_GET['aid'];
        $map['a_id'] = $aid;
        $rum = M("RoleUser");
        $map2 = array("user_id" => $aid);
        $res_role = $rum->where($map2)->delete(); //删除角色
        if ($res_role) {
            //删除用户详情
            $uim = M("AdminInfo");
            $res3 = $uim->where($map)->delete();
            if ($res3) {
                if ($M->where($map)->delete()) {
                    $this->success("管理员删除成功");
                } else {
                    $this->error("管理员删除失败");
                }
            } else {
                $this->error("用户详情删除失败");
            }
        } else {
            $this->error("用户角色删除失败");
        }
    }

    public function changeRole() {
        //header('Content-Type:application/json; charset=utf-8');
        parent::_initalize();
        $systemConfig=$this->systemConfig;
        $this->assign("systemConfig",$systemConfig);
        if (IS_POST) {
            $this->checkToken();
            $resrole=D("Access")->changeRole();
            if($resrole['status']){
                $this->success($resrole['info'],$resrole['url']);
            }else{
                $this->error($resrole['info']);
            }
            exit;
        } else {
            $M = M("Node");
            $info = M("Role")->where("id=" . (int) $_GET['id'])->find();
            if (empty($info['id'])) {
                $this->error("不存在该用户组", U('Access/rolelist'));
            }
            $access = M("Access")->field("CONCAT(`node_id`,':',`level`,':',`pid`) as val")->where("`role_id`=" . $info['id'])->select();
            $info['access'] = count($access) > 0 ? json_encode($access) : json_encode(array());
            $this->assign("info", $info);
            $datas = $M->where("level=1")->select();
            foreach ($datas as $k => $v) {
                $map['level'] = 2;
                $map['pid'] = $v['id'];
                $datas[$k]['data'] = $M->where($map)->select();
                foreach ($datas[$k]['data'] as $k1 => $v1) {
                    $map['level'] = 3;
                    $map['pid'] = $v1['id'];
                    $datas[$k]['data'][$k1]['data'] = $M->where($map)->select();
                }
            }
            $this->assign("nodeList", $datas);
            $this->display();
        }
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function editAdmin() {
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);

        if (IS_POST) {
            $this->checkToken();
            header('Content-Type:application/json; charset=utf-8');
            $msginfo = D("Access")->editAdmin();
            if ($msginfo['status']) {
                $this->success($msginfo['info']);
            } else {
                $this->error($msginfo['info']);
            }
        } else {
            $M = M("Admin");
            $aid = (int) $_GET['aid'];
            $pre = C("DB_PREFIX");
            $info = $M->where("`a_id`=" . $aid)->join($pre . "role_user ON " . $pre . "admin.a_id = " . $pre . "role_user.user_id")->find();

            if (empty($info['a_id'])) {

                #echo $M->getLastSql();exit;

                $this->error("不存在该管理员ID", U('Access/index'));
            }
            if ($info['a_name'] == C('ADMIN_AUTH_KEY')) {
                $this->error("超级管理员信息不允许操作", U("Access/index"));
                exit;
            }
            $this->assign("info", $this->getRoleListOption($info));
            $aimod = new Admininfo1Model();
            $ainfo = $aimod->getinfo($aid, 0);
            $this->assign("ainfo", $ainfo);

            $this->display("addadmin");
        }
    }
    
    /**
     * 查看详情
     */
    public function ins(){
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        $aid=$_GET['aid'];
        $amod=new Admininfo1Model();
        $inf=$amod->getinfo($aid,1);
        $this->assign("info",$inf);
        
        $this->display();
    }
    
    private function getRole($info = array()) {
        import("ORG.Util.Category");
        $cat = new Category('Role', array('id', 'pid', 'name', 'fullname'));
        $list = $cat->getList();               //获取分类结构
        foreach ($list as $k => $v) {
            $disabled = $v['id'] == $info['id'] ? ' disabled="disabled"' : "";
            $selected = $v['id'] == $info['pid'] ? ' selected="selected"' : "";
            $info['pidOption'].='<option value="' . $v['id'] . '"' . $selected . $disabled . '>' . $v['fullname'] . '</option>';
        }
        return $info;
    }

    private function getRoleListOption($info = array()) {
        import("ORG.Util.Category");
        $cat = new Category('Role', array('id', 'pid', 'name', 'fullname'));
        $list = $cat->getList();               //获取分类结构
        $info['roleOption'] = "";
        foreach ($list as $v) {
            $disabled = $v['id'] == 1 ? ' disabled="disabled"' : "";
            $selected = $v['id'] == $info['role_id'] ? ' selected="selected"' : "";
            $info['roleOption'].='<option value="' . $v['id'] . '"' . $selected . $disabled . '>' . $v['fullname'] . '</option>';
        }
        return $info;
    }

    private function getPid($info) {
        $arr = array("请选择", "项目", "模块", "操作");
        for ($i = 1; $i < 4; $i++) {
            $selected = $info['level'] == $i ? " selected='selected'" : "";
            $info['levelOption'].='<option value="' . $i . '" ' . $selected . '>' . $arr[$i] . '</option>';
        }
        $level = $info['level'] - 1;
        import("ORG.Util.Category");
        $cat = new Category('Node', array('id', 'pid', 'title', 'fullname'));
        $list = $cat->getList();               //获取分类结构
        $option = $level == 0 ? '<option value="0" level="-1">根节点</option>' : '<option value="0" disabled="disabled">根节点</option>';
        foreach ($list as $k => $v) {
            $disabled = $v['level'] == $level ? "" : ' disabled="disabled"';
            $selected = $v['id'] != $info['pid'] ? "" : ' selected="selected"';
            $option.='<option value="' . $v['id'] . '"' . $disabled . $selected . '  level="' . $v['level'] . '">' . $v['fullname'] . '</option>';
        }
        $info['pidOption'] = $option;
        return $info;
    }
    

}
