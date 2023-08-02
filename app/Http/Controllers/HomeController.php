<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
use Hash;
class HomeController extends Controller
{
    public function logingoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function login_with_google( Request $request){
        try {
            $user = Socialite::driver('google')->user();
            $is_user = User::where('email',$user->getEmail())->first();
            if(!$is_user){
                $save_user = User::updateOrCreate([
                    'google_id' => $user->getID(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password'=> Hash::make($user->getName().'@'.$user->getID()),
                ]);
            }else{
                 $save_user = User::where('email', $user->getEmail())->update([
                    'google_id'=>$user->getId()
                 ]);
                 $save_user = User::where('email', $user->getEmail())->first();
            }
            Auth::login($save_user);
            $request->session()->regenerate();
            return redirect('/home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
