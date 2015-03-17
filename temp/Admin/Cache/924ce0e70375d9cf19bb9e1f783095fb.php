<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<title>装修攻略-后台管理-<?php echo ($systemConfig["SITE_INFO"]["name_cms"]); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo ($systemConfig["SITE_INFO"]["description_cms"]); ?>" />
<meta name="keywords" content="<?php echo ($systemConfig["SITE_INFO"]["keyword_cms"]); ?>" />
<script src="/Public/js/tabqh.js"></script>
<script src="/Public/js/Tab.js"></script>


<link href="/Public/css/common.css" rel="stylesheet" type="text/css" />



<script src="__ROOT__/Public/js/jquery.js"></script>

<script src="/Public/js/jquery.validate.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/themes/icon.css">
<script type="text/javascript" src="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/jquery.easyui.min.js"></script>
<link href="/Public/css/main.css" rel="stylesheet" />
<link href="/Public/css/doubleDate.css" rel="stylesheet" />
<link href="/Public/css/theme.css" rel="stylesheet">
<script>
jQuery(document).ready(function($) {
	$('.theme-login').click(function(){
		
		$(".theme-popover").html($(".yc_add").html());
		
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').slideDown(200);
	})
	
		
		
	

})
function close_win(){
	$(".theme-popover").html("");
		
	$('.theme-popover-mask').fadeOut(100);
	$('.theme-popover').slideUp(200);
}

</script>
<style>
.fontb{ display:block; float:right; margin-right:56px;}
</style>
<script src="/Public/js/jquery.min.js" language="javascript" type="text/javascript"></script>

<script type="text/javascript" src="/Public/js/doubleDate2.0.js"></script>
<script type="text/javascript">
$(function(){
	$('.doubledate').kuiDate({
		className:'doubledate',
		isDisabled: "0"  // isDisabled为可选参数，“0”表示今日之前不可选，“1”标志今日之前可选
	});
});
</script>
</head>

<body>
<div class="wrap"> <div class="header">
  <div class="logo"><img src="/Public/images/logo.jpg" /></div>
  <div class="headet_r">
    <div class="header_r_t">
      <div class="header_r_t_l">></div>
      <a href="<?php echo U('MyInfo/index');?>"><img src="/Public/images/ico1.png" />管理员</a> <a href="<?php echo U('Index/logout');?>"><img src="/Public/images/ico3.png" />退出</a> </div>
    <div class="conter_scroll_w">
      <div class="conter_scroll_bot">
        <div class="rollBox"> <img onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()" onmouseout="ISL_StopDown()"  class="img3" src="/Public/images/s_left.png" />
          <div class="Cont" id="ISL_Cont">
            <div class="ScrCont">
              <div id="List1"> 
                <!-- 图片列表 begin -->
                <?php if(is_array($nodelist)): $k = 0; $__LIST__ = $nodelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if($actname==$vo[name]): ?><div class="pic a1">
                        <?php else: ?>
                        <div class="pic"><?php endif; ?>
                      <a href="<?php echo ($vo["url"]); ?>">
                    <p><img src="/Public/images/menuico1.png" /></p>
                    <?php echo ($vo["title"]); ?>
                      </a> </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <!--
                <div class="pic a1"><a href="">
                  <p><img src="/Public/images/menuico1.png" /></p>
                  用户中心</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico2.png" /></p>
                  装修攻略</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico3.png" /></p>
                  明星工长</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico4.png" /></p>
                  设计团队</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico5.png" /></p>
                  团购商家</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico6.png" /></p>
                  团购活动</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico7.png" /></p>
                  社区团装</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico8.png" /></p>
                  装修美图</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico7.png" /></p>
                  用户中心</a></div>
                <div class="pic"><a href="">
                  <p><img src="/Public/images/menuico8.png" /></p>
                  装修攻略</a></div>
                -->
                
                <!-- 图片列表 end --> 
              </div>
              <div id="List2"></div>
            </div>
          </div>
          <img  onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()" onmouseout="ISL_StopUp()"  class="img4" src="/Public/images/s_right.png" /> </div>
      </div>
      <script src="/Public/js/rollBox.js" type="text/javascript"></script> 
    </div>
  </div>
</div>
 
  <!--头部end--> 
  <div class="tabBox" id="Threetab">
	      <ul class="tab center_side">
                    <li></li>
                    <?php if(is_array($nodelist2)): $i = 0; $__LIST__ = $nodelist2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($funname==$vo[name]): ?><li class="li1"> 
                               <?php else: ?>
                               <li><?php endif; ?>
		    <img src="/Public/images/sideico_1.png" class="img1" /><img src="/Public/images/sideico.png" class="img1 img2" />
                        <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

	      </ul>
</div>
 
  <!--左边end-->
  <div class="center_r">
    <div class="center">
      <div class="center_r_t">您的位置：<a href="<?php echo U('Access/index');?>" class="a1">装修攻略</a>>>装修日记列表</div>
      <div class="center_r_z">
        <label>关键字</label>
        <input type="text" class="input1"  value="请输入关键字" />
        <label>日期</label>
        <input type="text" readonly class="doubledate ipticon"/>
        <label>-</label>
        <input type="text" readonly class="doubledate ipticon"/>
        <input name="" type="button"  value="查询" class="sub1" />
        <label>分类查看</label>
        <select name="choose" class="choose">
          <option value="按城市查看" selected="selected">按城市查看</option>
        </select>
        <a class="btn btn-primary btn-large theme-login" href="javascript:;">添加用户</a>
        <div class="theme-popover">
          
        </div>
        <div class="theme-popover-mask"></div>
      </div>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="center_t" style="word-break:break-all; word-wrap:break-all;">
        <tr class="center_t_t">
          <td class="td1" width="180">标题</td>
          <td width="80">作者</td>
          <td width="135">发布时间</td>
          <td width="90">审核状态</td>
          <td width="100">查看数</td>
          <td width="100">收藏数</td>
          <td width="100">评论数</td>
          <td class="td2" width="140">操作</td>
        </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="center_t_d">
          <td class="td1" width="180"><?php echo ($vo["title"]); ?></td>
          <td width="80"><?php echo ($vo["writer"]); ?></td>
          <td width="135"><?php echo (date('y-m-d H:i:s',$vo["addtime"])); ?></td>
          <td width="90"><?php echo ($vo["status"]); ?></td>
          <td width="100"><?php echo ($vo["view"]); ?></td>
          <td width="100"><?php echo ($vo["favorites"]); ?></td>
          <td width="100"><?php echo ($vo["comment"]); ?></td>
          <td width="140"><a aid="<?php echo ($vo["id"]); ?>" class='chakan' style="cursor:pointer;">查看</a><a aid="<?php echo ($vo["id"]); ?>" class="edituser" style="cursor:pointer">修改</a><a name="<?php echo ($vo["truename"]); ?>" link="<?php echo U('Zxgl/del',array('aid'=>$vo[a_id]));?>" style="cursor:pointer">删除</a><a aid="<?php echo ($vo["id"]); ?>" class="shenhe">审核</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <div class="paging">
        <div class="paging_l"><?php echo ($page); ?></div>
      </div>
    </div>
    <div class="foot"> <ul>
    <li>Copyright © 2003-2010 tlgzjlb.com All Right Reserved</li>
    <li>版权所有 中国北京·唐亮工长俱乐部</li>
</ul>
 </div>
  </div>
</div>
<!--添加-->
<div class="yc_add" style="display:none">
<div class="theme-poptit"> <a href="javascript:;" title="关闭" class="close" onClick="close_win()"><img src="/Public/images/gb.jpg" /></a>
            <h3>添加新用户</h3>
          </div>
          <div class="theme-popbod dform">
            <form class="theme-signin" name="loginform" action="" method="post">
              <ol>
                <li>
                  <label>登录帐号</label>
                  <input class="ipt" type="text" name="a_name" id="a_name" size="20" />
                </li>
                <li>
                  <label>登录密码</label>
                  <input class="ipt" type="password" size="20" name="pwd" id="pwd" />
                </li>
                <li>
                  <label>确认密码</label>
                  <input class="ipt" type="password"  size="20" name="cof_pwd" id="cof_pwd" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;昵称</label>
                  <input class="ipt" size="20" name="nickname" id="nickname" />
                </li>
                <li>
                  <label>真实姓名</label>
                  <input class="ipt" size="20" name="truename" id="truename" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别</label>
                  <select id="sex" name="sex">
                  	<option value="1">男</option>
                    <option value="2">女</option>
                    
                  </select>
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱</label>
                  <input class="ipt" name="email" id="email" size="20" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QQ</label>
                  <input class="ipt" size="20" name="qq" id="qq" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机</label>
                  <input class="ipt" size="20" name="telphone" id="telphone" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生日</label>
                  <select name="year" class="choose" id="year">
                    
                    <?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    
                  </select>
                  <select name="month" onChange="getdays()" class="choose1" id="month" >
                    <?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <select name="day" class="choose1" id="day">
                    <?php if(is_array($day)): $i = 0; $__LIST__ = $day;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </li>
                <li>
                  <label>所在城市</label>
                  <select id="proid" name="proid" onChange="getcity()">
                  	<option value="">请选择</option>
                    <?php if(is_array($pro_list)): $i = 0; $__LIST__ = $pro_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>"><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <select id="cityid" name="cityid">
                  	<option value="">请选择</option>
                  </select>
                </li>
                
                <li>
                  <input class="sub2" type="button" id="sub_add" onClick="add_user()" name="submit" value="完 成" />
                </li>
              </ol>
            </form>
          </div>
</div>
<!--查看-->
<style>
.theme-popover{
	background-color: #fff;
    box-shadow: 0 0 10px #666;
    display: none;
    height: 530px;
    left: 60%;
    margin: -200px 0 0 -448px;
    position: fixed;
    top: 50%;
    width: 600px;
    z-index: 9999;}
	.dforms
	{
		font-size:14px;
	}
</style>
<!--查看-->
<div class="yc_ck" style="display:none;">
<div class="theme-poptit"> <a href="javascript:;" title="关闭" class="close" onClick="close_win()"><img src="/Public/images/gb.jpg" /></a>
            <h3>查看日记</h3>
          </div>
          <div class="theme-popbod dforms">
				<div id="a_aname_1" style="text-align:center;font-size: 18px;font-weight: 600;"></div>
				所在地址:<div id="nickname_1"></div>
				详细内容:<p id="truename_1"></p>
          </div>
</div>
<!--编辑-->
<div class="yc_edit" style="display:none">
<div class="theme-poptit"> <a href="javascript:;" title="关闭" class="close" onClick="close_win()"><img src="/Public/images/gb.jpg" /></a>
            <h3>编辑用户</h3>
          </div>
          <div class="theme-popbod dform">
            <form class="theme-signin" name="editform" action="" method="post">
              <ol>
                <li>
                  <label>登录帐号</label>
                  <input class="ipt" type="text" name="a_name_e" id="a_name_e" size="20" />
                </li>
                <li>
                  <label>登录密码</label>
                  <input class="ipt" type="password" size="20" name="pwd_e" id="pwd_e" />
                </li>
                <li>
                  <label>确认密码</label>
                  <input class="ipt" type="password"  size="20" name="cof_pwd_e" id="cof_pwd_e" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;昵称</label>
                  <input class="ipt" size="20" name="nickname_e" id="nickname_e" />
                </li>
                <li>
                  <label>真实姓名</label>
                  <input class="ipt" size="20" name="truename_e" id="truename_e" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别</label>
                  
                  <select id="sex_e" name="sex_e">
                    
                  </select>
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱</label>
                  <input class="ipt" name="email_e" id="email_e" size="20" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QQ</label>
                  <input class="ipt" size="20" name="qq_e" id="qq_e" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机</label>
                  <input class="ipt" size="20" name="telphone_e" id="telphone_e" />
                </li>
                <li>
                  <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;生日</label>
                  <select name="year_e" class="choose" id="year_e">
                    
                    
                    
                  </select>
                  <select name="month_e" onChange="getdays()" class="choose1" id="month_e" >
                    <?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <select name="day_e" class="choose1" id="day_e">
                    <?php if(is_array($day)): $i = 0; $__LIST__ = $day;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </li>
                <li>
                  <label>所在城市</label>
                  <select id="proid_e" name="proid_e" onChange="getcity()">
                  	<option value="">请选择</option>
                    <?php if(is_array($pro_list)): $i = 0; $__LIST__ = $pro_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>"><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                  <select id="cityid_e" name="cityid_e">
                  	<option value="">请选择</option>
                  </select>
                </li>
                
                <li>
                <input type="hidden" id="aid_e" name="aid_e" value="" />
                  <input class="sub2" type="button" id="sub_add" onClick="edit_user()" name="submit" value="完 成" />
                </li>
              </ol>
            </form>
          </div>
</div>
<script>
//删除
    $(".del").click(function(){
        var n=$(".del").attr("name");
        if(confirm("您确定要删除会员["+n+"]吗？")){
            window.location.href=$(".del").attr("link");
        }
    });
	//获取城市
	function getcity(){
		var pid=$("#proid").val();
		
		$.ajax({
			data:"fid="+pid,
			cache:false,
			url:"<?php echo U('Member/getcity');?>",
			type:"POST",
			dataType:"Json",
			success: function(msg){
				msg=eval("("+msg+")");
				if(msg.status==1){
					$("#cityid").empty();
					var citystr="";
					var len=msg.data.length;
					var l;
					for(l=0;l<len;l++){
						citystr+="<option value='"+msg.data[l].region_id+"'>"+msg.data[l].region_name+"</option>";
					}
					
					
					$("#cityid").append(citystr);
				}else{
					alert("操作失败");
				}
				
			}
					
		});
		
			
}
//添加用户	
function add_user(){


	var a_name=$("#a_name").val();
	var pwd=$("#pwd").val();
	var cof_pwd=$("#cof_pwd").val();
	var nickname=$("#nickname").val();
	var truename=$("#truename").val();
	var sex=$("#sex").val();
	var email=$("#email").val();
	var qq=$("#qq").val();
	var telphone=$("#telphone").val();
	var year=$("#year").val();
	var month=$("#month").val();
	var day=$("#day").val();
	var proid=$("#proid").val();
	var cityid=$("#cityid").val();
	
	$.ajax({
		data:"a_name="+a_name+"&pwd="+pwd+"&cof_pwd="+cof_pwd+"&nickname="+nickname+"&truename="+truename+"&sex="+sex+"&email="+email+"&qq="+qq+"&telphone="+telphone+"&year="+year+"&month="+month+"&day="+day+"&proid="+proid+"&cityid="+cityid,
		cache:false,
		url:"<?php echo U('Member/addmember');?>",
		type:"POST",
		dataType:"JSON",
		success: function(msg){
			msg=eval("("+msg+")");
			if(msg.status){
				$("#a_name").val("");
				$("#pwd").val("");
				$("#cof_pwd").val("");
				$("#nickname").val("");
				$("#truename").val("");
				$("#sex").val("");
				$("#email").val("");
				$("#qq").val("");
				$("#telphone").val("");
				$("#year").val("");
				$("#month").val("");
				$("#day").val("");
				$('.theme-popover-mask').fadeOut(100);
				$('.theme-popover').slideUp(200);
				alert(msg.info);
			}else{
				alert(msg.info);
			}
			
		}
	});
	
		
}

//获取日期 

function getdays(){
	var mon=$("#month").val();
	var year=$("#year").val();
	$.ajax({
		data:"year="+year+"&mon="+mon,
		cache:false,
		url:"<?php echo U('Member/getdays');?>",
		type:"POST",
		dataType:"JSON",
		success: function(msg){
			msg=eval("("+msg+")");
			$("#day").empty();
			var l;
			var htm="";
			for(l=0;l<msg.length;l++){
				htm+="<option value='"+msg[l]+"'>"+msg[l]+"</option>";
			}
			$("#day").append(htm);	
			
		}
	});	
}
//查看
$(".chakan").click(function(){
	var aid=$(this).attr("aid");	
	
	
	$.ajax({
		data:"aid="+aid,
		type:"POST",
		dataType:"JSON",
		url:"<?php echo U('Zxgl/view');?>",
		cache:false,
		success: function(msg){
			msg=eval("("+msg+")");
			
			document.getElementById("a_aname_1").innerHTML=msg.title;
			document.getElementById("nickname_1").innerHTML=msg.address;
			document.getElementById("truename_1").innerHTML=msg.content;
			
			}
		})
	
	
	
	$(".theme-popover").html($(".yc_ck").html());
		
	$('.theme-popover-mask').fadeIn(100);
	$('.theme-popover').slideDown(200);
	
	
		
});
//编辑
$(".edituser").click(function(){
	var aid=$(this).attr("aid");
	//alert("编辑"+aid);
	$.ajax({
		data:"aid="+aid+"&is_cl=1",	
		cache:false,
		type:"POST",
		dataType:"JSON",
		url:"<?php echo U('Member/getinfo');?>",
		success: function(msg){
			msg=eval("("+msg+")");
			document.getElementById("a_name_e").value=msg.a_name;
			document.getElementById("nickname_e").value=msg.nickname;
			document.getElementById("truename_e").value=msg.truename;
			document.getElementById("email_e").value=msg.email;
			document.getElementById("qq_e").value=msg.qq;
			document.getElementById("telphone_e").value=msg.movphone;
			if(msg.sex==2)
			var str_sex="	<option value='1' >男</option><option value='2' selected>女</option>";
			else
			var str_sex="	<option value='1' selected >男</option><option value='2' >女</option>";
			
			document.getElementById("sex_e").innerHTML=str_sex;
			
			var str_year="";
			
			
			<?php if(is_array($year)): $i = 0; $__LIST__ = $year;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>if(msg.bir_year=="<?php echo ($vo); ?>")
            	str_year+=' <option value="<?php echo ($vo); ?>" selected ><?php echo ($vo); ?></option>';
			else
				str_year+=' <option value="<?php echo ($vo); ?>" ><?php echo ($vo); ?></option>';<?php endforeach; endif; else: echo "" ;endif; ?>
			document.getElementById("year_e").innerHTML=str_year;
			
			
			
		}
	});
	
	
	$(".theme-popover").html($(".yc_edit").html());
		
	$('.theme-popover-mask').fadeIn(100);
	$('.theme-popover').slideDown(200);
	
});





    
</script>
</body>
</html>