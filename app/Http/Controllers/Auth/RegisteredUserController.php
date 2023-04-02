<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Notifications\ApprovedUserNotification;
use Illuminate\Support\Facades\Notification;
Use Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'number' =>['required', 'numeric', 'digits:11'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $image = $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $imageName = time(). '.'.$extension;
            $image->move(public_path('/images/users'), $imageName);
        }
        $user = User::create([
            'image'=>$request->image ? $imageName:'0.png',
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
            'approved' => false,
        ]);

        Alert::success('Registered Succesfully!','Please wait for your account to be approve');
        $user->attachRole('user');


        event(new Registered($user));
        return redirect()->back();

        
    }
}
