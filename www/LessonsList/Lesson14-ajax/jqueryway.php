<html>
<head>
	<title>jQuery way</title>
	<style type="text/css">
		#content{
			border: 1px solid silver;
			margin: 10px;
			height: 100px;
		}
		#tools{
			border: 1px solid silver;
			margin: 10px;
		}
		#tools button{
			
		}
	</style>
	<script type="text/javascript">
		function log(x){
			console && console.log(x);
		}
	
	</script>
	
	<script type="text/javascript" src="/jquery.js"></script>
	
	<script type="text/javascript">
		$(window).load(function(){
			$('#clear').click(function(){
				$.ajax({
					type: 'get',
					url:'server-data.php?clear',
					success: function(data){
						$('#content').html(data);
					},
					error: function(data){
						alert('Error response return ' + data.status);
					}
				});
			});
			
			$('#update').click(function(){
				$.ajax({
					type: 'post',
					data: { x: 1, name: 'Vasya'}, // => $_POST
					url:'server-data.php',
					success: function(data){
						$('#content').html(data);
					}
				});
			});
		});
	</script>
</head>
<body>
	<div id="content">...</div>
	<div id="tools">
		<button id="clear">Clear</button>
		<button id="update">Update</button>
		</div>
</body>
</html>