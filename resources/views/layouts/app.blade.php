<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<title>Oktatási rendszer | @yield('title', 'Kezdőlap')</title>
	<meta name="description" content="Example App">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        @guest
		    <a class="navbar-brand" href="{{ route('users-list') }}">Oktatási rendszer</a>
        @else
            <a class="navbar-brand" href="{{ route('home') }}">Oktatási rendszer</a>
        @endguest
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  	<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('kapcsolat') }}">Kapcsolat</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Regisztráció</a>
                        </li>
                    @endif
                @else
					<?php $istanar = (Auth::user()->foglalkozas == "tanar"); ?>
					<?php if ($istanar): ?>
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Tárgyaim</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('add-targy') }}">Új tárgy meghirdetése</a>
                        </li>
					<?php else: ?>
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Tárgyaim</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('all-targy') }}">Tárgy felvétele</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="{{ route('feladataim') }}">Feladatok listája</a>
                        </li>
					<?php endif; ?>
                    <li class="nav-item dropdown">
                        <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
							<a class="dropdown-item" href="{{ route('profil', ['id'=>Auth::user()->id, 'name'=>Auth::user()->name, 'email'=>Auth::user()->email, 'foglalkozas'=>Auth::user()->foglalkozas]) }}" ">
                                Profil
                            </a>
							
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Kijelentkezés
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
			</ul>
		</div>
	</nav>

    <div class="container my-3">
	    @yield('content')
	</div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
