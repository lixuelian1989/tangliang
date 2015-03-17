<?php

class AccessModel extends Model {

    public function nodeList() {
        import("ORG.Util.Category");
        $cat = new Category('Node', array('id', 'pid', 'title', 'fullname'));
        $temp = $cat->getList();               //获取分类结构
        $level = array("1" => "项目（GROUP_NAME）", "2" => "模块(MODEL_NAME)", "3" => "操作（ACTION_NAME）");
        foreach ($temp as $k => $v) {
            $temp[$k]['statusTxt'] = $v['status'] == 1 ? "启用" : "禁用";
            $temp[$k]['chStatusTxt'] = $v['status'] == 0 ? "启用" : "禁用";
            $temp[$k]['level'] = $level[$v['level']];
            $list[$v['id']] = $temp[$k];
        }
        unset($temp);
        return $list;
    }

    public function roleList() {
        $M = M("Role");
        $list = $M->select();
        foreach ($list as $k => $v) {
            $list[$k]['statusTxt'] = $v['status'] == 1 ? "启用" : "禁用";
            $list[$k]['chStatusTxt'] = $v['status'] == 0 ? "启用" : "禁用";
        }
        return $list;
    }

    public function opStatus($op = 'Node') {
        $M = M("$op");
        $datas['id'] = (int) $_GET["id"];
        $datas['status'] = $_GET["status"] == 1 ? 0 : 1;
        if ($M->save($datas)) {
            return array('status' => 1, 'info' => "处理成功", 'data' => array("status" => $datas['status'], "txt" => $datas['status'] == 1 ? "禁用" : "启动"));
        } else {
            return array('status' => 0, 'info' => "处理失败");
        }
    }

    public function editNode() {
        $M = M("Node");
        return $M->save($_POST) ? array('status' => 1, info => '更新节点信息成功', 'url' => U('Access/nodeList')) : array('status' => 0, info => '更新节点信息失败');
    }

    public function addNode() {
        $M = M("Node");
        return $M->add($_POST) ? array('status' => 1, info => '添加节点信息成功', 'url' => U('Access/nodeList')) : array('status' => 0, info => '添加节点信息失败');
    }

    /**
      +----------------------------------------------------------
     * 管理员列表
      +----------------------------------------------------------
     */
    public function adminList() {
        $list = M("Admin")->select();
        foreach ($list as $k => $v) {
            $list[$k]['statusTxt'] = $v['status'] == 1 ? "启用" : "禁用";
        }
        return $list;
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function addAdmin() {
//        if (!is_email($_POST['email'])) {
//            return array('status' => 0, 'info' => "邮件地址错误");
//        }
        $datas = array();
        $M = M("Admin");
        $datas['a_name'] = trim($_POST['a_name']);
        if ($M->where("`a_name`='" . $datas['a_name'] . "'")->count() > 0) {
            return array('status' => 0, 'info' => "已经存在该账号");
        }
        #$datas['pwd'] = encrypt(trim($_POST['pwd']));
        $pwd=trim($_POST['pwd']);
        $confrim_pwd=trim($_POST['confirm_pwd']);
        if($pwd!=$confrim_pwd){
            return array("status"=>0,"info"=>"两次输入的密码不一致!");
        }
        $datas['a_pwd']=  encrypt($pwd);
        $datas['a_pwd_md5']=$pwd;
        $datas['remark']=$_POST['remark'];
        
        if ($M->add($datas)) {
            $id=$M->getLastInsID();
            
            M("RoleUser")->add(array('user_id' => $M->getLastInsID(), 'role_id' => (int) $_POST['role_id']));
            $data=$_POST['adminfo'];
            array_push($data, array("a_id"=>$id));
            M("AdminInfo")->add($data);
            
            
           // if (C("SYSTEM_EMAIL")) {
           //     $body = "你的账号已开通，登录地址：" . C('WEB_ROOT') . U("Public/index") . "<br/>登录账号是：" . $datas["email"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录密码是：" . $_POST['pwd'];
           //     $info = send_mail($datas["email"], "", "开通账号", $body) ? "添加新账号成功并已发送账号开通通知邮件" : "添加新账号成功但发送账号开通通知邮件失败";
           // } else {
                $info = "账号已开通，请通知相关人员";
           // }
            return array('status' => 1, 'info' => $info, 'url' => U("Access/index"));
            
        } else {
            return array('status' => 0, 'info' => "添加新账号失败，请重试");
        }
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function editAdmin() {
        $M = M("Admin");
        $datas=array();
        if (!empty($_POST['pwd'])) {
            $datas['a_pwd'] = encrypt(trim($_POST['pwd']));
            $datas['a_pwd_md5']=$_POST['pwd'];
        } else {
            unset($_POST['pwd']);
        }
        $user_id = (int) $_POST['aid'];
        $role_id = (int) $_POST['role_id'];
        $roleStatus = M("RoleUser")->where("`user_id`=$user_id")->save(array('role_id' => $role_id));
        $aimod=M("AdminInfo");
        $datas['status']=$_POST['status'];
        $datas['remark']=trim($_POST['remark']);
        
        $res1=$M->where("a_id=".$user_id)->save($datas);
        
        if ($res1) {  
            return $roleStatus == TRUE ? array('status' => 1, 'info' => "成功更新") : array('status' => 1, 'info' => "成功更新");
        } else {
            $res=$aimod->where("a_id=".$user_id)->save($_POST[adminfo]);
            if($res)
                return array("status"=>0,"info"=>"更新成功");
            else
            return $roleStatus == TRUE ? array('status' => 1, 'info' => "更新失败，但更改用户所属组更新成功") : array('status' => 0, 'info' => "更新失败，请重试");
        }
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function editRole() {
        $M = M("Role");
        if ($M->save($_POST)) {
            return array('status' => 1, 'info' => "成功更新", 'url' => U("Access/rolelist"));
        } else {
            return array('status' => 0, 'info' => "更新失败，请重试");
        }
    }

    /**
      +----------------------------------------------------------
     * 添加管理员
      +----------------------------------------------------------
     */
    public function addRole() {
        $M = M("Role");
        if ($M->add($_POST)) {
            return array('status' => 1, 'info' => "成功添加", 'url' => U("Access/rolelist"));
        } else {
            return array('status' => 0, 'info' => "添加失败，请重试");
        }
    }

    public function changeRole() {
        $M = M("Access");
        $role_id = (int) $_POST['id'];
        $M->where("role_id=" . $role_id)->delete();
        $data = $_POST['data'];
        if (count($data) == 0) {
            return array('status' => 1, 'info' => "清除所有权限成功", 'url' => U("Access/rolelist"));
        }
        $datas = array();
        foreach ($data as $k => $v) {
            $tem = explode(":", $v);
            $datas[$k]['role_id'] = $role_id;
            $datas[$k]['node_id'] = $tem[0];
            $datas[$k]['level'] = $tem[1];
            $datas[$k]['pid'] = $tem[2];
        }
        if ($M->addAll($datas)) {
            return array('status' => 1, 'info' => "设置成功", 'url' => U("Access/rolelist"));
        } else {
            return array('status' => 0, 'info' => "设置失败，请重试");
        }
    }

}

?>
