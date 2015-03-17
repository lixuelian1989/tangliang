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
        <link href="/Public/css/login.css" rel="stylesheet" type="text/css" />

    </head>
    
    <body bgcolor="#0888d3">
   <div class="login">
     <h1>唐亮工长俱乐部 后台管理系统</h1>
     <form name="form_login" id="form_login" action="" method="post" >
			<ul class="fromUl">
				<li><label>帐号</label>
                                <input type="text" name="name" id="name" value="" class="input1 required" />
                                </li>
				<li><label>密码</label>
                                <input type="password" name="pwd" id="pwd" value="" class="input1 required" />
                                </li>
				<li><label>验证码</label>
                                    <input class="input required input2" id="verify_code" name="verify_code" type="text"  />
                                    
                                    
                                <img src="<?php echo U('Index/verify_code');?>"  title="看不清？单击此处刷新" onclick="this.src += '?rand=' + Math.random();"  class="verification" align="bottom"/>
                                
                                </li>
				<li><input type="submit" value="登 录" class="sub1" id="sub" /></li>
			</ul>
     </form>
   </div>
</body>
</html>
<script>
    $(document).ready(function() {
        $("#form_login").validate({
            rules:{
                name:{required:true,},
                pwd:{required:true,},
                verify_code:{required:true,}
            },
            messages:{
                name:{required:"请输入用户名"},
                pwd:{required:"请输入密码"},
                verify_code:{required:"请输入验证码"}
            }
        });
        $("#verify_code").keyup(function() {
            $.ajax({
                url: "<?php echo U('Index/check_code');?>",
                data: "post_val=" + $(this).val(),
                type: "POST",
                cache: false,
                dataType: "JSON",
                success: function(msg) {
                    if (msg.code == 0) {
                        $("#sub").attr("disabled", true);
                    } else {
                        $("#sub").attr("disabled", false);
                    }
                }
            });
        });
    })
</script>