// 使用方法 casperjs/bin/casperjs test.js https://www.baidu.com a.png #lg
// cd /www/html/node/casperjs/  &&  casperjs/bin/casperjs test.js

/*
var casper = require('casper').create();

var args = casper.cli.args;
var url = args[0];
var filename = args[1];
var selector = args[2];*/


var args = require('system').args; 
var util = require('utils');

phantom.outputEncoding="utf-8";
//var url = "https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&tn=baidu&wd=";
//var url = 'http://www.zol.com.cn/';
var url = './mobile.html';
//url = url+word;
var jq = args[5]!= undefined ?args[5]+'/Script/jquery.js':'jquery.js';      // These jquery scripts will be injected in remote

var casper = require('casper').create({
    clientScripts:  [
//                     jq, 
                 ],
                 
	pageSettings: {
        loadImages:  true,
        loadPlugins: true,
        userAgent : 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
//        userAgent : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0',
//        userAgent : 'Mozilla/5.0 (Windows NT 6.1; rv:17.0) Gecko/20100101 Firefox/17.0',
//        userAgent : 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',
    }, 

    timeout 	: 20000, //10s
    waitTimeout : 1000,
    logLevel	: "info",            // Only "info" level messages will be logged 日志等级
    verbose		: true,             // log messages will be printed out to the console // 记录日志到控制台
 
});

casper.start(); 
casper.open(url);

casper.wait(300, function() { 
	var  data = new Array();
	var imgLength = 0;
	this.echo('start');
	data = this.evaluate(function getDadaFromPage() {

		
		//$('img').attr('src','https://placeholdit.imgix.net/~text?txtsize=33&txt=320%C3%97320&w=320&h=320');
		var iframe = document.getElementsByTagName('iframe');
		for(var i = 0; i<iframe.length; i++){
		   iframe[i].parentNode.removeChild(iframe[i])
		}
		
		var ad = document.querySelectorAll('.gmine_ad');
		for(var i = 0; i<ad.length; i++){
			ad[i].parentNode.removeChild(ad[i])
		}
		
		var ad = document.querySelectorAll('.ad-box');
		for(var i = 0; i<ad.length; i++){
			ad[i].parentNode.removeChild(ad[i])
		}
		
		var img = document.querySelectorAll('img');
		imgLength = img.length;
		for(var i = 0;i<img.length; i++){
			img[i].src='http://icon.zol-img.com.cn/cms/placeholder/?/500/ee6a5c/1e1e1e/';
		}
		
		
		// 滚动 加载懒加载的元素
		$(window).scrollTop($(document).height());
		
	});

	this.echo('img标签的个数是：' + imgLength);
});

casper.wait(1000,function(url){
	this.capture('/www/html/laravel/html/blog/public/test/index1.png');
}); 

casper.then(function(){
	this.echo('Done!').exit();
}); 



/*跑起来  输出结果*/
casper.run();


