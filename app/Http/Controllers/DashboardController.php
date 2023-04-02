<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Member;
use App\Models\Equipment;
use DB;
Use Alert;
use Storage;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApprovedUserNotification;
class DashboardController extends Controller
{
    public function index( Request $request){
        if(Auth::user()->hasRole('user') && $request->user()->approved = 1 ){
            $equipment = DB::select('select * from equipment');
            $memberapprove = DB::select('select * from members');
            return view('userdash', ['equipment' =>$equipment, 'memberapprove'=>$memberapprove]);
        }elseif(Auth::user()->hasRole('administrator')){
            $userapprove = User::where('approved', '=', '1')->get();
            $members = Member::where('approved', '=', '0')->get();
            $equipment = DB::select('select * from equipment');
            $countMember = DB::table('members')->count();
            $countEquipment = DB::table('equipment')->sum('quantity');
            return view('dashboard',compact('countEquipment', 'countMember'), ['userapprove' => $userapprove, 'equipment' =>$equipment, 'members' => $members]);
        }elseif(Auth::user()->hasRole('owner')){
            $users = User::where('approved', '=', '0')->get();
            $userapprove = User::where('approved', '=', '1')->get();
            $memberapprove = Member::where('approved', '=', '0')->get();
            $members = Member::where('approved', '=', '0')->get();
            $countMember = DB::table('members')->count();
            $countEquipment = DB::table('equipment')->sum('quantity');
            return view('ownerdash',compact('countEquipment', 'countMember'), ['users' => $users, 'userapprove' => $userapprove, 'memberapprove'=>$memberapprove, 'members' => $members]);
        }
    }

    public function staff(){
        return view('staff');
    }

    public function status(Request $request, $id){
        $data = User::find($id);

        if($data->approved == 0){
            $data->approved = 1;
        }else{
            $data->approved=0;
        }
        $data->save();
        Alert::success('Approved!','Request has been approved');
        return back();
    }

    public function deny($id){
        DB::delete('delete from users where id = ?', [$id]);
        Alert::success('Denied!','Request has been denied');
        return back();
    }

    public function memberstatus(Request $request, $id){
        $data = Member::find($id);

        if($data->approved == 0){
            $data->approved = 1;
        }else{
            $data->approved=0;
        }
        $data->save();
        Alert::success('Approved!','Request has been approved');
        return back();
    }

    public function memberdeny($id){
        DB::delete('delete from members where id = ?', [$id]);
        Alert::success('Denied!','Request has been denied');
        return back();
    }

    public function newstaff(Request $request){
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
        $user->attachRole('user');
        Alert::success('Registered Succesfully!','Please wait for your account to be approve');
        event(new Registered($user));
        return redirect()->back();


    }
    public function delete_member($id){
        DB::delete('delete from members where id = ?', [$id]);
        Alert::success('Deleted!','An account of a member has been deleted');
        return back();
    }

    public function delete_user($id){
        DB::delete('delete from users where id = ?', [$id]);
        Alert::success('Deleted!','An account of a staff has been deleted');
        return back();
    }
    

    public function staffview(){
        $userapprove = User::where('approved', '=', '1')->get();
        return view('staff_update', ['userapprove' => $userapprove]);
    }

    public function customer_Panel(){
        $members = Member::where('approved', '=', '1')->get();
        return view('customer_panel', ['members' => $members]);
    }
    public function equipment_Panel(){
        $equipment = DB::select('select * from equipment');
        return view('equipment_panel', ['equipment' =>$equipment]);
    }

    public function transaction_Panel(){
        return view('transaction_panel');
    }

    public function registration_Panel(){
        $users = User::where('approved', '=', '0')->get();
        $userapprove = User::where('approved', '=', '1')->get();
        $memberapprove = Member::where('approved', '=', '0')->get();
        $members = Member::where('approved', '=', '1')->get();
        return view('owner/registration_approval', ['users' => $users, 'userapprove' => $userapprove, 'memberapprove'=>$memberapprove, 'members' => $members]);
    }

    public function owner_customer_Panel(){
        $members = Member::where('approved', '=', '1')->get();
        return view('owner/owner_customer_panel', ['members' => $members]);
    }

    public function owner_staff_Panel(){
        $userapprove = User::where('approved', '=', '1')->get();
        return view('owner/owner_staff_panel', ['userapprove' => $userapprove]);
    }

    public function edit_staff($id){
        $user = User::find($id);
        $userapprove = User::where('approved', '=', '1')->get();

        return view('staff_update', compact('user'), ['userapprove' => $userapprove]);
    }

    public function update_staff(Request $request, $id){
        
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->number = $request->input('number');
        if($request->hasfile('image')){
            Storage::delete('$user->image');
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/images/users'), $filename);
            $user['image'] = $filename;
        }
        $user->save();
        
            Alert::success('Success!','The staff has been updated');
            return back();
        

    }

    public function update_customer(Request $request, $id){
        $member = Member::find($id);
        $member->fname=$request->input('fname');
        $member->lname=$request->input('lname');
        $member->address=$request->input('address');
        $member->sex=$request->input('sex');
        $member->DOB=$request->input('DOB');
        $member->plan=$request->input('plan');
        $member->type=$request->input('type');
        $member->age=$request->input('age');
        $member->mobilenum=$request->input('mobilenum');
        $member->email=$request->input('email');
        if($request->hasfile('image')){
            Storage::delete('$member->image');
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/images/members'), $filename);
            $member['image'] = $filename;
        }
        $member->save();
        
            Alert::success('Success!','Information has been updated');
            return back();
        
    }
}
