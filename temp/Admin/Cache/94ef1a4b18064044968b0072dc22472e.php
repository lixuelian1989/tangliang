<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>添加/编辑-店铺管理员-后台管理-<?php echo ($systemConfig["SITE_INFO"]["name_cms"]); ?></title>
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
<link href="/Public/css/theme.css" rel="stylesheet" />


<script src="/Public/uploadimg/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/uploadimg/uploadify.css">


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
      <div class="center_r_t">您的位置：<a href="<?php echo U('Member/dianpu');?>" class="a1">店铺管理员</a>>>>编辑/添加 店铺管理员信息</div>
      <div class="center_t">
          <form action="" id="form1" name="form1" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab center_t">
                <tr>
                    <td width="120">登录名称：</td>
                    <td><input <?php if(ACTION_NAME == 'editAdmin'): ?>disabled="disabled"<?php endif; ?> name="a_name" id="a_name" type="text" class="required" size="40" value="<?php echo ($info["a_name"]); ?>" /></td>
                </tr>
                <tr>
                    <td>密码：</td>
                    <td><input class="input" name="pwd" class="required" id="pwd" type="password" size="40" value="" /></td>
                </tr>
                <tr>
                    <td>确认密码：</td>
                    <td><input class="input" name="confirm_pwd" class="required" id="confirm_pwd" type="password" size="40" value="" /></td>
                </tr>
                
                <tr>
                    <td>公司名称：</td>
                    <td><input type="text" name="dinfo[company]" size="40" id="company" value="<?php echo ($info["company"]); ?>" /></td>
                </tr>
                <tr>
                    <td>法人：</td>
                    <td>
                        <input type="text" name="dinfo[faren]" size="40" id="faren" value="<?php echo ($info["faren"]); ?>" />
                    </td>
                </tr>                
                
                <tr>
                    <td>上传营业执照：</td>
                    <td>
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
            <div id="some_file_queue">

            </div>
            <div class="imgList" id="image"></div>
            <input type="hidden" name="dinfo[yingyezhizhao]" id="yingyezhizhao" value="<?php echo ($info["yingyezhizhao"]); ?>" />
                    </td>
                </tr>
                
                <tr>
                    <td>联系人姓名：</td>
                    <td><input type="text" name="dinfo[lxrname]" size="40" id="lxrname" value="<?php echo ($info[lxrname]); ?>" /></td>
                </tr>                 
                
                <tr>
                    <td>联系人电话：</td>
                    <td><input type="text" name="dinfo[phone]" size="40" id="phone" value="<?php echo ($info[phone]); ?>" /></td>
                </tr>
                
                <tr>
                    <td>客服电话：</td>
                    <td><input type="text" name="dinfo[kefu_phone]" size="40" id="kefu_phone" value="<?php echo ($info[kefu_phone]); ?>" /></td>
                </tr>  
                
                <tr>
                    <td>收藏数值：</td>
                    <td><input type="text" name="dinfo[collect]"size="10" id="collect" value="<?php echo ($info[collect]); ?>" /></td>
                </tr>  
                <tr>
                    <td>口碑值：</td>
                    <td><input type="text" name="dinfo[koubei]" size="10" id="koubei" value="<?php echo ($info[koubei]); ?>" /></td>
                </tr>  
                <tr>
                    <td>级别：</td>
                    <td><input type="text" name="dinfo[jibie]" size="10" id="jibie" value="<?php echo ($info[jibie]); ?>" /></td>
                </tr>  

                <tr>
                    <td>省份/城市：</td>
                    <td>
                        <select id="pro_id" name="pro_id" onchange="getcity('pro_id','city_id')" >
                            <option value="">请选择省份</option>
                            <?php if(is_array($pro_list)): $i = 0; $__LIST__ = $pro_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["region_id"]); ?>" <?php if($info[pro_id]==$vo[region_id]): ?>selected<?php endif; ?>><?php echo ($vo["region_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <select id="city_id" name="city_id">
                            <option value="">请选择市</option>
                            <?php if(!empty($info[city_id])): ?><option value="<?php echo ($info["city_id"]); ?>" selected="selected"><?php echo ($info["cityname"]); ?></option><?php endif; ?>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td>地址：</td>
                    <td><input type="text" name="dinfo[dizhi]" size="40" id="dizhi" value="<?php echo ($info[address]); ?>" /></td>
                </tr>
                
                <tr>
                    <td colspan="2"><input type="submit" class="btn submit" id="sub" name="sub" value="提交"/></td>
                    
                </tr>
                
            </table>
            <input type="hidden" name="aid" value="<?php echo ($info["a_id"]); ?>"/>
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
        
    
    </body>
</html>
<script>
    $(document).ready(function() {
        $("#form1").validate({
            rules:{
                a_name:{required:true,},
               
            },
            messages:{
                a_name:{required:"请输入用户名/邮件地址"},
                
            }
        });
		
        
		
    })
	
	 function getcity(proid,cityid){
	//	 alert(proid+","+cityid);
//		var pid=$("#"+proid).val();
		var pid=document.getElementById(proid).value;
		
		$.ajax({
			data:"fid="+pid,
			cache:false,
			url:"<?php echo U('Member/getcity');?>",
			type:"POST",
			dataType:"Json",
			success: function(msg){
				
				if(msg.status==1){
					$("#"+cityid).empty();
					var citystr="";
					var len=msg.data.length;
					var l;
					citystr+="<option value=''>请选择</option>";
					
					if(len>0){
						for(l=0;l<len;l++){
							citystr+="<option value='"+msg.data[l].region_id+"'>"+msg.data[l].region_name+"</option>";
						}
					}
					$("#"+cityid).append(citystr);
					
				}
				
			}
					
		});	
	}
	
</script>

<script>
            $(function() {
			$('#file_upload').uploadify({
				'swf'      : '/Public/uploadimg/uploadify.swf',
				'uploader' : '<?php echo U("Member/scimg");?>',
				'auto':true, //自动上传
				'buttonClass':'submit',//给上传按钮一个样式名称
				//'buttonImage':'/uploadfi/shangchuan.png',//上传按钮加上图片
				'buttonText':'增加图片',
				'height':28,//按钮的高度,
				'width':83,
				//'checkExisting':'<?php echo U("paicar/check-exists");?>',
				//'debug':true,
				//'fileObjName':'the_files',
				'fileSizeLimit':'2048KB',
				'fileTypeDesc':'Image Files',
				'fileTypeExts':'*.gif;*.jpg;*.png',
				//'formData':{'someKey':'11','someOne':'bb'},
				//'itemTemplate':'<div id="${fileID}" class="uploadify-queue-item">\
//					<div class="cancel">\
//						<a href="javascript:$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\')">X</a>\
//					</div>\
//					<span class="fileName">${fileName} (${fileSize})</span><span class="data"></span>\
//					</div>',
				'method':'post',
				'multi':true,//是否允许多个文件上传,
				'queueID'  : 'some_file_queue',
				'queueSizeLimit':22,	
				//'removeCompleted':false,	
				//'removeTimeout':10,//从队列中删除已完成的上传文件，延迟几秒
				'requeueErrors':true,
				'onUploadStart':function(file){
				//	console.log('Attempting to upload: ' + file.name);
				}
				,
				'successTimeout':5,//等待服务器响应几秒提示成功,
				'uploadLimit':1,//上传文件最大值
				'onCancel':function(file){
					//alert('the file '+file.name+' was cancelled');
				},
				'onClearQueue' : function(queueItemCount) {
            		//alert(queueItemCount + ' file(s) were removed from the queue');
        		},
				'onUploadComplete':function(file){
					//console.log(file);
				},
				'onUploadSuccess':function (file, data, response) {
					if(response){
						//console.log(data);
						$("#image").html("<image src=/Uploads/product/"+data+" height=100 />");	
						$("#yingyezhizhao").val(data);
						
					}else{
						alert('图片'+file.name+"上传失败");
					}
					//console.log(data);
					//console.log(response);
					//console.log(file);
					//alert('The file ' + data + ' was successfully uploaded with a response of ' + response + ':' + data);
				},
				'onQueueComplete' : function(queueData) {
					//console.log(queueData);
					//alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				}
				
				
			});
		});
        </script>