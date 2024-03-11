<?php
/*
 *
 * LogicStub.php
 * 2024/03/11 後藤卓也
 * AWSのロジッククラスのスタブ  
 *
 */

namespace App\AWS;

use App\Enums\ResultCode;  // 処理結果の定数をインポート

class LogicStub
{
    // プロパティ、メソッドをここに追加します
    public function __construct()
    {
        // コンストラクタの内容をここに書きます
    }

    public function login($email, $password)
    {
        // 処理成功時
        if ($email == "test1@ec2.com" && $password == "test1") {
            // 成功
            return ['pc_name' => 'テスト1', 'dns_name' => 'abcdefghijklm' , 'ip_address' => '127.0.0.0'];
        } else if ($email == "test2@ec2.com" && $password == "test2") {
            // 該当ユーザーなし
            return ['error' => ResultCode::NotFoundUser];
        } else if ($email == "test3@ec2.com" && $password == "test3") {
            // 該当インスタンスなし
            return ['error' => ResultCode::NotFoundInstance];
        } else if ($email == "test4@ec2.com" && $password == "test4") {
            // インスタンスは既に起動済み
            return ['error' => ResultCode::AlreadyStarted];
        } else {
            // いづれにも該当しない
            return ['error' => ResultCode::NotFoundUser];
        }

    }

    public function logout()
    {
        // ログアウト処理をここに書きます
        return true;
    }
}