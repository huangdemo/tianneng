<?php
use yii\helpers\Url;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
<title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" method="post" action="<?=Url::to(['brand/add'])?>" target="_self" enctype="multipart/form-data">
			<input type="text" placeholder="分类名称" value="" name="brand_name" class="input-text" style="width:120px">
			<span class="btn-upload form-group">
			<a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 上传logo</a>
			<input type="file"  name="brand_log" class="input-file">
			</span>
			<?php if (isset($error)) {
					echo $error;
			}?>
			<input type="text" placeholder="排序" value="" name="sort" class="input-text" style="width:120px">
			<button type="sumint" class="btn btn-success" id="" onClick="picture_colume_add(this);"><i class="Hui-iconfont">&#xe600;</i> 添加</button>
		</form>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="70">ID</th>
					<th width="80">排序</th>
					<th width="200">LOGO</th>
					<th width="120">品牌名称</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($brand as $key => $v) :?>
					<tr class="text-c">
						<td><?=$v['id']?></td>
						<td><input type="text" class="input-text text-c" value="<?=$v['sort']?>"></td>
						<td><img title="<?=$v['brand_name']?>" width="100" src="/<?=$v['brand_log']?>"></td>
						<td><?=$v['brand_name']?></td>
						<td class="f-14 product-brand-manage"><a style="text-decoration:none" onClick="product_brand_edit('品牌编辑','codeing.html','1')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="active_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});
</script>
</body>
</html>