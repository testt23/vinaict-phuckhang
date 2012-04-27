<html>
	<head>
		<title><?php echo $say_hello; ?></title>
		<script type="text/javascript" src="http://localhost/pos/example/js/jquery.tools.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#demo img[title]").tooltip({ effect: 'slide' }).dynamic({
															bottom: { direction: 'down', bounce: true },
															right: { direction: 'right', bounce: true }
														});
			});
			
			function submitData() {
				var param1 = document.getElementById('param1');
				var param2 = document.getElementById('param2');
				var val = document.getElementById('val');
				document.form.action = "http://localhost/pos/example/hello/index/" + param1.value + "/" + param2.value + "/?val=" + val.value;
				document.form.submit();
			}
		</script>
		<style>
			.tooltip {
				display:none;
				/*background:transparent url(/tools/img/tooltip/black_arrow.png);*/
				background-color: #FFE082;
				font-size:12px;
				padding:5px;
				color:#000;
			}
		</style>
	</head>
	<body>
		<div id="demo">
			<img src="http://static.flowplayer.org/tools/img/photos/1.jpg" title="This is image 1" >
			<img src="http://static.flowplayer.org/tools/img/photos/2.jpg" title="This is image 2" >
			<img src="http://static.flowplayer.org/tools/img/photos/3.jpg" title="This is image 3" >
			<img src="http://static.flowplayer.org/tools/img/photos/4.jpg" title="This is image 4" >
		</div>
		<form name="form" method="get">
		Parameter 1 <input type="text" id="param1" >
		Parameter 2 <input type="text" id="param2" >
		Value <input type="text" id="val" >
		<br><input type="button" value="Click here" onclick="submitData()" >
		<br><?php echo $say_hello; ?>
		</form>
	</body>
</html>
