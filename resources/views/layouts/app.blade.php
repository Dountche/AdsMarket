<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MonSiteAnnonces')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">MonSiteAnnonces</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('ads.index') }}">Annonces</a></li>
        @auth
        <li class="nav-item"><a class="nav-link" href="{{ route('ads.create') }}">Publier une annonce</a></li>
        @endauth
      </ul>
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Mon profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
    @includeWhen(session('success'), 'partials.alert-success')
    @yield('content')
</div>

<footer class="bg-light text-center py-3 mt-auto">
  <small>&copy; {{ date('Y') }} MonSiteAnnonces</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
