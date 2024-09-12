<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Заказы</title>

	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>
<body>

	<header>
		<h1>@yield('title')</h1>
	</header>

	<main>@yield('content')

		<p>&nbsp;</p>
		<p>
	 		<a href="{{ route('order.list' )}}">Список заказов</a>
	 	</p>
	</main>



	<footer>
		&copy; TOP {{ date('Y') }}
	</footer>
	
</body>
 

</html>