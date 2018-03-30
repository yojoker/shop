<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'=>array(
		'__JS__'=>'/tpshop/Public/Home/js',
		'__CSS__'=>'/tpshop/Public/Home/style',
		'__IMG__'=>'/tpshop/Public/Home/images'

		),
	'TMPL_LAYOUT_ITEM'      =>  '{__CONTENT__}', // 布局模板的内容替换标识
    'LAYOUT_ON'             =>  true, // 是否启用布局
    'LAYOUT_NAME'           =>  'layout', // 当前布局名称 默认为layout
);