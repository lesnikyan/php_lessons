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
		// Update event handler
		document.getElementById('update').onclick = function(){
			log('update click event');
			var xmlHttp = createRequestObject();
			var url = 'server-data.php';
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
		
		// Clear event handler
		document.getElementById('clear').onclick = function(){
			log('clear click event');
			document.getElementById('content').innerHTML = '';
			var url = 'server-data.php?clear=1';
			var responseHandler = function(response){
				document.getElementById('content').innerHTML = response;
			};
			var responseError = function(text, code){
				alert('Error response return ' + code + "\n" + text);
			};
			ajaxRequest('GET', url, responseHandler, responseError);
		};
	}
	
	// global var - XMLHttpRequest
	var ajaxXHR = null;
	
	// ajax request starter
	function ajaxRequest(method, url, responseSuccessHandler, responseErrorHandler){
		// if first call
		if(ajaxXHR == null)
			ajaxXHR = createRequestObject();
		
		ajaxXHR.open('GET', url, true);
		ajaxXHR.onreadystatechange = function(){
			if(ajaxXHR.readyState == 4){
				if(ajaxXHR.status == 200){
					responseSuccessHandler(ajaxXHR.responseText);
				} else {
					responseErrorHandler(ajaxXHR.responseText, ajaxXHR.status);
				}
			}
		};
		ajaxXHR.send(null);
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