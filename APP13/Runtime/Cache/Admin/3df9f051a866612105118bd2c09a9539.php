<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商品类型</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('GoodsType/index');?>">商品类型管理</a></li>
            <li><a href="<?php echo U('GoodsAttribute/index');?>">商品属性列表</a></li>
            <li>编辑属性</li>
        </ul>
    </div>
    <div class="formbody">
  
        <div class="formtitle"><span>属性信息</span></div>
        <form action="<?php echo U('GoodsAttribute/edit');?>" method="post">
            <ul class="forminfo">
                <li>
                    <label>属性名称</label>
                    <input name="attr_name" value="<?php echo ($goodsAttribute['attr_name']); ?>" type="text" class="dfinput" /><i>名称不能超过30个字</i>
                </li>
                <li>
                    <label>商品类型</label>
                    <select name="type_id" class="dfinput">
                        <option value="0">---请选择---</option>
                        
                    <?php if(is_array($typeList)): foreach($typeList as $key=>$type): ?><option <?php if($goodsAttribute['attr_id']==I('get.id',0)): ?>selected<?php endif; ?> value="<?php echo ($type['attr_id']); ?>"><?php echo ($type['type_name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li>
                    <label>属性类型</label>
                    <cite>
                    <input type="radio" name="attr_sel" value="0" <?php if($goodsAttribute['attr_sel']==0): ?>checked="checked"<?php endif; ?>/>唯一&nbsp;
                    <input type="radio" name="attr_sel" value="1" <?php if($goodsAttribute['attr_sel']==1): ?>checked="checked"<?php endif; ?> />单选
                    </cite>
                </li>
                <li>
                    <label>值录入方式</label>
                    <cite>
                    <input type="radio" name="attr_write" value="0"  <?php if($goodsAttribute['attr_write']==0): ?>checked="checked"<?php endif; ?>/>手动录入&nbsp;
                    <input type="radio" name="attr_write" value="1"  <?php if($goodsAttribute['attr_write']==1): ?>checked="checked"<?php endif; ?> />从下方选择
                    </cite>
                </li>
                <li>
                    <label>可选值</label>
                    <textarea name="attr_vals" placeholder="请输入可选值，多个值之间请使用英文“,”分隔开" class="textinput"><?php echo ($goodsAttribute['attr_vals']); ?></textarea>

                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
//jQuery代码
$(function(){
    //给btnsubmit绑定点击事件
    $('#btnSubmit').on('click',function(){
        //表单提交
        $('form').submit();
    });

    //默认隐藏textarea
    //$('textarea').parent().hide();

    //默认开启textarea	
    if('input[name=attr_write][value=1] :checked'){
    	 $('textarea').parent().show();
    };

    //如果是从列表中选择则显示textarea
    $('input[name=attr_write]').on('click',function(){
        if($(this).val() == 1){
            $('textarea').parent().show();
        }else{
            $('textarea').parent().hide();
        }
    });

});
</script>
</html>