<?php
/*
 *
 * LoginController.php
 * 2024/03/10 後藤卓也
 * ログイン・ログアウトの表示  
 *
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\ViewLogic;  // ロジッククラスをインポート

class LoginController extends Controller
{
    private $logic;   // ロジッククラス
    
    /*
    * コンストラクタ(起動時に最初に実行される)
    */
    public function __construct()
    {
        // ここに初期化のコードを書く
        $this->logic = new ViewLogic();  // ロジッククラスのインスタンスを生成
    }

    /*
    * ログイン画面を表示
    * @param Request $request
    * @return view
    */
    public function index(Request $request)
    {
        // ログイン画面を表示
        return view('index');
    }

    /*
    * ログイン処理
    * @param Request $request
    * @return view
    */
    public function login(Request $request)
    {
        // ログイン処理
        $result = $this->logic->login($request->all());
        if (isset($result['message'])) {
            // ログイン失敗
            return redirect()->route('index')->with('message', $result['message']);
        } else {
            // ログイン成功
            return view('ec2set', ['datas' => $result]);
        }
    }

    /*
    * ログアウト処理
    * @param Request $request
    * @return view
    */
    public function logout(Request $request)
    {
        // ログアウト処理
        $this->logic->logout();

        // ログインページに遷移
        return redirect()->route('index');
    }

}
