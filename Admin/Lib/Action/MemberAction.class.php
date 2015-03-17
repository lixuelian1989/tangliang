<?php

/**
 * 
 * @author 李雪莲 <lixuelianlk@163.com>
 * 前台用户  登录
 * 2015-03-06 15:14
 */
class MemberAction extends CommonAction {
    /**
     * 列表页面
     */
    public function index() {
        #var_dump($_SESSION[C('USER_AUTH_KEY')]);exit;
        parent::_initalize();

        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        //获取省份
        
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince(1);
        $this->assign("pro_list",$pro_list);
        
        $memmod=new MemberModel();
        $year=$memmod->getyear();
        $this->assign("year",$year);
        $month=$memmod->getmonth();
        $this->assign("month",$month);
        $days=$memmod->getday($year[0], $month[0]);
        $this->assign("day",$days);
        
        //列表页面---------------start
        $map="1 ";
        
        $keys=trim($_GET['keys']);
        $keys=($keys=='请输入关键字')?"":$keys;
        $start_date=  trim($_GET['start_date']);
        $end_date=trim($_GET['end_date']);
        $province=trim($_GET['province']);
        $city=trim($_GET['city']);
        
        $this->assign("keys",$keys);
        $this->assign("start_date",$start_date);
        $this->assign("end_date",$end_date);
        $this->assign("province",$province);
        $this->assign("city",$city);
        
        $cityname=$citymod->getname($city);
        $this->assign("cityname",$cityname);
        
        if(!empty($start_date)){
            $start_date=  strtotime($start_date."0:0:0");
            $map.=" and UNIX_TIMESTAMP(create_time)>= ".$start_date;
        }
        if(!empty($end_date)){
            $end_date=  strtotime($end_date."23:59:59");
            $map.=" and UNIX_TIMESTAMP(create_time)<= ".$end_date;
        }
        if(!empty($province)){
            $map.=" and province_id=".$province;
        }
        if(!empty($city)){
            $map.="and city_id=".$city;
        }
        
        if(!empty($keys)){
            $map.=" and (nickname like '%".$keys."%' or truename like '%".$keys."%' )";
        }
        import("ORG.Util.Page");
        $pumod=M("Putongmember");
        $count=$pumod->where($map)->count();
       # echo $pumod->getLastSql();
        $page=new Page($count,12);
        $showpage=$page->show();
        $list=$pumod->where($map)->order("a_id desc")->select();
        foreach ($list as $k=>$v){
            if(!empty($vo['last_login']))
                $list[$k]['last_login']=date("Y-m-d",$vo['last_login']);
            else
                $list[$k]['last_login']="从未登录";
            
            $list[$k]['sex']=($vo['sex']==1)?"男":"女";      
        }
        $this->assign("list",$list);
        
        $this->assign("page",$showpage);
        //列表页面--------------end
        
        $this->display();
    }
    /**
     * 添加保存
     */
    public function addmember(){
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $a_name=trim($_POST['a_name']);
        $pwd=trim($_POST['pwd']);
        $confpwd=  trim($_POST['cof_pwd']);
        $returnarr=array();
        if(empty($a_name)){
            $returnarr['status']=0;
            $returnarr['info']="登录名不能为空";
            echo json_encode($returnarr);
            exit;
        }
        if($pwd!=$confpwd){
            
            $returnarr['status']=0;
            $returnarr['info']="两次输入的密码必须一致";
            echo json_encode($returnarr);
            
            exit;
        }
        //检查登录名是否已经在数据库中存在
        $memmod=new MemberModel();
        if($memmod->check_name($a_name)>0){
            $returnarr['status']=0;
            $returnarr['info']="登录名已经存在，请重新命名";
            echo json_encode($returnarr);
            exit;
        }
        
        $maindata=array(
            "a_name"=>$a_name,
            "a_pwd"=>encrypt($pwd),
            "a_type"=>1,
            "status"=>1 
        );
        $nickname=trim($_POST['nickname']);
        $truename=trim($_POST['truename']);
        $sex=  trim($_POST['sex']);
        $email=trim($_POST['email']);
        $qq=trim($_POST['qq']);
        $movphone=trim($_POST['telphone']);
        $birthday=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        $cityid=$_POST['cityid'];
        $proid=$_POST['proid'];
        if(empty($proid)){
            $returnarr['status']=0;
            $returnarr['info']="请选择省份";
            echo json_encode($returnarr);
            exit;
        }
        if(empty($cityid)){
            $returnarr['status']=0;
            $returnarr['info']="请选择城市";
            echo json_encode($returnarr);
            exit;
        }
        $fjdata=array(
            "nickname"=>$nickname,
            "truename"=>$truename,
            "sex"=>$sex,
            "email"=>$email,
            "qq"=>$qq,
            "movphone"=>$movphone,
            "birthday"=>$birthday,
            "city_id"=>$cityid,
            "province_id"=>$proid 
        );
        
        
        
        $res=$memmod->add_member($maindata,$fjdata);
        
        echo json_encode($res);
        
        exit;
    }
    
    
    /**
     * 获取城市
     */
    public function getcity(){
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $pid=$_POST['fid'];
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince($pid);
        if($pro_list)
            echo json_encode(array("status"=>1,"data"=>$pro_list));
        else
          echo json_encode(array("status"=>0,"data"=>array()));  
    }
    
    /**
     * 获取日期
     */
    public function getdays(){
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
        $year=$_POST['year'];
        $mon=$_POST['mon'];
        $memmod=new MemberModel();
        $list=$memmod->getday($year, $mon);
        echo json_encode($list);
    }
    
    /**
     * 查看
     */
    public function getinfo(){
       
        header('Content-Type:application/json; charset=utf-8');
        
        $aid=$_POST['aid'];
        $ptmod=M("Putongmember");
        $info=$ptmod->where("a_id=".$aid)->find();
        if(!$_POST['is_cl']){
            $info['sex']=($info['sex']==1)?"男":"女";
            if(!empty($info['last_login']))
                    $info['last_login']=date("Y-m-d",$info['last_login']);
                else
                    $info['last_login']="从未登录";
        }    
        $arlist=M("Area")->where("region_id=".$info['city_id'])->field("region_name")->find();    
        if(!$_POST['is_cl']){    
            $data=array(
                "a_aname_1"=>$info['a_name'],
                "nickname_1"=>$info['nickname'],
                "truename_1"=>$info['truename'],
                "sex_1"=>$info['sex'],
                "email_1"=>$info['email'],
                "qq_1"=>$info['qq'],
                "telphone_1"=>$info['movphone'],
                "year_1"=>$info['birthday'],
                "city_1"=>$arlist['region_name'],
            );    
            echo json_encode($data);
        }else{
            $bir=$info['birthday'];
            $bir_arr=explode("-", $bir);
            $info['bir_year']=$bir_arr[0];
            $info['bir_month']=$bir_arr[1];
            $info['bir_day']=$bir_arr[2];
           //获取province 下的所有city
            $mod=new CityModel();
            $city=$mod->getcity($info['province_id']);
            
            $info['city']=$city;
            
           echo json_encode($info); 
        } 
            
        
    }
    /**
     * 编辑
     */
    public function edit_user(){
        header('Content-Type:application/json; charset=utf-8');
        $aid=$_POST['aid'];
        $a_name=  trim($_POST['a_name']);
        $pwd=trim($_POST['pwd']);
        $cof_pwd=trim($_POST['cof_pwd']);
        $nickname=  trim($_POST['nickname']);
        $truename=  trim($_POST['truename']);
        $sex=trim($_POST['sex']);
        $email=trim($_POST['email']);
        $qq=trim($_POST['qq']);
        $telphone=trim($_POST['telphone']);
        $year=trim($_POST['year']);
        $month=trim($_POST['month']);
        $day=trim($_POST['day']);
        $proid=trim($_POST['proid']);
        $cityid=  trim($_POST['cityid']);
        $birthday=$year."-".$month."-".$day;
        
        
        $amod=new Admininfo1Model();
        $ainfo=$amod->getinfo($aid,0);
        $data=array();
        if($ainfo['a_name']!=$a_name){
            //修改账户
            $data['a_name']=  $a_name;
        }
        if($pwd!=""&&$cof_pwd!=""&&$pwd==$cof_pwd){
            //两次输入的密码一致
            $data['a_pwd']=  encrypt($pwd);
        }
        //编辑登录账户
        $mod=M("Member");
        $mod->where(array("a_id"=>$aid))->save($data);  
        #echo $mod->getLastSql();
        $datainfo=array();
        if($ainfo['nickname']!=$nickname)
        $datainfo['nickname']=$nickname;
        
        if($ainfo['truename']!=$truename)
        $datainfo['truename']=$truename;
        
        if($ainfo['sex']!=$sex)
        $datainfo['sex']=$sex;
        
        if($ainfo['email']!=$email)
        $datainfo['email']=$email;
        
        if($ainfo['qq']!=$qq)
        $datainfo['qq']=$qq;
        
        if($ainfo['movphone']!=$telphone)
        $datainfo['movphone']=$telphone;
        
        if($ainfo['birthday']!=$birthday)    
        $datainfo['birthday']=$birthday;
        
        if($ainfo['city_id']!=$cityid)
        $datainfo['city_id']=$cityid;
        
        if($ainfo['province_id']!=$proid)
        $datainfo['province_id']=$proid;
        
        //编辑详情页面
        $infmod=M("Webmember");
        $infmod->where(array("a_id"=>$aid))->save($datainfo);
        echo json_encode(array("status"=>1,"info"=>"操作成功"));
    }
    /**
     * 删除
     */
    public function del(){
        $aid=$_GET['aid'];
        $mod=M("Member");
        $imod=M("Webmember");
        $res=$mod->where(array("a_id"=>$aid))->delete();
        $res2=$imod->where(array("a_id"=>$aid))->delete();
        if($res&&$res2){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }
    
    /**
     * 明星工长
     */
    public function foreman(){
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        $m=M("Foremanview");
        import("ORG.Util.Page");
        $map="1";
        $keys=trim($_GET['keys']);
        
        $keys=($keys=="请输入关键字")?"":$keys;
        
        $start_date=  trim($_GET['start_date']);
        $this->assign("start_date",$start_date);
        $end_date=  trim($_GET['end_date']);
        $this->assign("end_date",$end_date);
        
        if(!empty($start_date)){
            $start_date=  strtotime($start_date."0:0:0");
            $map.=" and UNIX_TIMESTAMP(f_addtime)>= ".$start_date;
        }
        if(!empty($end_date)){
            $end_date=  strtotime($end_date."23:59:59");
            $map.=" and UNIX_TIMESTAMP(f_addtime)<= ".$end_date;
        }
        $province=$_GET['province'];
        $this->assign("province",$province);
        $city=$_GET['city'];
        if(!empty($province)){
            $map.=" and f_p_id=".$province;
        }
        if(!empty($city)){
            $map.=" and f_c_id=".$city;
        }
        $this->assign("city",$city);    
        
        if(!empty($keys)){
            $map.=" and (f_company like '%".$keys."%' or f_truename like '%".$keys."%')";
        }
        
        
        $cou=$m->where($map)->order("a_id desc")->count();
       
        $page=new Page($cou,12);
        $showpage=$page->show();
        $list=$m->where($map)->order("a_id desc")->select();
        $this->assign("list",$list);
        $this->assign("page",$showpage);
        
        
        $memmod=new MemberModel();
        $year=$memmod->getyear();
        $this->assign("year",$year);
        $month=$memmod->getmonth();
        $this->assign("month",$month);
        $days=$memmod->getday($year[0], $month[0]);
        $this->assign("day",$days);
        
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince(1);
        $this->assign("pro_list",$pro_list);
        
        $this->assign("keys",$keys);
        
        $cityname=$citymod->getname($city);
        $this->assign("cityname",$cityname);
        
        $this->display();
    }
    /**
     * 添加明星工长
     */
    public function addforeman(){
        header('Content-Type:application/json; charset=utf-8');
        $a_name=  trim($_POST['a_name']);
        $pwd=  trim($_POST['pwd']);
        $cof_pwd=  trim($_POST['cof_pwd']);
        $truename=  trim($_POST['truename']);
        $sex=  trim($_POST['sex']);
        $company=  trim($_POST['company']);
        $jibie=  trim($_POST['jibie']);
        $telphone=  trim($_POST['telphone']);
        $phone=  trim($_POST['phone']);
        $email=  trim($_POST['email']);
        $qq=  trim($_POST['qq']);
        $year=  trim($_POST['year']);
        $month=  trim($_POST['month']);
        $day=  trim($_POST['day']);
        $proid=  trim($_POST['proid']);
        $cityid=  trim($_POST['cityid']);
        $address=  trim($_POST['address']);
        $collect=  trim($_POST['collect']);
        $jibie=  trim($_POST['jibie']);
        $addtime=  trim($_POST['addtime']);
        $koubei=trim($_POST['koubei']);
        if(empty($a_name)){
            $returnarr['status']=0;
            $returnarr['info']="登录名不能为空";
            echo json_encode($returnarr);
            exit;
        }
        if($pwd!=$cof_pwd){
            
            $returnarr['status']=0;
            $returnarr['info']="两次输入的密码必须一致";
            echo json_encode($returnarr);
            
            exit;
        }
        //检查登录名是否已经在数据库中存在
        $memmod=new MemberModel();
        if($memmod->check_name($a_name)>0){
            $returnarr['status']=0;
            $returnarr['info']="登录名已经存在，请重新命名";
            echo json_encode($returnarr);
            exit;
        }
        
        $maindata=array(
            "a_name"=>$a_name,
            "a_pwd"=>encrypt($pwd),
            "a_type"=>2,
            "status"=>1 
        );
        if(empty($proid)){
            $returnarr['status']=0;
            $returnarr['info']="请选择省份";
            echo json_encode($returnarr);
            exit;
        }
        if(empty($cityid)){
            $returnarr['status']=0;
            $returnarr['info']="请选择城市";
            echo json_encode($returnarr);
            exit;
        }
        $birthday=$year."-".$month."-".$day;
        $fjdata=array(
            "f_truename"=>$truename,
            "f_company"=>$company,
            "f_collect"=>$collect,
            "f_koubei"=>$koubei,
            "f_jibie"=>$jibie,
            "f_telphone"=>$telphone,
            "f_phone"=>$phone,
            "f_sex"=>$sex,
            "f_email"=>$email,
            "f_birthday"=>$birthday,
            "f_address"=>$address,
            "f_qq"=>$qq,
            "f_addtime"=>$addtime,
            "f_p_id"=>$proid,
            "f_c_id"=>$cityid
        );
        
        $res=$memmod->add_member($maindata,$fjdata);
        
        echo json_encode($res);
        
        
    }
    
    /**
     * 获取 明星工长
     */
    public function getforeman(){
        $aid=$_POST['aid'];
        $is_cl=$_POST['is_cl'];
        header('Content-Type:application/json; charset=utf-8');
        
        $mod=M("Foremanview");
        $info=$mod->where("a_id=".$aid)->find();
        if(!$is_cl){
            $info['sex_1']=($info['sex']==1)?"男":"女";
        }    
        echo json_encode($info);
    }
    /**
     * 编辑
     * 明星工长
     */
    public function edit_foreman(){
        header('Content-Type:application/json; charset=utf-8');
        $a_name=trim($_POST['a_name']);
        $pwd=  trim($_POST['pwd']);
        $cof_pwd=  trim($_POST['cof_pwd']);
        $aid=trim($_POST['aid']);
        $truename=  trim($_POST['truename']);
        $sex=trim($_POST['sex']);
        $company=trim($_POST['company']);
        $telphone=  trim($_POST['telphone']);
        $phone=trim($_POST['phone']);
        $email=trim($_POST['email']);
        $qq=  trim($_POST['qq']);
        $year=trim($_POST['year']);
        $month=  trim($_POST['month']);
        $day=  trim($_POST['day']);
        $proid=trim($_POST['proid']);
        $cityid=  trim($_POST['cityid']);
        $address=  trim($_POST['address']);
        $collect=  trim($_POST['collect']);
        $koubei=  trim($_POST['koubei']);
        $jibie=trim($_POST['jibie']);
        $addtime=  trim($_POST['addtime']);
        $birthday=$year."-".$month."-".$day;
        if(empty($a_name)){
            $return=array("status"=>0,"info"=>"登录账户不能为空!");
            echo json_encode($return);
            exit;
        }
        
        $mod=M("Member");
        $minfo=$mod->where("a_id=".$aid)->field("a_id,a_name,a_pwd")->find();
        $data=array();
        $map=array("a_id"=>$aid);
        if(!empty($pwd)&&!empty($cof_pwd)&&$cof_pwd==$pwd){
            $pwd=  encrypt($pwd);
            if($pwd!=$minfo['a_pwd']){
                $data['a_pwd']=$pwd;
            }
        }
        if($a_name!=$minfo['a_name']){
            $data['a_name']=$a_name;
        }
        if(!empty($data)){
            $mod->where($map)->save($data);
        }
        $fjdata=array();
        $map2=array("f_id"=>$aid);
        $mod2=M("ForemanInfo");
        $fjinfo=$mod2->where($map2)->find();
        if($fjinfo['f_truename']!=$truename){
            $fjdata['f_truename']=$truename;
        }
        if($fjinfo['f_company']!=$company){
            $fjdata['f_company']=$company;
        }
        if($fjinfo['f_collect']!=$collect){
            $fjdata['f_collect']=$collect;
        }
        if($fjinfo['f_koubei']!=$koubei){
            $fjdata['f_koubei']=$koubei;
        }
        if($fjinfo['f_jibie']!=$jibie){
            $fjdata['f_jibie']=$jibie;
        }
        if($fjinfo['f_telphone']!=$telphone){
            $fjdata['f_telphone']=$telphone;
        }
        if($fjinfo['f_phone']!=$phone){
            $fjdata['f_phone']=$phone;
        }
        if($fjinfo['f_sex']!=$sex){
            $fjdata['f_sex']=$sex;
        }
        if($fjinfo['f_email']!=$email){
            $fjdata['f_email']=$email;
        }
        if($fjinfo['f_birthday']!=$birthday){
            $fjdata['f_birthday']=$birthday;
        }
        if($fjinfo['f_address']!=$address){
            $fjdata['f_address']=$address;
        }
        if($fjinfo['f_qq']!=$qq){
            $fjdata['f_qq']=$qq;
        }
        if($fjinfo['f_addtime']!=$addtime){
            $fjdata['f_addtime']=$addtime;
        }
        if($fjinfo['f_p_id']!=$proid){
            $fjdata['f_p_id']=$proid;
        }
        if($fjinfo['f_c_id']!=$cityid){
            $fjdata['f_c_id']=$cityid;
        }
        
        
        if(!empty($fjdata)){
            $mod2->where($map2)->save($fjdata);
        }
        $return=array("status"=>1,"info"=>"操作成功!");
        echo json_encode($return);
        exit;
    }
    /**
     * 删除
     * 明星工厂
     */
    public function del_foreman(){
        $aid=$_GET['aid'];
        $mod=M("Member");
        $imod=M("ForemanInfo");
        $res=$mod->where(array("a_id"=>$aid))->delete();
        $res2=$imod->where(array("f_id"=>$aid))->delete();
        if($res&&$res2){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }
    
    /**
     * 店铺管理员列表
     */
    public function dianpu(){
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        $m=M("Dianpumember");
        import("ORG.Util.Page");
        $map="1";
        $keys=trim($_GET['keys']);
        
        $keys=($keys=="请输入关键字")?"":$keys;
        
        $start_date=  trim($_GET['start_date']);
        $this->assign("start_date",$start_date);
        $end_date=  trim($_GET['end_date']);
        $this->assign("end_date",$end_date);
        
        if(!empty($start_date)){
            $start_date=  strtotime($start_date."0:0:0");
            $map.=" and UNIX_TIMESTAMP(create_time)>= ".$start_date;
        }
        if(!empty($end_date)){
            $end_date=  strtotime($end_date."23:59:59");
            $map.=" and UNIX_TIMESTAMP(create_time)<= ".$end_date;
        }
        $province=$_GET['province'];
        $this->assign("province",$province);
        $city=$_GET['city'];
        if(!empty($province)){
            $map.=" and pro_id=".$province;
        }
        if(!empty($city)){
            $map.=" and city_id=".$city;
        }
        $this->assign("city",$city);    
        
        if(!empty($keys)){
            $map.=" and (company like '%".$keys."%')";
        }
        
        
        $cou=$m->where($map)->order("a_id desc")->count();
       
        $page=new Page($cou,12);
        $showpage=$page->show();
        $list=$m->where($map)->order("a_id desc")->select();
        $this->assign("list",$list);
        $this->assign("page",$showpage);
        
        
        $memmod=new MemberModel();
        $year=$memmod->getyear();
        $this->assign("year",$year);
        $month=$memmod->getmonth();
        $this->assign("month",$month);
        $days=$memmod->getday($year[0], $month[0]);
        $this->assign("day",$days);
        
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince(1);
        $this->assign("pro_list",$pro_list);
        
        $this->assign("keys",$keys);
        
        $cityname=$citymod->getname($city);
        $this->assign("cityname",$cityname);
        
        $this->display();
    }
    /**
     * 添加店铺管理员
     */
    public function adddianpu(){
        if(IS_POST){
            $a_name=trim($_POST['a_name']);
            $pwd=  trim($_POST['pwd']);
            $confirm_pwd=  trim($_POST['confirm_pwd']);
            if(empty($a_name)){
                $this->error("登录名称不能为空！");
                exit;
            }
            if(empty($pwd)){
                $this->error("密码不能为空!");
                exit;
            }
            if(empty($confirm_pwd)){
                $this->error("确认密码不能为空！");
                exit;
            }
            if($pwd!=$confirm_pwd){
                $this->error("两次输入的密码必须一致");
                exit;
            }
            //登录名称是否存在
            $memmod=new MemberModel();
            if($memmod->check_name($a_name)>0){
                $this->error("登录名已经存在，请重新命名");
                exit;
            }

            $maindata=array(
                "a_name"=>$a_name,
                "a_pwd"=>encrypt($pwd),
                "a_type"=>3,
                "status"=>1 
            );
            $dinfo=  $_POST['dinfo'];
            $dinfo['company']=  trim($dinfo['company']);
            $dinfo['faren']=trim($dinfo['faren']);
            $dinfo['lxrname']=  trim($dinfo['lxrname']);
            $dinfo['phone']=  trim($dinfo['phone']);
            $dinfo['kefu_phone']=  trim($dinfo['kefu_phone']);
            $dinfo['collect']=  trim($dinfo['collect']);
            $dinfo['koubei']=trim($dinfo[koubei]);
            $dinfo['jibie']=trim($dinfo[jibie]);
            $pro_id=  trim($_POST['pro_id']);
            $city_id=  trim($_POST['city_id']);
            $dinfo[dizhi]=  trim($dinfo[dizhi]);
            if(empty($pro_id)){
                $this->error("请选择省份！");
                exit;
            }
            if(empty($city_id)){
                $this->error("请选择市！");
                exit;
            }
            $fjdata=  array(
                "company"=>$dinfo['company'],
                "faren"=>$dinfo['faren'],
                "yingyezhizhao"=>$dinfo['yingyezhizhao'],
                "lxrname"=>$dinfo['lxrname'],
                "phone"=>$dinfo['phone'],
                "kefu_phone"=>$dinfo['kefu_phone'],
                "collect"=>$dinfo['collect'],
                "koubei"=>$dinfo['koubei'],
                "jibie"=>$dinfo[jibie],
                "pro_id"=>$pro_id,
                "city_id"=>$city_id,
                "address"=>$dinfo[dizhi],
                );
            $res=$memmod->add_member($maindata, $fjdata);
            if($res['status']){
                $this->success($res['info']);
            }else{
                $this->error($res['info']);
            }
            
            exit;
        }
        
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        //省份
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince(1);
        $this->assign("pro_list",$pro_list);
        
        $this->display();
    }
    /**
     * 获取 店铺管理
     */
    public function getdianpu(){
        $aid=$_POST['aid'];
        $is_cl=$_POST['is_cl'];
        header('Content-Type:application/json; charset=utf-8');
        
        $mod=M("Dianpumember");
        $info=$mod->where("a_id=".$aid)->find();
        if(!$is_cl){
            $info['sex_1']=($info['sex']==1)?"男":"女";
        }    
        echo json_encode($info);
    }
    /**
     * 编辑
     * 店铺管理
     */
    public function edit_dianpu(){
        if(IS_POST){
            $aid=$_POST['aid'];
            $a_name=  trim($_POST['a_name']);
            if(empty($a_name)){
                $this->error("登录名称不能为空！");
                exit;
            }
            $mod=M("Member");
            $minfo=$mod->where("a_id=".$aid)->find();
            $mdata=array();
            if($minfo['a_name']!=$a_name){
                $mdata['a_name']=$a_name;
            }
            $pwd=  trim($_POST['pwd']);
            $confirm_pwd=  trim($_POST['confirm_pwd']);
            if(!empty($pwd)&&!empty($confirm_pwd)&&$pwd==$confirm_pwd){
                $pwd=  encrypt($pwd);
                if($pwd!=$minfo['a_pwd']){
                    $mdata['a_pwd']=$pwd;
                }
            }
            if(!empty($mdata)){
                $mod->where("a_id=".$aid)->save($mdata);
            }
            //编辑店铺附加表
            $dinfo=array();
            $dinfo[company]=  trim($_POST[dinfo][company]);
            $dinfo[faren]=  trim($_POST[dinfo][faren]);
            $dinfo[yingyezhizhao]=  trim($_POST[dinfo][yingyezhizhao]);
            $dinfo[lxrname]=  trim($_POST[dinfo][lxrname]);
            $dinfo[phone]=  trim($_POST[dinfo][phone]);
            $dinfo[kefu_phone]=  trim($_POST[dinfo][kefu_phone]);
            $dinfo[collect]=  trim($_POST[dinfo][collect]);
            $dinfo[koubei]=  trim($_POST[dinfo][koubei]);
            $dinfo[jibie]=  trim($_POST[dinfo][jibie]);
            $dinfo[pro_id]=  trim($_POST[pro_id]);
            $dinfo[city_id]=  trim($_POST[city_id]);
            $dinfo[address]=  trim($_POST[dinfo][dizhi]);
            $mod2=M("Dianpu");
            $res2=$mod2->where("f_id=".$aid)->save($dinfo);
            $this->success("操作成功！",U("Member/dianpu"));
            
            exit;
        }
        
        
        parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
        //省份
        $citymod=new CityModel();
        $pro_list=$citymod->getprovince(1);
        $this->assign("pro_list",$pro_list);
        $aid=$_GET['aid'];
        $m=M("Dianpumember");
        $info=$m->where("a_id=".$aid)->find();
        $this->assign("info",$info);
        $this->display("adddianpu");
    }
    /**
     * 删除
     * 店铺管理员
     */
    public function del_dianpu(){
        $aid=$_GET['aid'];
        $mod=M("Member");
        $imod=M("Dianpu");
        $res=$mod->where(array("a_id"=>$aid))->delete();
        $res2=$imod->where(array("f_id"=>$aid))->delete();
        if($res&&$res2){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }
    /**
     * 上传营业执照
     */
    public function scimg(){
        header('Content-Type:application/json; charset=utf-8');
        $img=$this->upload();
        echo $img[0]['savename'];
    }
}

