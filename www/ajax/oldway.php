<html>
<head>
	<title>ajax old way</title>
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
	
	
	<script type="text/javascript">
	// normal
	var xhr = new XMLHttpRequest();
	// IE
	var xhrIE1 = new ActiveXObject('Msxml2.XMLHTTP');
	// IE another
	var xhrIE2 = new ActiveXObject('Microsoft.XMLHTTP');
	// universal code:
	function createRequestObject() {
	  if (typeof XMLHttpRequest === 'undefined') {
		XMLHttpRequest = function() {
		  try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
			catch(e) {}
		  try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
			catch(e) {}
		  try { return new ActiveXObject("Msxml2.XMLHTTP"); }
			catch(e) {}
		  try { return new ActiveXObject("Microsoft.XMLHTTP"); }
			catch(e) {}
		  throw new Error("This browser does not support XMLHttpRequest.");
		};
	  }
	  return new XMLHttpRequest();
	}

	
	function load(){
		//log(xmlHttp);
		document.getElementById('clear').onclick = function(){
			log('clear click event');
			document.getElementById('content').innerHTML = '';
		};
		document.getElementById('update').onclick = function(){
			log('update click event');
			var xmlHttp = createRequestObject();
			var url = 'oldway.server.php';
			xmlHttp.open('GET', url, true);
			xmlHttp.onreadystatechange = function(){
				if(xmlHttp.readyState == 4){
					var response = xmlHttp.responseText;
					log(response);
					document.getElementById('content').innerHTML = response;
				}
			}
			xmlHttp.send(null);
		};
	}
	
	</script>
</head>
</html>
<body onload="load();">
	<div id="content">123 qwe</div>
	<div id="tools">
		<button id="clear">Clear</button>
		<button id="update">Update</button>
	</div>
</body>