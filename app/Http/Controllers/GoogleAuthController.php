<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id',$google_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' =>$google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                ]);

                Auth::login($new_user);

                $notification = array(
                    'message' =>'User Login Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->intended('/')->with($notification);
            }
            else{
                Auth::login($user);
                $notification = array(
                    'message' =>'User Login Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->intended('/')->with($notification);
            }
        } catch (\Throwable $th) {
            dd('Something went wrong'.$th->getMessage());
        }
    }
}
