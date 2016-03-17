
var GMode = {fill:2, stroke:1};

function Geometry(){
	
	var screen = null;
	var context = null;
	
	var dStroke = GMode.stroke;
	var dFill = GMode.fill;
	
	function init(canvas){
		log($(canvas)[0]);
		screen = $(canvas)[0];
		context = screen.getContext('2d');
	}
	
	// [x,y], [x,y]
	function line(a,b){
		
	}
	
	function hexagon(center, radius, angle, mode){
		mode = ! mode ? dStroke : mode;
		polygon(center, radius, 6, angle, mode);
	}
	
	function polygonPoints(center, radius, cornersNum, angle){
		//log([center, radius, cornersNum, angle]);
		angle = (! angle) ? 0 : angle;
		var x = center[0];
		var y = center[1];
		var points = [];
		var rAngle = 2 * Math.PI / cornersNum; // rotation angle
		for(var i=0; i<cornersNum; ++i){
			points.push( x + Math.cos(rAngle * i + angle) * radius);
			points.push( y + Math.sin(rAngle * i + angle) * radius);
		}
		//log(points);
		return points;
	}
	
	function drawPolygon(points, mode){
		context.beginPath();
		context.moveTo(points[0], points[1]);
		var len = points.length;
		for(var i=2; i < len; i+=2){
			context.lineTo(points[i], points[i+1]);
		}
		context.closePath();
		//log([mode , dStroke, mode & dStroke]);
		if(mode & dStroke){
			//log('stroke');
			context.stroke();
		}
		if(mode & dFill){
			//log('fill');
			context.fill();
		}
	}
	
	function polygon(center, radius, cornersNum, angle, mode){
		drawPolygon(polygonPoints(center, radius, cornersNum, angle), mode);
	}
	
	function setColors(stroke, fill, lWidth){
		if(stroke){
			context.strokeStyle = stroke;
		}
		if(fill){
			context.fillStyle = fill;
		}
		if(lWidth){
			context.lineWidth = lWidth;
		}
		
	}
	
	return {
		init: function(canvas){ init(canvas); return this; },
		colors: function(stroke, fill, lWidth){setColors(stroke, fill, lWidth);},
		hexagon: function(center, radius, angle, mode){ hexagon(center, radius, angle, mode); },
		polygon: function(center, radius, cornersNum, angle, mode){ polygon(center, radius, cornersNum, angle, mode); },
		stroke: function(){},
		fill: function(){},
		line: function(a,b){},
		lines: function(points){}
	};
}
