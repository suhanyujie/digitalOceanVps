<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
		<title>操作成功</title>
		<link rel="stylesheet" type="text/css" href="__HDPHP_TPL__/static/css.css"/>
	</head>
	<body>
		<div class="wrap">
			<div class="title">
				操作成功
			</div>
			<div class="content">
				<div class="icon"></div>
				<div class="message">
					<div style="margin-top:10px;margin-bottom:15px;">
						缓存更新完毕
					</div>
                    3秒后刷新页面...
				</div>
			</div>
		</div>
		<script type="text/javascript">

            window.setTimeout(function(){
                parent.location.href='__MODULE__';
            },2000);
		</script>
	</body>
</html>