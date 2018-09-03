<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Phonebook</title>
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
	<div id="app">
		<Myheader></Myheader>
			<div class="container">
				<router-view></router-view>
			</div>
		<Myfooter></Myfooter>
	</div>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>