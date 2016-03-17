
function log(x){ console && console.log(x);}

$(window).load(function(){
	
	var graf = Geometry().init(('canvas#main-screen'));
	var radius = 16;
	var inRadius = 12;
	var lineWidth = 2;

	var xStart = 1; // - radius + 5;
	var yStart = 0;
	var rows = 32;
	var rowLen = 40;	
	
	function rgb(r,g,b){
		return 'rgb('+r+','+g+','+b+')';
	}
	function randomColor(range, max){
		max = typeof max != 'undefined' ? max : 255;
		range = range + max <= 255 ? range : max;
		var r,g,b;
		r = Math.floor(Math.random() * range) + max - range;
		g = Math.floor(Math.random() * range) + max - range;
		b = Math.floor(Math.random() * range) + max - range;
		return rgb(r,g,b)
	}
	function drawHexagon(x,y){
		graf.colors('#ff8800', randomColor(100, 255), lineWidth);
		graf.hexagon([x,y], inRadius, Math.PI/6, GMode.fill); // GMode.fill|GMode.stroke
		graf.hexagon([x,y], radius, Math.PI/6, GMode.stroke); // GMode.fill|GMode.stroke
	}
	
	function drawHexagonRow(x0, y0, num){
		for(var i=0; i<num; ++i){
			drawHexagon(x0 + Math.cos(Math.PI/6) * 2 * radius * i, y0);
		}
	}
	
	var time1 = new Date().getTime();
	for(var i=0; i<=rows; ++i){
		drawHexagonRow(xStart + (i%2)*(Math.cos(Math.PI/6) * radius), yStart + i*1.5*radius, rowLen);
	}
	var time2 = new Date().getTime();
	log(time2 - time1);
//	drawHeagonRow(xStart, yStart + 3 * radius, 16);
//	drawHexagon(x0 + Math.cos(Math.PI/6)*radius, 100);
//	drawHexagon(300, 100);
});