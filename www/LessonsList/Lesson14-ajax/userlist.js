function log(x){
	console && console.log(x);
}

$(window).load(function(){
	$.ajax({
		url: 'userlist.server.php',
		type: 'post',
		dataType: 'xml',
		data: {},
		success: function(data){
			log(data)
			//var xml = $.parseXML(data);
			//log(xml)
			var $xml = $(data);
			var users = $xml.find('users>user');
			log(users);
			$.each(users, function(index, unit){
			
				function td(key){
					return '<td>' + $(unit).attr(key) + '</td>';
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
});