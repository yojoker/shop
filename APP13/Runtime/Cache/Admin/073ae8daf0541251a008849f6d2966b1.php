<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
  <div class="place">
    <span>位置：</span>
    <ul class="placeul">
      <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
      <li><a href="<?php echo U('Role/index');?>">角色管理</a></li>
      <li>设置权限</li>
    </ul>
  </div>
  <div class="formbody">
    <div class="formtitle"><span>设置权限</span></div>
    <form action="<?php echo U('Role/auth');?>" method="post">
      <span style="font-size: 16px">您正在给【<label style="color: red;font-weight: bolder;"><?php echo ($roleInfo['role_name']); ?></label>】设置权限</span><br>
      <ul class="forminfo">
        <li>
          <input type="hidden" name="role_id" value="<?php echo ($roleInfo['role_id']); ?>" />
          <table class="tablelist">
            <thead>
              <tr>
                <th width="15%">顶级权限</th>
                <th width="85%">子权限</th>
              </tr>
            </thead>
            <tbody>
              <?php if(is_array($topAuth)): foreach($topAuth as $key=>$top): ?><tr>
                <td>
                  <label><input <?php echo in_array($top['auth_id'],$roleAuth)?'checked':'';?> type="checkbox" class="chk" name="auth_id[]" value="<?php echo ($top['auth_id']); ?>"><?php echo ($top['auth_name']); ?></label>
                </td>
                <td>
                <?php if(is_array($sonAuth)): foreach($sonAuth as $key=>$son): ?><label>
                  <?php if($top['auth_id']==$son['auth_pid']): ?><input <?php echo in_array($son['auth_id'],$roleAuth)?'checked':'';?> type="checkbox" class="child" name="auth_id[]" value="<?php echo ($son['auth_id']); ?>" /> <if condition="{ $top['auth_id'] == $son['auth_pid'] }"><?php echo ($son['auth_name']); endif; ?>
                  </label><?php endforeach; endif; ?>
                </td>
              </tr><?php endforeach; endif; ?>
            </tbody>
          </table>
        </li>
        <br/>
        <li>
          <input id="btnSubmit" type="submit" class="btn" value="确认保存" />
        </li>
      </ul>
    </form>
  </div>
</body>
<script>
$(function(){
    //全选&反选
    $('.chk').click(function(){
    	var status = $(this).attr('checked');
    	if(status == 'checked'){
    		$(this).parents('tr').find("td:eq(1)").find("input").attr("checked","checked");
    	}else{
    		$(this).parents('tr').find("td:eq(1)").find("input").removeAttr("checked");
    	}
    });

    //补选父级[选中子权限时，让对应的顶级权限也被选中]
    $('.child').click(function(){
    	var currentChildStatus = $(this).attr('checked');
    	var _parent = $(this).parents('tr').find("td:eq(0)").find("input");
    	if(currentChildStatus == 'checked'){
    		_parent.attr("checked","checked");
    	}else{
    		var selectChkBox = $(this).parents('tr').find(":checkbox:checked");
    		if(selectChkBox.length == 1){
    			_parent.removeAttr("checked");
    		}
    	}
    });
});
</script>
</html>