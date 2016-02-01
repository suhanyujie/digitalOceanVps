function learn(something){
	console.log(something);
}

function we(callback,something){
	console.log(something);
	something += ' extra ...';
	callback(something);
}

we(learn,'who are you?');

we(function(something){
	console.log(something);
},'suhanyu');