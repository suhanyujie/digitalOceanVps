var http = require('http');
var querystring = require('querystring');

var postData = querystring.stringify({
	'content':'请问，后续会有更深入学习的课程吗？',
	'cid':8837
});

var options = {
		hostname : 'www.immoc.com',
		port : 80,
		path : '/course/docomment',
		method : 'POST',
		headers : {
			'Accept':'application/json, text/javascript, */*; q=0.01',
			'Accept-Encoding':'gzip, deflate',
			'Accept-Language':'zh-CN,zh;q=0.8',
			'Connection':'keep-alive',
			'Content-Length':postData.length,
			'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8',
			'Cookie':'imooc_uuid=e07e940a-fe7d-473e-bdcb-8399af66afc4; imooc_isnew_ct=1452387880; IMCDNS=0; PHPSESSID=1pjlpmpfv69lj41enqpuajn1n2; loginstate=1; apsid=cwNzdhNGJjZmIzOGIwZDRmZWVmMmVmZDQ5NGYzYjUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjU4NTAyAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABzdWhhbnl1amllQHFxLmNvbQAAAAAAAAAAAAAAAAAAAGFiN2U2ZDVkOTBlNWJjMzNiZTU1NmNmYzA3OWY5MWFiwM2iVsDNolY%3DYj; last_login_username=suhanyujie%40qq.com; jwplayer.qualityLabel=è¶æ¸; Hm_lvt_f0cfcccd7b1393990c78efdeebff3968=1452387766,1453509927; Hm_lpvt_f0cfcccd7b1393990c78efdeebff3968=1453519147; cvde=56a2cda8c962c-36; imooc_isnew=2',
			'Host':'www.imooc.com',
			'Origin':'http://www.imooc.com',
			'Referer':'http://www.imooc.com/video/8837',
			'User-Agent':'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36 2345Explorer/6.5.0.11018',
			'X-Requested-With':'XMLHttpRequest'
		}
}

var req = http.request(options,function(res){
	console.log('Status : '+res.statusCode);
	console.log('Header : '+JSON.stringify(res.headers));
	res.on('data',function(chunk){
		console.log(Buffer.isBuffer(chunk));
		console.log(typeof(chunk));
	});
	res.on('end',function(){
		console.log('end~');
	});
});

req.on('error',function(e){
	console.log('Error:'+e.message);
});
req.write(postData);
req.end();


