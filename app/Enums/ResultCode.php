<?php
/*
* 処理結果の定数
* 2024/03/10 後藤卓也
*/
namespace App\Enums;

enum ResultCode: int
{
    case Success = 0;            // 成功
    case NotFoundUser = 1;       // ユーザが見つからない
    case NotFoundInstance = 2;   // インスタンスが見つからない
    case AlreadyStarted = 3;     // 既に起動している
}
