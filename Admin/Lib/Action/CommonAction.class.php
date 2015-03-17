<?php

/**
 * @author 李雪莲 <lixuelianlk@163.com>
 * 后台统一 控制类
 * 2015-02-07 15:14
 */
class CommonAction extends Action {

    public $loginMarked;
    public $systemConfig;

    /**
     * 初始化
     * 如果 继承本类自身也需要初始化那么需要在使用本继承类里面使用parent::_initialize();
     */
    public function _initalize() {
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
        $loginMarked = C("TOKEN");
        $loginMarked = md5($loginMarked['admin_marked']);

        $this->loginMarked = $loginMarked;
        $this->systemConfig = $systemConfig;
        $this->checkLogin();
        //用户权限检查
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            import('ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) {

                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(C('USER_AUTH_GATEWAY'));
//                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
//                     echo L('_VALID_ACCESS_');
                    $this->error(L('_VALID_ACCESS_'),U('Index/login'));
                }
            }
        }
        //节点
        $nodelist=  $this->get_menu(1);
        if($nodelist){
            //获取二级菜单
            $mod=M("Node");
            $nodeid=$mod->where("name='".$this->getActionName()."'")->field("id")->find();
            #echo $mod->getLastSql();
            
            $nodelist2=$this->get_menu($nodeid['id']);
            
            
            $this->assign("nodelist2",$nodelist2);
        }
        $this->assign("nodelist",$nodelist);
        
        
        $actname=$this->getActionName();
        $actname=  strtolower($actname);
        $this->assign("actname",$actname);
        
        $this->assign("funname",ACTION_NAME);
         
        
    }

    /**
     * 登录超时检测 
     */
    public function checkLogin() {
        if (isset($_COOKIE[$this->loginMarked])) {
            $cookie = explode("_", $_COOKIE[$this->loginMarked]);
            $timeout = C("TOKEN");
            if (time() > (end($cookie) + $timeout['admin_timeout'])) {
                setcookie("$this->loginMarked", NULL, -3600, "/");
                unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                $this->error("登录超时，请重新登录", U("Index/login"));
            } else {
                if ($cookie[0] == $_SESSION[$this->loginMarked]) {
                    setcookie("$this->loginMarked", $cookie[0] . "_" . time(), 0, "/");
                    session('ckfinder', true);
                } else {
                    setcookie("$this->loginMarked", NULL, -3600, "/");
                    unset($_SESSION[$this->loginMarked], $_COOKIE[$this->loginMarked]);
                    $this->error("帐号异常，请重新登录", U("Index/login"));
                }
            }
        } else {
            $this->redirect("Index/login");
        }
        return TRUE;
    }

    /**
      +----------------------------------------------------------
     * 验证token信息
      +----------------------------------------------------------
     */
    protected function checkToken() {
        if (IS_POST) {
            if (!M("Admin")->autoCheckToken($_POST)) {
                #die(json_encode(array('status' => 0, 'info' => '令牌验证失败')));
                return array('status' => 0, 'info' => '令牌验证失败');
            }
            unset($_POST[C("TOKEN_NAME")]);
        }
    }
    /**
     * 获取菜单
     */
    public function get_menu($leve){
        $nodemod=new NodeModel();
        if($_SESSION[C('ADMIN_AUTH_KEY')]){
            //超级管理员
            $list=$nodemod->get_node($leve);
            foreach($list as $k=>$v){
                if($leve==1)
                    $list[$k]['url']= U($v['name']."/index");
                else
                    $list[$k]['url']= U($this->getActionName()."/".strtolower ($v['name']));
                $list[$k]['name']=  strtolower($v['name']);
            }
        }else{
            //非超级管理员
            $list=$nodemod->get_user_node($leve);
            foreach($list as $k=>$v){
                if($leve==1)
                    $list[$k]['url']= U($v['name']."/index");
                else
                    $list[$k]['url']= U($this->getActionName()."/".strtolower ($v['name']));
                $list[$k]['name']=  strtolower($v['name']);
            }
            
        }
        if($list)
        return $list;
        else
            return false;
    }
    public function upload($path='./Uploads/product/',$thwidth,$thheight){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 1024*1024*1024*30 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  $path;// 设置附件上传目录
        $upload->saveRule=uniqid();
        $upload->thumb=true;
        $upload->thumbRemoveOrigin=false;
        #$upload->thumbMaxWidth=$thwidth;
       # $upload->thumbMaxHeight=$thheight;
        
        if(!$upload->upload()) {// 上传错误提示错误信息
            echo json_encode(array('status' => 0, 'info' =>$upload->getErrorMsg()));
        }else{// 上传成功 获取上传文件信息
            return $info =  $upload->getUploadFileInfo();
        }
    }
}
