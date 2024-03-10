@extends('base')
@section('content')
                <h2 class="text-center mt-5">インスタンス情報</h2>
                @foreach ($datas as $data)
                <p>{{ $data }}</p>
                @endforeach
                <a href="{{ route('logout') }}"><button type="button" class="btn btn-primary">ログアウト</button></a>
@endsection