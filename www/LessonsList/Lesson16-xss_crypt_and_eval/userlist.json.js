function log(x){
	console && console.log(x);
}

$(window).load(function(){
	$.ajax({
		url: 'http://myphp2.local/xss-source/data.php',
		type: 'post',
		dataType: 'jsonp',
		data: {},
		success: function(data){
			$.each(data, function(index, unit){
			
				function td(key){
					return '<td>' +  unit[key] + '</td>';
				}
				
				// make table row
				var row = '<tr>';
				var fields = ['id', 'name', 'surname', 'age'];
				$.each(fields, function(i, field){
					row += td(field);
				});
				row += '</tr>';
				// add row to table
				$('table#list').append(row);
			});
		},
		error: function(){}
	});
	
	
	// xss post sending
	
	$('button#send').click(function(){
		var text = $('#posttext').val();
		$.ajax({
		type: 'post',
		data: {'source-text' : text},
		url:'http://myphp2.local/xss-source/post.data.php',
		success: function(res){
			$('#postres').html(res);
		}
	});
	});
	

	//pure js
	var parent = document.getElementById('jscontent');
	var script = document.createElement('script');
	script.setAttribute('id', 'script_01');
	parent.appendChild(script);
	script.src = "http://myphp2.local/xss-source/data.php?callback=Samopal_2000";
	script.onload = function(){
		log(responseData);
	}
});

var responseData = '123';
function Samopal_2000(data){
	responseData = data;
}