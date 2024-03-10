<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Login Form</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">EC2起動管理システム</h2>
                <form method="POST" action="{{ route('login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="emailInput">メールアドレス</label>
                        <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="メールアドレスを入力">
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">パスワード</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="パスワードを入力">
                    </div>
                    @if (session('message'))
                    <p class="text-danger">※モック用のログインボタンです</p>
                    @endif
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

