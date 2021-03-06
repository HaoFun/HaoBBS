<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/') }}">
                HaoBBS
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ active_class(if_route('posts.index')) }}"><a href="{{ route('posts.index') }}">主題</a></li>
                @foreach($header_topics as $header_topic)
                    <li class="{{ active_class(if_route('topics.show') && if_route_param('topic',$header_topic->id)) }}">
                        <a href="{{ route('topics.show',$header_topic->id) }}">{{ $header_topic->name }}</a>
                    </li>
                @endforeach
            </ul>


            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">登入</a></li>
                    <li><a href="{{ route('register') }}">註冊</a></li>
                @else
                    <li>
                        <a href="{{ route('posts.create') }}">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>
                    </li>
                    {{--消息通知--}}
                    <li>
                        <a href="{{ route('notifications.index') }}" class="notifications-badge">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ?'hint':'fade' }}" title="通知">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right: 8px;margin-top: -5px">
                                <img src="{{ Auth::user()->avatar ?:asset('images/avatar/avatar.png') }}" class="img-responsive img-circle"
                                alt="avatar" style="width: 30px;height: 30px">
                            </span>
                            {{ Auth::user()->name }} <span class="creat"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('users.show',Auth::id()) }}">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    個人中心
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.edit',Auth::id()) }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    編輯自介
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById
                                ('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                    用戶登出
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>