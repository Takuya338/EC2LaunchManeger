<?php
/*
 *
 * ViewLogic.php
 * 2024/03/10 後藤卓也
 * ログイン・ログアウトの処理 
 *
 */

namespace App\Logic;

use App\AWS\Logic;         // ロジッククラスをインポート
use App\Enums\ResultCode;  // 処理結果の定数をインポート

class ViewLogic
{
    private $logic;   // ロジッククラス
    
    /*
     * コンストラクタは Logic インスタンスを受け取るように変更します。
     * これにより、テスト時にスタブを注入することができます。
     */
    public function __construct(Logic $logic)
    {
        $this->logic = $logic;
    }

    /*
    * ログイン処理
    * @param ログイン情報 $data
    * @return array
    */
    public function login($data)
    {
        // メールアドレスとパスワードをがない場合はエラーメッセージを返す
        if (!isset($data['email']) || !isset($data['password'])) {
            $message = $this->getLoginFailMessage(ResultCode::NotFoundUser);
            return ['message' => $message];
        }

        // ログイン処理
        $result = $this->logic->login($data['email'], $data['password']);
        if (isset($result['error'])) {
            // エラー時はエラーメッセージを返す
            $message = $this->getLoginFailMessage($result['error']);
            return ['message' => $message];
        } else {
            // 成功時は出力内容を返す
            return $this->getLoginSuccessMessage($result);
        }
    }

    /*
    * ログイン処理失敗時の配列を作成
    * @param 処理結果 $resultCode
    * @return string
    */
    public function getLoginFailMessage($resultCode)
    {
        $messageArray = [
            ResultCode::Success->value => null,
            ResultCode::NotFoundUser->value => 'メールアドレスまたはパスワードが間違っています。',
            ResultCode::NotFoundInstance->value => '利用するインスタンスが登録されていません。',
            ResultCode::AlreadyStarted->value => '利用するインスタンスは既に起動しています。'
        ];
    
        // $resultCode が ResultCode Enum の有効な値かチェックする
        if (!in_array($resultCode, ResultCode::cases())) {
            return null;
        }
    
        // Enumの値を使って適切なメッセージを返す
        return $messageArray[$resultCode->value];
    }
    
    /*
    * ログイン成功時の配列を作成
    * @param 処理結果 $data
    * @return array
    */
    public function getLoginSuccessMessage($data)
    {
        $result = array();
        if (isset($data['pc_name'])) {
            $result[] = 'PC名:' . $data['pc_name'];
        }
        if (isset($data['dns_name'])) {
            $result[] = '接続用DNS名:' . $data['dns_name'];
        }
        if (isset($data['ip_address'])) {
            $result[] = '接続用IPアドレス:' . $data['ip_address'];
        }
        return $result;
    }

    /*
    * ログアウト処理
    * @return true
    */
    public function logout()
    {
        // ログアウト処理をここに書きます
        $this->logic->logout();
        return true;
    }
}