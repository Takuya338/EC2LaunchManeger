<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    // ログイン画面の表示テスト
    public function testIndex(): void
    {
        $response = $this->get('/');

        $response->assertOK();

        // ビューのアサート
        $response->assertViewIs('index');
        $response->assertSessionMissing('message');
    }

    // ログイン処理のテスト(成功)
    public function testLoginSuccessAndReturnsView()
    {
        // ログインルートに対してリクエストを送信
        $response = $this->post(route('login'), [
            'email' => 'user@example.com',
            'password' => 'valid-password'
        ]);

        // ビューのアサート
        $response->assertViewIs('ec2set');
        $response->assertViewHas('datas', ['id' => 'taro', 'name' => '太郎']);
    }

    // ログイン処理のテスト(失敗)
    public function testLoginFailsAndRedirects()
    {
        // ログインルートに対してリクエストを送信
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => 'invalid-password'
        ]);

        // リダイレクトとフラッシュメッセージを確認
        $response->assertRedirect(route('index'));
        $response->assertSessionHas('message', 'ログイン失敗');
    }

    // ログアウト処理のテスト
    public function testLogout(): void
    {
        $response = $this->get('/logout');

        // リダイレクトが'index'ルート（ログインページ）に行われたか確認する
        $response->assertRedirect(route('index'));
        $response->assertSessionMissing('message');
    }


}
