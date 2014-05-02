function log(x){
	console && console.log(x);
}

$(window).load(function(){
	$.ajax({
		url: 'userlist.server.json.php',
		type: 'post',
		dataType: 'json',
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
	
	$.ajax({
		url: 'userlist.server.jsonp.php',
		type: 'post',
		dataType: 'jsonp',
		success:function(data){
			log(data);
		}
	});
});