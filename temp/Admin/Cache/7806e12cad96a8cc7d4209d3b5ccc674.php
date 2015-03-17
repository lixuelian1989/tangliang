<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限分配-权限管理-后台管理-<?php echo ($site["SITE_INFO"]["name"]); ?></title>
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
<link href="/Public/css/theme.css" rel="stylesheet"/>
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
        <p>你正在为用户组：<b><?php echo ($info["name"]); ?></b> 分配权限 。项目和版块有全选和取消全选功能</p>
        <form name="form1" id="from1" action="" enctype="multipart/form-data" method="post" >
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
            <?php if(is_array($nodeList)): $i = 0; $__LIST__ = $nodeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level1): $mod = ($i % 2 );++$i;?><tr>
                <td style="font-size: 14px;"><label>
                    <input name="data[]" level="1" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>" value="<?php echo ($level1["id"]); ?>:1:0"/>
                    <b>[项目]</b> <?php echo ($level1["title"]); ?></label></td>
              </tr>
              <?php if(is_array($level1['data'])): $i = 0; $__LIST__ = $level1['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level2): $mod = ($i % 2 );++$i;?><tr>
                  <td style="padding-left: 30px; font-size: 14px;"><label>
                      <input name="data[]" level="2" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>" value="<?php echo ($level2["id"]); ?>:2:<?php echo ($level2["pid"]); ?>"/>
                      <b>[模块]</b> <?php echo ($level2["title"]); ?></label></td>
                </tr>
                <tr>
                  <td style="padding-left: 50px;"><?php if(is_array($level2['data'])): $i = 0; $__LIST__ = $level2['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level3): $mod = ($i % 2 );++$i;?><label>
                        <input name="data[]" level="3" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>_<?php echo ($level3["id"]); ?>" value="<?php echo ($level3["id"]); ?>:3:<?php echo ($level3["pid"]); ?>"/>
                        <?php echo ($level3["title"]); ?></label>
                      &nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            <tr>
              <td><div class="commonBtnArea" >
                  <input type="submit" class="btn submit" value="提交" />
                  <input type="button" class="btn reset" value="重置" />
                  <input type="button" class="btn empty" value="清空" />
                </div></td>
            </tr>
          </table>
          <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
        </form>
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
            //初始化数据
            function setAccess(){
                //清空所有已选中的
                $("input[type='checkbox']").prop("checked",false);
                //数据格式：
                //节点ID：node_id；1，项目；2，模块；3，操作
                //节点级别：level；
                //父级节点ID：pid
                var access=$.parseJSON('<?php echo ($info["access"]); ?>');
                var access_length=access.length;
                if(access_length>0){
                    for(var i=0;i<access_length;i++){
                        $("input[type='checkbox'][value='"+access[i]['val']+"']").prop("checked","checked");
                    }
                }
            }
            $(function(){
                //执行初始化数据操作
                setAccess();
                //为项目时候全选本项目所有操作
                $("input[level='1']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                });
                //为模块时候全选本模块所有操作
                $("input[level='2']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                    //分隔obj为数组
                    var tem=obj.split("_");
                    //将当前模块父级选中
                    if($(this).prop('checked')){
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                    }
                });
                //为操作时只要有勾选就选中所属模块和所属项目
                $("input[level='3']").click(function(){
                    var tem=$(this).attr("obj").split("_");
                    if($(this).prop('checked')){
                        //所属项目
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                        //所属模块
                        $("input[obj='node_"+tem[1]+"_"+tem[2]+"']").prop("checked","checked");
                    }
                });
                //重置初始状态，勾选错误时恢复
                $(".reset").click(function(){
                    setAccess();
                });
                //清空当前已经选中的
                $(".empty").click(function(){
                    $("input[type='checkbox']").prop("checked",false);
                });
                $(".submit").click(function(){
                    commonAjaxSubmit();
                });
            });
        </script>
</body>
</html>