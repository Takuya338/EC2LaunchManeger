@extends('base')
@section('content')
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
                    <p class="text-danger">{{ session('message') }}</p>
                    @endif
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </form>
@endsection
