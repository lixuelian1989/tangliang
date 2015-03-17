<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<title><?php echo ($systemConfig["SITE_INFO"]["name_cms"]); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo ($systemConfig["SITE_INFO"]["description_cms"]); ?>" />
<meta name="keywords" content="<?php echo ($systemConfig["SITE_INFO"]["keyword_cms"]); ?>" />



<link href="/Public/css/common.css" rel="stylesheet" type="text/css" />



<script src="__ROOT__/Public/js/jquery.js"></script>

<script src="/Public/js/jquery.validate.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/themes/icon.css">
<script type="text/javascript" src="<?php echo ($systemConfig["WEB_ROOT"]); ?>/Public/easyui/jquery.easyui.min.js"></script>
<link href="/Public/css/main.css" rel="stylesheet" />
<link href="/Public/css/doubleDate.css" rel="stylesheet" />
<link href="/Public/css/theme.css" rel="stylesheet">


</head>
<body>
    <div class="wrap">
      <div class="header">
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
                    <?php if(is_array($nodelist2)): $i = 0; $__LIST__ = $nodelist2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="li1"><img src="/Public/images/sideico_1.png" class="img1" /><img src="/Public/images/sideico.png" class="img1 img2" />
                        <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

	      </ul>
</div>
 
      <!--左边end-->
      <div class="center_r">
    <div class="center">
      <div class="center_r_t">您的位置：<a href="<?php echo U('MyInfo/index');?>" class="a1">管理员</a>>>更改个人信息</div>
      <div class="center_t">
        <form action="" enctype="multipart/form-data" method="post" name="form1" id="form1">
    	<input type="hidden" value="<?php echo ($info["a_id"]); ?>" id="uid" name="uid" />
        
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
          <tr>
              <th colspan='6' style="align:left;">更改个人信息</th>
          </tr>
        <tr>
          <td width="120" align="right">真实姓名：</td>
          <td><input type="text" name="info[a_truename]" value="<?php echo ($info["a_truename"]); ?>" /></td>
          <td width="120" align="right">性别：</td>
          <td><label> <input type="radio" name="info[a_sex]" value="1" 
              <?php if($info[a_sex]==1): ?>checked<?php endif; ?>
              >男</label>
            <label> <input type="radio" name="info[a_sex]" value="2" 
              <?php if($info[a_sex]==2): ?>checked<?php endif; ?>
              >女</label></td>
          <td width="120" align="right">生日</td>
          <td>
            <input type="text" id="but" name="info[a_birthday]" value="<?php echo ($info["a_birthday"]); ?>" />
            <div class="easyui-calendar" style="width:250px;height:250px; display:none" data-options="formatter:formatDay"></div>
            <script>
		var d1 = Math.floor((Math.random()*30)+1);
		var d2 = Math.floor((Math.random()*30)+1);
		function formatDay(date){
			var m = date.getMonth()+1;
			var d = date.getDate();
			var opts = $(this).calendar('options');
			//if (opts.month == m && d == d1){
				//return '<div class="icon-ok md">' + d + '</div>';
			//} 
			//else if (opts.month == m && d == d2){
				//return '<div class="icon-search md">' + d + '</div>';
			//}
			return d;
		}
		$("#but").click(function(){
			$(".easyui-calendar").show();	
		});
		$(".easyui-calendar").calendar({
				onSelect:function(date){
					var month_selected=(date.getMonth()+1)<=9?"0"+(date.getMonth()+1):(date.getMonth()+1);
					var day_selected=date.getDate()<=9?"0"+date.getDate():date.getDate();
					
					var date_selected=date.getFullYear()+"-"+month_selected+"-"+day_selected;
					var dateobj=new Date();
					
					var month_current=(dateobj.getMonth()+1)<=9?"0"+(dateobj.getMonth()+1):(dateobj.getMonth()+1);
					var day_current=dateobj.getDate()<=9?"0"+dateobj.getDate():dateobj.getDate();
					
					var date_current=dateobj.getFullYear()+"-"+month_current+"-"+day_current;
					
					if(date_selected<=date_current){
					$("#but").val(date_selected);
					$(".easyui-calendar").hide();
					}else{
						alert("所选日期不能大于当前日期");
					}
					}
			});
	</script>
            <style scoped>
		.md{
			height:16px;
			line-height:16px;
			background-position:2px center;
			text-align:right;
			font-weight:bold;
			padding:0 2px;
			color:red;
		}
	</style>
    
    </td>
        </tr>
        <tr>
          <td width="120" align="right">电话：</td>
          <td>
          <input type="text" name="info[a_telphone]" value="<?php echo ($info["a_telphone"]); ?>" />
          </td>
          <td width="120" align="right">联系地址：</td>
          <td>
          <input type="text" name="info[a_address]" value="<?php echo ($info["a_address"]); ?>" />
          </td>
          <td width="120" align="right">QQ：</td>
          <td>
          <input type="text" name="info[a_qq]" value="<?php echo ($info["a_qq"]); ?>" />
          </td>
        </tr>
        <tr>
          <td width="120" align="right">职位：</td>
          <td>
          <input type="text" name="info[a_zhiwei]" value="<?php echo ($info["a_zhiwei"]); ?>" />
          </td>
          <td width="120" align="right">邮箱：</td>
          <td><input type="text" name="info[a_email]" value="<?php echo ($info["a_email"]); ?>" /></td>
          <td width="120" align="right"></td>
          <td></td>
        </tr>
                  <tr align='6' ><td>
                  <input type="submit" name="sub" id="sub" value="提交" />
                  </td></tr>
      </table>
    </form>
      </div>
    </div>
    <div class="foot">
        <ul>
    <li>Copyright © 2003-2010 tlgzjlb.com All Right Reserved</li>
    <li>版权所有 中国北京·唐亮工长俱乐部</li>
</ul>
 
    </div>
  </div>
    </div>   
    
   
</body>
</html>