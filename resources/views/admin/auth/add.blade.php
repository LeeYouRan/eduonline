<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{ asset('admin/lib') }}/html5shiv.js"></script>
<script type="text/javascript" src="{{ asset('admin/lib') }}/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/static') }}/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/static') }}/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/lib') }}/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/static') }}/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/static') }}/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="{{ asset('admin/lib') }}/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
		{{ csrf_field() }}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="auth_name" name="auth_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value="" placeholder="控制器名称" id="controller" name="controller">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off"  placeholder="方法名" id="action" name="action">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input type="radio" name="is_nav" value="1" id="sex-1" checked>
				<label for="sex-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" name="is_nav" value="0" id="sex-2" >
				<label for="sex-2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">上级权限：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="pid" size="1">
				<option value="0">顶级权限</option>
				@foreach ($topAuths as $topAuths)
				<option value="{{ $topAuths->id }}">{{ $topAuths->auth_name }}</option>
				@endforeach
			</select>
			</span> </div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{ asset('admin/lib') }}/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{ asset('admin/lib') }}/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{ asset('admin/static') }}/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{ asset('admin/static') }}/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{ asset('admin/lib') }}/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="{{ asset('admin/lib') }}/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="{{ asset('admin/lib') }}/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			atuh_name:{
				required:true,
				minlength:4,
				maxlength:16
			},
			controller:{
				required:true,
			},
			action:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "{{ url('admin/auth/add') }}",
				success: function(data){
				    //在父元素提示
                    parent.layer.msg('添加成功!',{icon:1,time:1000});
					//成功则关闭窗口
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.$('.btn-refresh').click();
                    parent.layer.close(index);
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
		}
	});
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>