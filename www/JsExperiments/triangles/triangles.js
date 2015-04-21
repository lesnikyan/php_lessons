
function log(x){
	console && console.log(x);
}

$(window).load(function(){
	log(123);
	var render = new Render($('canvas#maincan'));
});

function Render(canvas){
	this.canvas = canvas;
	
	return {
		pixel: function(){},
		line: function(){},
		triangle: function(){},
		fillTriangle: function(){}
	};
}