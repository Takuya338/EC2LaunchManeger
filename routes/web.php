<?php
/*
 *
 * web.php
 * 2024/03/10 後藤卓也
 * ルーティング一覧  
 *
 */
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', 'App\Http\Controllers\LoginController@index')->name('index');          // ログイン画面
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');    // ログイン処理(EC2設定表示画面)
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');  // ログアウト処理