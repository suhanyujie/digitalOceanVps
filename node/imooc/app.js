var express = require('express');
var path = require('path');
var port = process.env.PORT || 8124;
var app = express();

app.set('views','./views/pages');
app.set('view engine','jade');
app.use(express.bodyParser());
app.use(express.static(path.join(__dirname,'bower_components')));
app.listen(port);

console.log('imooc start on port:'+port);

//路由
// 首页
app.get('/',function(req,res){
	res.render('index',{
		title:'imooc-首页',
		movies:[{
			title:'电影1',
			_id:1,
			poster:'http://www.baidu.com'
		},{
			title:'电影2',
			_id:2,
			poster:'http://www.baidu.com'
		},{
			title:'电影3',
			_id:3,
			poster:'http://www.baidu.com'
		}]
	});
});
// 列表页
app.get('/admin/list',function(req,res){
	res.render('list',{
		title:'imooc-列表页',
		movies:[{
			title:'机械战警',
			_id: 1,
			doctor:'何塞 帕迪利亚',
			country:'美国',
			year:'2014',
			language:'英语',
			flash:'http://www.baidu.com/',
			summary:'这是简介。。。这是简介。。。这是简介。。。'
		}]
	});
});
//详情页
app.get('/movie/:id',function(req,res){
	res.render('detail',{
		title:'imooc-详情页'
	});
});
// 后台
app.get('/admin/movie',function(req,res){
	res.render('admin',{
		title:'imooc-后台'
	});
});
