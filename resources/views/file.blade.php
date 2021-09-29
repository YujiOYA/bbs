<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ファイルアップロード</title>
</head>
<body>
  <h1>ファイルアップロード</h1>
  @if (session('success'))
      <p>{{ session('success') }}</p>
  @endif

  <form action="/file" method="post" enctype="multipart/form-data">
  @csrf
  <label>画像選択<input type="file" name="img" accept=".png,.jpg,.jpeg,image/png,image/jpg"></label>
  <br>
  <input type="submit" value="送信">
  </form>

@foreach ($data as $item)
  <img src="{{ asset('storage/images/' . $item->file_name) }}">
@endforeach

</body>
</html>