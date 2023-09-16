<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RecipeHub - Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">RecipeHub</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item {{Request::is('/') ? "active" : ""}}">
                <a class="nav-link" aria-current="page" href="/">Home</a>
              </li>
            </ul>
            <!-- Example single danger button -->
            <div class="btn-group" style="margin-right:8px;">
              <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Account
              </button>
              <ul class="dropdown-menu">
                @auth
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <form name="logoutForm" method="POST" action="{{route('login.destroy')}}">
                    @method('DELETE')
                    @csrf
                    <li><button type="submit" class="dropdown-item">Logout</button></li>
                  </form>
                @else  
                  <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                  <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>
                @endauth
              </ul>
            </div>
            @auth
            <form class="d-flex" role="search" method="GET" action="{{route('user.search')}}">
              <input class="form-control me-2" type="search" name="navSearch"
              id="navSearch" placeholder="Search" aria-label="Search"
              @if(request()->is('recipes') || request()->is('search/user'))
               autofocus  
              @endif
              > 
            @endauth
            @guest
            <form class="d-flex" role="search" method="GET" action="{{route('guest.search')}}">
              <input class="form-control me-2" type="search" name="navSearch"
              id="navSearch" placeholder="Search" aria-label="Search"
              @if(request()->is('/') || request()->is('search/guest'))
               autofocus  
              @endif
              > 
            @endguest
              @csrf
              
              
              

              
              
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    <div class="container-fluid">
     
        

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    @yield('scripts')
  </body>
</html>