<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <link href="/Public/Admin/js/timer/calendar.css"  rel="stylesheet"><!--时间插件引入-->
    <script src="/Public/Admin/js/timer/calendar.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/js/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Public/Admin/js/ueditor/lang/zh-cn/zh-cn.js"></script>

    <style >
    #preview{
        position: absolute;
        top: 100px;
        right: 50px;
        max-width: 400px;
        max-height: 400px;
        min-width: 200px;
        min-height: 200px;

    }
    .formtitle span{
        position: static;
        margin-right: 10px;
        cursor: pointer;
        border-color: #fff;
    }
    .formtitle span:hover, .formtitle span :first-child{
        border-color: rgb(102,201,243);
    }
    .forminfo{display: none;}
    .current{display: block;}
    .add_btn,.sub_btn{
        vertical-align:middle;
        cursor:pointer;
    };
    </style>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Index/index');?>" target="_top">首页</a></li>
            <li><a href="<?php echo U('Goods/index');?>">商品列表</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle">
        <span>基本信息</span>
        <span>商品描述</span>
        <span>商品属性</span>
        </div>
        <form action="<?php echo U('Goods/add');?>" method="post" enctype="multipart/form-data">
            <ul class="forminfo current">
                <li>
                    <label>商品名称</label>
                    <input name="goods_name" placeholder="请输入商品名称" type="text" class="dfinput" /><i>名称不能超过30个字符</i></li>
                <li>
                    <label>商品价格</label>
                    <input name="goods_price" placeholder="请输入商品价格" type="text" class="dfinput" /><i></i></li>
                <li>
                    <label>市场价格</label>
                    <input name="market_price" placeholder="请输入市场价格" type="text" class="dfinput" /><i></i>
                </li>
                <li>
                    <label>logo图片</label>
               
                    <input name="goods_logo_src" id="f" type="file" onchange="change()" />
                   <img id="preview"  /> <!-- 图片预览在这里展示 -->

                </li>
                <li>
                    <label>商品数量</label>
                    <input name="goods_number" placeholder="请输入商品数量" type="text" class="dfinput" />
                </li>
                <li>
                    <label>虚拟销量</label>
                    <input name="sale_number" placeholder="请输入商品数量" type="text" class="dfinput" />
                </li>

                <!--
                <li><label>是否审核</label><cite><input name="" type="radio" value="" checked="checked" />是&nbsp;&nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />否</cite></li>
                -->
                <li>
                    <label>商品重量</label>
                    <input name="goods_weight" placeholder="请输入商品重量" type="text" class="dfinput"></input>
                </li> 
                <li>
                    <label>上架时间</label>
                    <input name="sale_time" placeholder="点击输入时间" id="sale_time" type="text" class="dfinput"></input>
                </li>  

                <li>
                    <label>商品排序</label>
                    <input name="sort" placeholder="数值越大，越靠后" type="text" class="dfinput"></input>
                </li> 
            </ul>
            
            <ul class="forminfo"> 
                <li>
                    <label>商品描述</label>
                    <textarea style="float:left;" name="goods_desc" id="goods_desc"></textarea>
                </li>
            </ul>
            <ul class="forminfo">
                <li >
                    <label>商品类型</label>
                    <select name="type_id" class="dfinput">
                        <option value="0">---请选择---</option>  
                    <?php if(is_array($typeList)): foreach($typeList as $key=>$type): ?><option value="<?php echo ($type['type_id']); ?>"><?php echo ($type['type_name']); ?></option><?php endforeach; endif; ?>
                </select>
                </li>
            </ul>
            <ul>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="submit" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script src="/Public/Admin/js/placeImage.js"></script>
<script type="text/javascript">  
     Calendar.setup({
        inputField     :    "sale_time",             // input输入框的id值
        ifFormat       :    "%Y-%m-%d %H:%M:%S",  // 时间显示的格式 分别代表 年-月-日 时:分:秒
        showsTime      :    true,                 // 是否显示 时间输入框
        timeFormat     :    "24"                  // 时间的显示进制 12小时制/24小时制
    });
      var ue = UE.getEditor('goods_desc',{toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'preview'
        ]],
        initialFrameWidth:600  //初始化编辑器宽度,默认1000
        ,initialFrameHeight:220  //初始化编辑器高度,默认320
    });
      //点击选项标签切换表单内容
      $('.formtitle span').on('click',function(){
        var key=$(this).index();
        $(this).css('border-color','#66c9f3').siblings().css('border-color','#fff');
        $('.forminfo').eq(key).show().siblings('.forminfo').hide();
      });


      //点击切换商品类型显示对应的属性列表
      $('select[name=type_id]').on('change',function(){
      	
      	var type_id=$(this).val();
      	data={
      		'id':type_id,
      	};
      	var _parent=$(this).parent();
       _parent.siblings().remove();//选项改变时移除兄弟li
      	$.post('<?php echo U("GoodsAttribute/ajax_list");?>',data,function(msg){
     	 

      		if(msg.length<1){
      			return false;
      		}

      		var html="";
      		$(msg).each(function(key,item){
      			html+=`<li><label>`;
                if(item['attr_sel']==1){
                    html+=  `<img class="add_btn" src="/Public/Admin/images/t01.png">`;
                }
                html+=`${item['attr_name']}</label>`;
                html+=`<input type="hidden" name="attr_id[]" value="${item['attr_id']}" />`;
                //根据属性的录入方式显示对应的输入框0表示单行文本框，1表示下拉列表
                if(item['attr_write']==0){
                    html+=`<input name="attr_value[]"  type="text" class="dfinput"  />`;
                }else{
                    html+=`<select name="attr_value[]" class="dfinput">`;
                    var attr_vals=item['attr_vals'].split(',');
                    $(attr_vals).each(function(key,value){
                        if(value!=''){
                            html+=`<option value="${value}">${value}</option>`;
                        }
                    })
                    html+=`</select>`;
                }
                //如果是单选属性，则需要提交一个框给用户输入当前属性商品对应的价格
                if(item['attr_sel']==1){
                    html+=`&nbsp;属性价格<input style="width:100px;" type="text" name="attr_price[]" class="dfinput"/>`
                }else{
                    html+=`<input type="hidden" value="0" name="attr_price[]" class="dfinput"/>`
                }
                html+=`</li>`;
      		});
      		_parent.after(html);//把新的表单数据追加到下拉列表的父级li里面

      	},'json');

      });
      //点击+号图片实现动态增加属性框
      $('.forminfo').on('click','.add_btn',function(){
        var _parent=$(this).parent().parent();
        var li=_parent.clone();
        li.find('input[name=attr_value\\[\\]]').val("");//复制要清空原input值
        //只清空文本框的值
        li.find('img').attr('src','/Public/Admin/images/t03.png').removeClass('add_btn').addClass('sub_btn');
        _parent.after(li);
      });
       $('.forminfo').on('click','.sub_btn',function(){
        var _parent=$(this).parent().parent();
            _parent.remove();
      });
</script>
</html>