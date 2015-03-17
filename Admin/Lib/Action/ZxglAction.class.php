<?php
class ZxglAction extends CommonAction
 {
	//列表页面
    public function index() 
	{   
		//导航
		parent::_initalize();
        $systemConfig = $this->systemConfig;
        $this->assign("systemConfig", $systemConfig);
		//列表
		import("ORG.Util.Page");
		$pumod=M("Zxrj");
        $count=$pumod->where($map)->count();
        
        $page=new Page($count,12);
        $showpage=$page->show();
        $list=$pumod->where($map)->order("id desc")->select();
		
		$this->assign("list",$list);
        $this->assign("page",$showpage);
		
        $this->display();
    } 
	
	//查看
	public function view()
	{
		header('Content-Type:application/json; charset=utf-8');
        
        $aid=$_POST['aid'];
        $ptmod=M("Zxrj");
        $info=$ptmod->where("id=".$aid)->find();
		$data=array(
                "title"=>$info['title'],
                "address"=>$info['address'],
                "content"=>$info['content'],
                        );    
        echo json_encode($data);
	}
	
	//修改
	public function edit()
	{
		
	}
	
	//删除
	
	public function del()
	{
		
	}
	
	//审核
	
	public function status()
	{
		
	}
}
?>