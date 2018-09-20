<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Codeline Movie</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Additional Style -->
  @yield('styles')
</head>
<body>
  <header>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('films') }}">Movie Website</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          @if(Auth::check())
          <ul class="nav navbar-nav navbar-right">  
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li role="separator" class="divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    &nbsp;&nbsp;<input class="btn link" type="submit" value="Logout" />
                  </form>
                </li>
              </ul>
            </li>
          </ul>
          @else
          <div class="pull-right btn"><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a></div>
          @endif
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
  <section class="content container-fluid">
      @yield('content')
  </section>

  <!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3 -->
  <script src="{{ asset("/bower_components/jquery/dist/jquery.min.js") }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
  <!-- Additional Script -->
  @yield('scripts')
  </body>
</html>
