<?php

use PHPUnit\Framework\TestCase;
use App\AWS\LogicStub;
use App\Enums\ResultCode;

class LogicStubTest extends TestCase
{
    private $loginClass;

    protected function setUp(): void
    {
        $this->loginClass = new LogicStub(); // LoginClassはこのloginメソッドを含むクラスの名前に置き換えてください
    }

    public function testLoginSuccess()
    {
        $result = $this->loginClass->login("test1@ec2.com", "test1");
        $expected = ['pc_name' => 'テスト1', 'dns_name' => 'abcdefghijklm', 'ip_address' => '127.0.0.0'];
        $this->assertEquals($expected, $result);
    }

    public function testLoginNotFoundUser()
    {
        $result = $this->loginClass->login("test2@ec2.com", "test2");
        $expected = ['error' => ResultCode::NotFoundUser];
        $this->assertEquals($expected, $result);
    }

    public function testLoginNotFoundInstance()
    {
        $result = $this->loginClass->login("test3@ec2.com", "test3");
        $expected = ['error' => ResultCode::NotFoundInstance];
        $this->assertEquals($expected, $result);
    }

    public function testLoginAlreadyStarted()
    {
        $result = $this->loginClass->login("test4@ec2.com", "test4");
        $expected = ['error' => ResultCode::AlreadyStarted];
        $this->assertEquals($expected, $result);
    }

    public function testLoginFailure()
    {
        $result = $this->loginClass->login("unknown@ec2.com", "unknown");
        $expected = ['error' => ResultCode::NotFoundUser];
        $this->assertEquals($expected, $result);
    }

    public function testLogout()
    {
        $result = $this->loginClass->logout();
        $this->assertTrue($result);
    }
}

