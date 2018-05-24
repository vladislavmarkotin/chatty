<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <a class="navbar-brand" href="/home">Chatty.com</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling
     @if (Route::has('login'))
                      @if (Auth::check())
                     <form class="form-search"  action="{{ 'search' }}">
                        <input name="search" type="text" class="input-medium search-query">
                        <button type="submit" class="btn">Найти</button>
                     </form>
                     @endif
                      @endif
                      -->
      @if (Route::has('login'))
        @if (Auth::check())
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li><a href="/user/{{ Auth::user()->getId() }}">{{ Auth::user()->getName() }}</a> </li>
        <li class="active"><a href="/friends">Friends</a></li>
        <li><a href="/timeline">Timeline</a></li>
        <li><a href="/messages">Messages</a></li>
        <li class="dropdown">
          <a href="/another" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/"></a> </li>
            <li><a href="#">Действие</a></li>
            <li><a href="#">Другое действие</a></li>
            <li><a href="#">Что-то еще</a></li>
            <li class="divider"></li>
            <li><a href="#">Terms and Conds</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Log out</a></li>
          </ul>
        </li>
        <li><a href="/user/{{ Auth::user()->getId() }}/edit">Edit Profile</a></li>
        <li><a href="/logout">Log out</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" action="{{ 'search' }}">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
        </div>
        <button type="submit" class="btn btn-default">Поиск</button>
      </form>



        @else
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Sign up</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Действие</a></li>
            <li><a href="#">Другое действие</a></li>
            <li><a href="#">Что-то еще</a></li>
            <li class="divider"></li>
            <li><a href="#">Отдельная ссылка</a></li>
          </ul>
        </li>
      </ul>
      @endif
         @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>