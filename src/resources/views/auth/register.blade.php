<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashionably Late</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&family=Inika:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/register">
          Fashionably Late
        </a>
        <nav>
          <ul class="header-nav">
            <li class="header-nav__item">
              <a class="header-nav__link" href="/login">
                <button class="login-button">Login</button>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <div class="register__content">
      <div class="register__heading">
        <h2>Register</h2>
      </div>
      <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}" />
            </div>
            <div class="form__error">
              @error('name')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form__error">
              @error('email')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="password" name="password" placeholder="例:coachtechno6" />
            </div>
            <div class="form__error">
              @error('password')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</body>
