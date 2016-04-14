var fs = require('fs');
fs.readFile('index.js','utf-8',function(err,data){
    console.log(data);
});