var http = require('http');
var cheerio = require('cheerio');
var url = 'http://www.imooc.com/index/search?words=node';

function filterChapter(html){
	var $ = cheerio.load(html);
	var chapters = $('.introduction');
	var courseData = [];
	chapters.each(function(item){
		var chapter = $(this);
		var chapterTitle = chapter.find('h2 a').text();
		console.log(chapterTitle);
		var chapterData = {
			title:chapterTitle
		}
		courseData.push(chapterData);
	})
	return courseData;
	console.log(chapterTitle);
	return false;
}

function printInfo(str){
	str.forEach(function(item){
		console.log(item+'\n');
	})
}

http.get(url,function(res){
	var html = '';
	res.on('data',function(data){
		html += data;
	});
	res.on('end',function(){
		var content = filterChapter(html);
		console.log(content);
		//printInfo(content);
	});
}).on('error',function(){
	console.log('数据出错~');
});