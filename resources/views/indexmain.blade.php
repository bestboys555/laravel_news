
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>@yield('pageTitle')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{!! asset('plugins/bootstrap/dist/css/bootstrap.min.css') !!}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{!! asset('css/sticky-footer-navbar.css') !!}">
    @yield('csspage')
  </head>
  <body>
    <?php $url_segment_cat = Request::segment(2) ?>
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{ route('web.home') }}">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (request()->routeIs('web.home')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('web.home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach (get_table_all('news_category') as $value)
            <li class="nav-item {{ (($value->name==$url_segment_cat or (isset($category) and   $value->name==$category->name ))) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('web.category', ['id' => $value->name]) }}">{{ $value->name }}</a>
            </li>
            @endforeach
          </ul>
          <form class="form-inline mt-2 mt-md-0" method="GET" action="{{ route('web.search') }}">
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
        @yield('content')
    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Footer</span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{!! asset('js/jquery-3.3.1.min.js') !!}"></script>
    <script>window.jQuery || document.write('<script src="{!! asset('src/js/vendor/jquery-3.3.1.min.js') !!}"><\/script>')</script>
    <script src="{!! asset('plugins/popper.js/dist/umd/popper.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    @yield('scriptpage')
  </body>
</html>
