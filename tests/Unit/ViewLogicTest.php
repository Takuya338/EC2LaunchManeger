<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Logic\ViewLogic;
use App\AWS\Logic;
use App\Enums\ResultCode;

class ViewLogicTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    // ログイン処理
    public function testLoginSuccess(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        $logicStub->method('login')->willReturn(['pc_name' => 'MyPC', 'dns_name' => 'mydns.example.com', 'ip_address' => '192.168.1.1']);

        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);

        // ログイン処理を実行
        $result = $viewLogic->login(['email' => 'test@ec2.com', 'password' => 'password']);
        $this->assertEquals([
            'PC名:MyPC',
            '接続用DNS名:mydns.example.com',
            '接続用IPアドレス:192.168.1.1',
        ], $result);

    }

    // ログイン処理
    public function testLoginNotFoundUser(): void
    {        
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        $logicStub->method('login')->willReturn(['error' => ResultCode::NotFoundUser]);

        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);

        // ログイン処理を実行
        $result = $viewLogic->login(['email' => 'test@ec2.com', 'password' => 'password']);
        $this->assertEquals(['message' => 'メールアドレスまたはパスワードが間違っています。'], $result);
    }

    // ログイン処理
    public function testLoginNotFoundInstance(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        $logicStub->method('login')->willReturn(['error' => ResultCode::NotFoundInstance]);

        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);
    
        // ログイン処理を実行
        $result = $viewLogic->login(['email' => 'test@ec2.com', 'password' => 'password']);
        $this->assertEquals(['message' => '利用するインスタンスが登録されていません。'], $result);
    }

    // ログイン処理
    public function testLoginAlreadyStarted(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        $logicStub->method('login')->willReturn(['error' => ResultCode::AlreadyStarted]);

        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);
    
        // ログイン処理を実行
        $result = $viewLogic->login(['email' => 'test@ec2.com', 'password' => 'password']);
        $this->assertEquals(['message' => '利用するインスタンスは既に起動しています。'], $result);
    }

    // ログイン失敗時のメッセージ取得
    public function testGetLoginFailMessage(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        
        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);
        
        // 成功
        $result = $viewLogic->getLoginFailMessage(ResultCode::Success);
        $this->assertEquals(null, $result);

        // ユーザが見つからない
        $result = $viewLogic->getLoginFailMessage(ResultCode::NotFoundUser);
        $this->assertEquals('メールアドレスまたはパスワードが間違っています。', $result);

        // インスタンスが見つからない
        $result = $viewLogic->getLoginFailMessage(ResultCode::NotFoundInstance);
        $this->assertEquals('利用するインスタンスが登録されていません。', $result);

        // 既に起動している
        $result = $viewLogic->getLoginFailMessage(ResultCode::AlreadyStarted);
        $this->assertEquals('利用するインスタンスは既に起動しています。', $result);

        // その他
        $result = $viewLogic->getLoginFailMessage(100);
        $this->assertEquals(null, $result);
    }

    // ログイン成功時の配列作成
    public function testGetLoginSuccessMessage(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        
        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);

        // データが全て揃っている場合
        $result = $viewLogic->getLoginSuccessMessage(['pc_name' => 'MyPC', 'dns_name' => 'mydns.example.com', 'ip_address' => '192.168.1.1']);
        $this->assertEquals([
            'PC名:MyPC',
            '接続用DNS名:mydns.example.com',
            '接続用IPアドレス:192.168.1.1',
        ], $result);

        // DNS名とIPアドレスのみが提供される場合
        $result = $viewLogic->getLoginSuccessMessage(['dns_name' => 'mydns.example.com', 'ip_address' => '192.168.1.1']);
        $this->assertEquals([
            '接続用DNS名:mydns.example.com',
            '接続用IPアドレス:192.168.1.1',
        ], $result);  

        // いずれのキーも提供されない場合（空の結果が期待される）
        $result = $viewLogic->getLoginSuccessMessage([]);
        $this->assertEquals([], $result);

        // 一部のデータのみが提供される場合
        $result = $viewLogic->getLoginSuccessMessage(['pc_name' => 'MyPC']);
        $this->assertEquals([
            'PC名:MyPC'
        ], $result);

        // 存在しないキーが含まれている場合（関連するキーのみが処理される）
        $result = $viewLogic->getLoginSuccessMessage(['pc_name' => 'MyPC', 'unknown_key' => 'value']);
        $this->assertEquals([
            'PC名:MyPC'
        ], $result);
    }

    // ログアウト処理
    public function testLogout(): void
    {
        // Logicクラスのスタブを作成
        $logicStub = $this->createMock(Logic::class);
        $logicStub->method('logout')->willReturn(true);
        
        // ViewLogicのインスタンスを作成し、スタブを注入
        $viewLogic = new ViewLogic($logicStub);
        
        $result = $viewLogic->logout();
        $this->assertEquals(true, $result);
    }
}


