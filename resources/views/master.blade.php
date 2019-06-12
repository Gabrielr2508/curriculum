<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>

		<title>Trabalhe conosco</title>

		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
		<link rel="stylesheet" href="{{ mix('css/main.min.css') }}">
	</head>
<!-- Uses a transparent header that draws on top of the layout's background -->
	<body>
		<div id="app">
		</div>
		<script src="{{ mix('js/app.js') }}"></script>
	</body>
</html>