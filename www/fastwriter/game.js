function log(x){ return console && console.log(x); }

log('game loads...');

$(window).load(function(){
/*
	function Animation(){
		
		var events = {};
		function fireEvent(name){
			if(! events[name]) return null;
			events[name]();
		}
		
		return {
			start: function(){},
			stop: function(){},
			// stop, start, beforestop, beforestart, end
			bind: function(name, handler){
				events[name] = handler;
			}
		};
	}
*/
	var loaded = false;
	var taskWords = [];
	$.ajax({
		type: 'post',
		dataType: 'json',
		url: '/fastwriter/application/loadDefaultData/',
		success: function(data){
			if(Array.isArray(data)){
				taskWords = data;
				log(taskWords);
				loaded = true;
			}
		}
	});

	var animationStopped = true;
	var frametime = 1000/60;
	function animation(){
		if(animationStopped) return;
		loop();
		setTimeout(function(){animation();}, frametime);
	}
	
	function start(){ 
		animationStopped = false; 
		animation(); 
	}
	
	function stop(){ animationStopped = true; }
	
	function toggle(){ animationStopped ? start() : stop(); }
	
	function loop(){
		log(1002);
		if(!taskWord){
			startTask();
		}
	}
	
	//var target =  null;
	
	//var nextWord = 0;
	var taskWord = null; // текущее слово
	var lastTaskIndex = 0; // последний введенный индекс текущего слова
	var wordSize = 3; // текущий размер слова
	var wordGroup = 1; // текущая сложность 
	var groups = [8, 10, 7, 7]; // группы в списке букв/символов
	//var groupsIndexes = [0, 8, 18, 25];
	var groupsIndexes = [7, 17, 25, 32]; // верхняя граница группы в списке символов
	var unbrackedSuccess = 0; // непрерывный успех
	var successCounterProc = 0; // общий успех в процентах
	var successCounter = 0; // общий успех в попытках
	var taskCounter = 0; // общее количество попыток
	 // 
	
	function startTask(){
		nextWord();
		$('div#game div#target')
			.css({"background-color":"#fff"})
			.html(taskWord);
		$('div#typing').html('...');
	}
	
	function nextWord(){
		
		taskWord = "";
		for(var i=0; i<wordSize; ++i){
			taskWord += taskWords[Math.round(Math.random() * groupsIndexes[wordGroup])]; // ???
		}
		lastTaskIndex = -1;
		taskCounter ++;
		return;
		// todo: change from next to random of group
		taskWord = taskWords[nextWord];
		lastTaskIndex = -1;
		//nextWord++;
	}
	
	function endTask(){
		taskWord = null;
	}
	
	
	function hitSuccess(){
		log('Win!!!');
		successCounter ++;
		endTask();
	}
	
	function fail(){
	//	endTask();
	}
	
	function userHit(e){
		log(e);
		e.preventDefault();
		if(!taskWord) return null;
		log(e.charCode);
		var entered = String.fromCharCode(e.charCode);
		var cemulator = $('div#typing');
		if(cemulator.html() == '...'){
			cemulator.html('');
		}
		if(entered == taskWord[lastTaskIndex+1]){
			cemulator.append('<span class="valid-char">'+ entered +'</span>');
			lastTaskIndex++;
			if(lastTaskIndex == (taskWord.length - 1)){
				return hitSuccess();
			}
		} else {
			log('fail');
			cemulator.append('<span class="wrong-char">'+ entered +'</span>');
			fail();
		}
		return false;
	}
	
	function preventBackspace(e){
		if(e.which == 8){
			e.preventDefault();
		}
	}
	
	$(document).bind('keydown', function(e){
		//alert(e.wich);
		preventBackspace(e);
	});
	
	$(document).keypress(function(e){
		preventBackspace(e);
		log(e)
		if(!loaded) return;
		// charCode
		// keyCode
		//log(e.keyCode);
		// 48-57 / [0]..[9]
		// 65-90 / [a]..[z]

		var code = e.keyCode;
		if(code == 13){
			onKeyEnter(e);
		} else if (code >= 48 && code <= 57){
			// numbers
		} else if((code >= 65 && code <= 90) ||(code >= 97 && code <= 122)){
			// chars
			userHit(e);
		}
		return false;
	});
	
	function onKeyEnter(e){
		//log('enter ' + e.keyCode);
		toggle();
	}
	
	

});