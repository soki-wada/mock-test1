<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-logo-wrapper">
                <img src="{{asset('images/logo.png')}}" alt="" class="header-logo">
            </div>
            <div class="header-search-form-wrapper">
                <form action="" class="header-search-form">
                    @csrf
                    <input type="text" class="header-search-form-input" placeholder="なにをお探しですか？">
                </form>
            </div>
            <div class="header-button">
                <div class="header-button-wrapper">
                    @auth
                    <form action="/logout" class="header-form-logout" method="post">
                        @csrf
                        <button class="header-button-item" type="submit">ログアウト</button>
                    </form>
                    @else
                    <div class="header-button-wrapper">
                        <a href="/login" class="header-button-item">
                            ログイン
                        </a>
                    </div>
                    @endauth
                </div>
                <div class="header-button-wrapper">
                    <a href="" class="header-button-item">
                        マイページ
                    </a>
                </div>
                <div class="header-button-wrapper">
                    <a href="/sell" class="header-button-item white">
                        出品
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('js')
</body>

</html>