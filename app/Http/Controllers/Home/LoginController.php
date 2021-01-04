<?php
/**
 * User: ouhao
 * Date: 2019/03/09
 * Time: 3:17
 */

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function github($login_before)
    {
        $OAuth = new \Yurun\OAuthLogin\Github\OAuth2(env('GITHUB_KEY'), env('GITHUB_SECRET'), env('GITHUB_CALLBACK'));
        $url = $OAuth->getAuthUrl();
        Session::put('GITHUB_STATE',$OAuth->state);
        Session::put('LOGIN_BEFORE',$login_before);
        Log::info('home-login-github:',[Session::get('GITHUB_STATE')]);
        header('location:' . $url);
    }

    public function github_callback()
    {
        try {
            $OAuth = new \Yurun\OAuthLogin\Github\OAuth2(env('GITHUB_KEY'), env('GITHUB_SECRET'), env('GITHUB_CALLBACK'));
            Log::info('home-login-github_callback:',[Session::get('GITHUB_STATE')]);
            $accessToken = $OAuth->getAccessToken(Session::get('GITHUB_STATE'));
            $userInfo = $OAuth->getUserInfo();
            if (empty($userInfo)) {
                return back();
            }
            $user = User::where([['openid',$userInfo['id']]])->first();
            if (empty($user)) {
                $user = new User;
                $user->created_at = time();
            }
            $user->username = $userInfo['name'] ?? $userInfo['login'];
            $user->login_name = $userInfo['login'];
            $user->avatar = $userInfo['avatar_url'];
            $user->openid = $userInfo['id'];
            $user->updated_at = time();
            $user->save();
    //        登录成功
            $user_info = $user->toArray();
            $user_info['uid'] = $user_info['id'];
            Session::put('user_info',$user_info);

    //        跳转登录前页面
            $url = 'http://'. $_SERVER['HTTP_HOST'] .str_replace('_','/',Session::get('LOGIN_BEFORE'));
            header('location:' . $url);
        } catch (\Exception $e) {
            Session::flush();
            Redirect::to('/');
        }
    }

    public function out_login(Request $request)
    {
        $request->session()->flush();

        return back();
    }






}