
function log(x){
	console && console.log(x);
}

// load text (upload, return)
// format text
// read one word
function oneWordReader(){
	var data = {text: ''};
	data.index = 0;
	var words = [];

	function step1(){
		$('#content').html('');
	}
	function step2(){
		$('#content').html(words[data.index]);
		$('#counter').html(data.index++);
	}
	function iteration(interval){
		if(!words || words.length < data.index + 1 )
			return log('and of words, index = ' + words.length);
		step1();
		setTimeout(step2, 30);
	}
	
	return {
		next: function(interval){ return iteration(interval);},
		get wordLen(){ return words.length; },
		get currentIter(){return data.index; },
		set newText(text){
			data.text = text;
			words = text.split(' ');
			//log(words)
		}
	};
}
// read thick columl
// read blocks in string
// read string
// read multistring block

$(window).load(function(){
	var engine = {};
	var wordsPerMin = 500;
	var fps = 60*1000/wordsPerMin;
	function runEngine(){
		engine.position = 0;
		engine.text = 'q w e r t y u i o p';
		var action = new oneWordReader();
		var active = false;
		var blocked = false;
		function actor(){
			if(! active)
				return;
			setTimeout(function(){
				action.next();
				actor();
			}, fps);
		}
		function speed(){
			wordsPerMin = parseInt($('#speed').val());
			fps = 60*1000/wordsPerMin;
			log(fps)
		}
		function start(){
			speed();
			if(blocked) return;
			active = true;
			actor();
			lastStart = (new Date).getTime();
		}
		function stop(){
			if(blocked) return;
			if(active)
				active = false;
			lastStop = (new Date).getTime();
			fullTime += (lastStop - lastStart);
			var rating = action.currentIter / (fullTime/1000) * 60 ;
			$('#stat').html(' time = ' + (fullTime/1000) +
				'; speed = ' + rating + ' words per minute');
		}

		var fullTime = 0;
		var lastStart = 0;
		var lastStop = 0;
		function init(){
			lastStart = lastStop = (new Date).getTime();
		}

		function block(){
			blocked = true;
			$('#content').css({'background-color':'gray'});
		}
		function unblock(){
			blocked = false;
			$('#content').css({'background-color':'#ffffff'});
		}

		function prepareText(text){
			return text.replace(/[\s]+/mg, ' '); // .split(' ');
		}
		function load(){
			if(active) stop();
			block();
			var fileName = $('select#text-list option:selected').val();
			log('file = ' + fileName);
			$.ajax({
				type : 'post',
				url: 'upload.php',
				data: {file : fileName },
				dataType: 'json'
			})
				.done(function(rdata){
					if(! rdata || !rdata.text)
						return error('Load text: empty response.');
					resetText(rdata.text);
				});
		}

		function resetText(words){
			engine.text = words;
			action.newText = words;
			log('loaded');
			unblock();
			init();
		}

		function error(msg){
			log(msg);
		}

		engine.test = [];
		$('#content').click(function(e){
			engine.test.push(1);
			//log(engine.test.length);
		});
		$('body').bind('keyup', function(e){
			return;
			//log(e);
			//log(e.keyCode);
			if(e.keyCode == 32){
				active ? stop() : start();
			}
		});
		$('#content').click(function(e){
			active ? stop() : start();
		});
		$('button#load').click(function(){
			load();
		});
		$('#edit').click(function(){
			var text = $('#editor').val();
			var words = prepareText(text);
			resetText(words);
		});
		load(); // devmode
	}
	runEngine();
});