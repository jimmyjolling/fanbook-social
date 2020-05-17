<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <title>@yield('title') | Fanbook</title>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                @if (auth::check())
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Fanbook
                </a>
                @else
                <a class="navbar-brand" href="{{ route('login') }}">
                    Fanbook
                </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <form action="{{ route('profile.search') }}" class="form-inline my-2 my-lg-0" method="post">
                        @csrf
                            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search profiles">
                            <button type="submit" class="btn btn-outline-light my-2 my-sm-0">Search</button>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (session('search'))
            <div class="alert alert-danger text-center">
                {{ session('search') }}
            </div>
            @endif
        <main class="py-4">
            
            @yield('content')
        </main>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript">
    @if ($errors->has('title') || $errors->has('content'))
        $('#PostModal').modal('show');   
    @endif

    $('#editPost').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var title = button.data('mytitle')
        var content = button.data('mycontent')
        id = button.data('myid')

        $('#editPost').find('#title-edit').val(title)
        $('#editPost').find('#content-edit').val(content)
        $('#editPost').find('#post-id').val(id)
        $('#editPost').find('#post-id-delete').val(id)
    })

    $('#editComment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var content = button.data('mycommentcontent')
        id = button.data('mycommentid')

        $('#editComment').find('#comment-content-edit').val(content)
        $('#editComment').find('#comment-id').val(id)
        $('#editComment').find('#comment-id-delete').val(id)
    })
</script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
