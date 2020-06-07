<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        $statuses=$user->statuses()
                        ->orderBy('created_at','desc')
                        ->paginate(10);

        return view('users.show',compact('user','statuses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        
        //發出確認email
        $this->sendEmailConfirmationTo($user);

        session()->flash('success','註冊成功！請您完成email認證(點選確認信中的網址)，才能登入Weibo網站。');

        return redirect()->route('users.show',[$user]);
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view='emails.confirm';
        $data=compact('user');
        $to=$user->email;
        $subject="感謝註冊Weibo網站，請確認您的email。";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user=User::where('activation_token', $token)->firstOrFail();

        $user->email_verified_at=date('Y-m-d H:i:s');
        $user->activated=true;
        $user->activation_token=null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜您，email確認成功！');

        return redirect()->route('users.show', [$user]);
    }

    public function followings(User $user)
    {
        $users=$user->followings()->paginate(30);
        $title=$user->name.'關注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users=$user->followers()->paginate(30);
        $title=$user->name.'的粉絲';
        return view('users.show_follow', compact('users', 'title'));
    }

}
