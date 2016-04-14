<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title>爱生活-锲而不舍</title>
<meta name="description"  content="苏汉宇的个人博客，分享一些所学技术，以及做一些个人兴趣爱好的展示。">
<meta name="keywords"  content="">
<meta name="HandheldFriendly" content="True" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/8.5/styles/monokai_sublime.min.css">
<!--  <link rel="stylesheet" type="text/css" href="http://izhengyin.com/css/main.css" />   -->

<script>
	//  1. Sidebar Position
	var sidebar_left = false; // Set true or flase for positioning sidebar on left

	//  2. Recent Post count
	var recent_post_count = 3;
</script>

<script>
	var _hmt = _hmt || [];
</script>
<style type="text/css">
	.container  .post-content pre code .hljs-variable{
		color:#f92672;
	}
	.container .post-content pre{
		font-size:12px;
		background:#f7f7f7;
	}
</style>
</head>

<body class="home-template">
	<!-- start navigation -->
<nav class="main-navigation">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="navbar-header">
					<span class="nav-toggle-button collapsed" data-toggle="collapse"
						data-target="#main-menu"> <span class="sr-only">Toggle
							navigation</span> <i class="fa fa-bars"></i>
					</span>
				</div>
				<div class="collapse navbar-collapse" id="main-menu">
					<ul class="menu">
						<li class="nav-current"  role="presentation"><a target="_self" href="/">首页</a></li><li style="display:none;" role="presentation"><a target="_self" href="/Posts" >博文</a></li><li role="presentation" style="display:none;"><a target="_self" href="/detail/21.html">Yaf视频</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>


<!-- end navigation -->
	<!-- start site's main content area -->
	<section class="content-wrap">
		<div class="container">
			<div class="row">
				<main class="col-md-8 main-content">
					@foreach($data['articles']['data'] as $row)
						<article id=52 class="post tag-laravel-5-1 tag-artisan">
                        	<div class="post-head">
                        		<h1 class="post-title">
                        			<a href="{{url('articles',$row['id'])}}">{{$row['title']}}</a>
                        		</h1>
                        		<div class="post-meta">
                        			<span class="author">作者：<a href="http://weibo.com/u/1889337694">suhy</a></span>
                        			&bull;
                        			<time class="post-date" datetime="{{ $row['publish_date'] }}"
                        				title="{{ $row['publish_date'] }}">{{ $row['publish_date'] }}</time>
                        		</div>
                        	</div>
                        	<div class="post-content">
                        		{!! mb_substr(strip_tags($row['content']['content']),0,200,'utf-8') !!}
                        	</div>
                        	<div class="post-permalink">
                        		<a href="{{url('articles',$row['id'])}}" class="btn btn-default">阅读全文</a>
                        	</div>
                        
                        	<footer class="post-footer clearfix">
                        		<div class="pull-left tag-list">
                        			 <span class='glyphicon glyphicon-eye-open' style="padding-left:10px;"><span style="padding-left:3px;">共有136人浏览</span></span>
                        		</div>
                        		<div class="pull-right share"></div>
                        	</footer>
                        </article>
					
					@endforeach
					
					
					<nav class="pagination" role="navigation">
    					@if(isset($data['articles']['next_page_url']))
							<a class="older-posts" href="{{$data['articles']['next_page_url']}}"><i class="fa">下一页</i></a>
						@endif
					</nav>
				</main>

				<aside class="col-md-4 sidebar">
	<!-- start widget -->
	<!-- end widget -->

	<!-- start tag cloud widget -->
	<div class="widget">
		<h4 class="title">最近文章</h4>
		<ul style="list-style:none;padding:0px;font-size:14px;">
	  	  	<li><a href="/detail/22.html" class="list-group-item" style="border:none;">Socket.io的实时竞拍系统实现</a></li>
		</ul>
	</div>
	<!-- end tag cloud widget -->

	<!-- start widget -->
		<div class="widget">
		<h4 class="title">博文分类</h4>
		<ul style="list-style:none;padding:0px;font-size:14px;">
			<li><a href="/list/13.html" class="list-group-item" style="border:none;">PHP<span class="badge">3</span></a></li>
		</ul>
	</div>
		<!-- end widget -->
	
	<!-- start tag cloud widget -->
		<div class="widget">
		<h4 class="title">标签云</h4>
		<div class="content tag-cloud">
						<a href="/tag/5.html">Mysql</a>
						<a href="/tag/6.html">Yaf</a>
						<a href="/tag/7.html">Yar</a>
						<a href="/tag/8.html">Mongodb</a>
						<a href="/tag/9.html">Amoeba</a>
						<a href="/tag/10.html">PHP进程管理</a>
						<a href="javascript:void(0);">...</a>
		</div>
	</div>
		<!--  end tag cloud widget -->
	<!-- start widget -->
	<div class="widget">
		<h4 class="title">联系我</h4>

		<p style="margin-top:10px;"><wb:follow-button uid="3204981003" type="red_4" width="100%" height="64" ></wb:follow-button></p>
		
		<p style="margin-top:10px;"><span style="color:red;">Email</span> : suhanyujie@163.com</p>
	</div>
	<!-- end widget -->
</aside>
			</div>
		</div>
	</section>

	
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<span>Copyright &copy; <a href="http://izhengyin.com/">laravel.suhanyu.top 个人博客</a> </span> | <span><a href="http://www.miibeian.gov.cn/"
						target="_blank">爱生活-锲而不舍</a>
			</div>
		</div>
	</div>
</div>

<a href="#" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/fitvids/1.1.0/jquery.fitvids.min.js"></script>
<script src="http://cdn.bootcss.com/highlight.js/8.5/highlight.min.js"></script>

</body>
</html>