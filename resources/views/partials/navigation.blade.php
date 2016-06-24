<nav class="navbar navbar-default">
    <div class="container">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#categories">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse" id="categories">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}" class="active">Informacija</a></li>
                @if(Auth::check())
                    <li><a href="{{ route('order.list') }}">Užsakymų sąrašas</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::check())
                    <li><a href="{{ route('auth.login') }}">Prisijungti</a></li>
                    <li><a href="{{ route('auth.register') }}">Užsiregistruoti</a></li>
                @else
                    <li><a href="{{ route('auth.logout') }}">Atsijungti</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>