<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashionably Late</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&family=Inika:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">
          Fashionably Late
        </a>
        <nav>
          <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
              <form class="form" action="/logout" method="post">
                @csrf
                <button class="header-nav__button">logout</button>
              </form>
            </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <div class="admin__content">
      <div class="admin__heading">
        <h2>Admin</h2>
      </div>

      <form class="search-form" action="/admin" method="get">
        @csrf
        <div class="search-container">
          <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください" class="search-box" />
          <select class="search-box" name="gender">
            <option value="">性別</option>
            <option value="all">全て</option>
            <option value="male">男性</option>
            <option value="female">女性</option>
            <option value="other">その他</option>
          </select>
          <select class="search-box" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->content }}
            </option>
            @endforeach
          </select>
          <input type="date" name="date" class="search-box" />
          <button class="search-box search-button" type="submit">検索</button>
          <button type="reset" class="search-box reset-button">リセット</button>
        </div>
      </form>

      <div class="export-pagination">
        <button class="export-button">エクスポート</button>
        <div class="pagination">
          {{ $contacts->links(('pagination::default')) }}
        </div>
      </div>

      <div class="contact-table">
        <table class="contact-table__inner">
          <tr class="contact-table__row">
            <th class="contact-table__header">
              <span class="contact-table__header-span">お名前</span>
            </th>
            <th class="contact-table__header">
              <span class="contact-table__header-span">性別</span>
            </th>
            <th class="contact-table__header">
              <span class="contact-table__header-span">メールアドレス</span>
            </th>
            <th class="contact-table__header">
              <span class="contact-table__header-span">お問い合わせの種類</span>
            </th>
            <th class="contact-table__header">
              <span class="contact-table__header-span"></span>
            </th>
          </tr>
          @isset($contacts)
          @foreach ($contacts as $contact)
          <tr class="contact-table__row">
            <td class="contact-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td class="contact-table__item">
              @if ($contact->gender == 'male')
              男性
              @elseif ($contact->gender == 'female')
              女性
              @else
              その他
              @endif
            </td>
            <td class="contact-table__item">{{ $contact->email }}</td>
            <td class="contact-table__item">{{ $contact->category->content }}</td>
            <td class="contact-table__item">
              <label for="modal-{{ $contact->id }}" class="detail-button">詳細</label>
              <input type="checkbox" id="modal-{{ $contact->id }}" class="modal-toggle">
              <div class="modal">
                <div class="modal-content">
                  <label for="modal-{{ $contact->id }}" class="close">&times;</label>
                  <div class="modal-body">
                    <table class="detail-table">
                      <tr>
                        <td class="label-cell">お名前</td>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">性別</td>
                        <td>{{ $contact->gender == 'male' ? '男性' : ($contact->gender == 'female' ? '女性' : 'その他') }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">メールアドレス</td>
                        <td>{{ $contact->email }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">電話番号</td>
                        <td>{{ $contact->tell }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">住所</td>
                        <td>{{ $contact->address }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">建物名</td>
                        <td>{{ $contact->building }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">お問い合わせの種類</td>
                        <td>{{ $contact->category->content }}</td>
                      </tr>
                      <tr>
                        <td class="label-cell">詳細</td>
                        <td>{{ $contact->detail }}</td>
                      </tr>
                    </table>
                  </div>
                <form class="modal-form" action="/admin/{{ $contact->id }}" method="post">
                @method('DELETE')
                @csrf
                  <div class="modal-footer">
                    <button class="delete-button">削除</button>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
          @endisset
        </table>
      </div>
    </div>
  </main>
</body>

</html>
