<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>角色管理-权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
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

  <div class="center_r">
    <div class="center">
      <div class="center_r_t">您的位置：<a href="<?php echo U('Access/index');?>" class="a1">权限管理</a>>>角色列表</div>
      <div class="center_t">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab center_t">
          <thead>
            <tr class="center_t_t">
              <td>序号</td>
              <td>组ID</td>
              <td>组名</td>
              <td>描述</td>
              <td>状态</td>
              <td>操作</td>
            </tr>
          </thead>
          <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr align="center" id="<?php echo ($vo["id"]); ?>" class="center_t_d">
              <td><?php echo ($k); ?></td>
              <td><?php echo ($vo["id"]); ?></td>
              <td><?php echo ($vo["name"]); ?></td>
              <td align="left"><?php echo ($vo["remark"]); ?></td>
              <td><?php echo ($vo["statusTxt"]); ?></td>
              <td><?php if($vo["pid"] == 0): ?>--
                  <?php else: ?>
                  <a href="javascript:void(0);" class="opStatus" val="<?php echo ($vo["status"]); ?>"><?php echo ($vo["chStatusTxt"]); ?></a><a href="__URL__/editRole?id=<?php echo ($vo["id"]); ?>" class="edit">编辑</a><a href="__URL__/changeRole?id=<?php echo ($vo["id"]); ?>" class="edit">权限分配</a><?php endif; ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
      </div>
    </div>
    <div class="foot"> <ul>
    <li>Copyright © 2003-2010 tlgzjlb.com All Right Reserved</li>
    <li>版权所有 中国北京·唐亮工长俱乐部</li>
</ul>
 </div>
  </div>
</div>
<script type="text/javascript">
            $(function(){
                //快捷启用禁用操作
                $(".opStatus").click(function(){
                    var obj=$(this);
                    var id=$(this).parents("tr").attr("id");
                    var status=$(this).attr("val");
                    $.getJSON("__URL__/opRoleStatus", { id:id, status:status }, function(json){
                        if(json.status==1){
                            //popup.success(json.info);
                            alert(json.info);
                            $(obj).attr("val",json.data.status).html(status==1?"启用":"禁用").parents("td").prev().html(status==1?"禁用":"启用");
                        }else{
                            alert(json.info);
                            //popup.alert(json.info);
                        }
                    });
                });
            });
        </script>
</body>
</html>