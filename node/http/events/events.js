var EventEmitter = require('events').EventEmitter
var life = new EventEmitter();
// 一般监听10个左右,太多可能会导致 内存泄露,10这个值可以进行更改
life.setMaxListeners(11);
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~1');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~2');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~3');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~4');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~5');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~6');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~7');
});

//移除事件
life.removeListener('求安慰',function(who){
	console.log('已经移除'+who);
});

life.on('求安慰',function(who){
	console.log('给'+who+'倒水~8');
});
life.on('求安慰',function(who){
	console.log('给'+who+'倒水~9');
});
life.on('求溺爱',function(who){
	console.log('[溺爱]给'+who+'倒水~10');
});
// 移除多个/所有
life.removeAllListeners('求溺爱');

life.on('求安慰',function(who){
	console.log('给'+who+'倒水~11');
});

life.emit('求安慰','汉子');
life.emit('求溺爱','汉子');
console.log(EventEmitter.listenerCount('life','求安慰'));
console.log(EventEmitter.listenerCount('life','求溺爱'));
