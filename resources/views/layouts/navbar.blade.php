<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Главная</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(!auth()->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sign_up.create') }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.create') }}">Sign In</a>
                    </li>
                @else
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.posts.index') }}">Список
                                отзывов</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('user.posts.index') }}">Мои
                            отзывы</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>

                    <li class="nav-item">
                        <b class="nav-link" tabindex="-1"
                           aria-disabled="true">Пользователь: {{ Auth::user()->name }}</b>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

