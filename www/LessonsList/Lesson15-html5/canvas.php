<html>
<head>
	<title></title>
	<style type="text/css">
	canvas#display{
		border: 1px solid #aaa;
	}
	
	</style>
	
	<script type="text/javascript" src="/jquery.js"></script>
	
	<script type="text/javascript">
	
function log(x){
	return console && console.log(x);
}	
	
$(window).load(function(e){
	
	var canvas = $('#display')[0];
	var ctx = canvas.getContext('2d');
	var width = canvas.width;
	var height = canvas.height;
	
	ctx.fillStyle = '#e0e0e0';
	ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);
	
	function circle(center, radius, colorFill, colorStroke){
		ctx.beginPath();
		ctx.arc(center[0], center[1], radius, 0, Math.PI*2);
		ctx.closePath();
		
		ctx.fillStyle = colorFill;
		ctx.strokeStyle = colorStroke;
		
		ctx.fill(); //заливка
		ctx.stroke(); // обводка
	}
	
	var imageSmile = new Image();
	imageSmile.src = 'smile.png';
	$(imageSmile).load(function(){
		log('image size = ' + this.width + ' x ' + this.height)
	});
	
	function drawImage(image, point){
		var w = image.width;
		var h = image.height
		ctx.drawImage(image, point[0]-w/2, point[1]-h/2, w, h);
	}
	
	var chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
	
	function drawChar(){
		var c = chars.charAt(Math.floor(Math.random()*chars.length));
		ctx.font = '20px Arial';
		
		ctx.strokeStyle = '#0a0';
		ctx.textAlign = 'center';
		var x = Math.floor(Math.random()*width);
		var y = Math.floor(Math.random()*height);
		ctx.strokeText(c, x, y);
	}
	
	$('#display').click(function(e){
		var point = [e.offsetX, e.offsetY];
		log(point);
		drawImage(imageSmile, point);
		
		circle([point[0]+40, point[1]], 5, '#fff', '#f00');
		circle([point[0]-40, point[1]], 5, '#fff', '#f00');
		circle([point[0], point[1]+40], 5, '#fff', '#f00');
		circle([point[0], point[1]-40], 5, '#fff', '#f00');
	});
	
	var stopped = false;
	$('#stop-start').click(function(){
		stopped ? start() : stop();
	});
	
	
	function animation(){
		if(stopped)
			return;
		drawChar();
		setTimeout(function(){animation();}, 100);
	}
	
	function start(){
		stopped = false;
		$('#stop-start').text('stop');
		animation();
	}
	
	function stop(){
		stopped = true;
		$('#stop-start').text('start');
	}
	
	start();
	
});
	</script>
</head>
<body>
	<div id="content">
		<canvas id="display" width="800px" height="400px" ></canvas>
	</div>
	<div><button id="stop-start">stop</button></div>
</body>
</html>