<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use App\Models\Member;
use App\Models\transactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use DB;
Use Alert;
use Storage;

class StaffController extends Controller
{
    public function add_tools(Request $request){
       
        $image = $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $imageName = time(). '.'.$extension;
            $image->move(public_path('/images/equipments'), $imageName);
        }
        $tool = Equipment::create([
            'image'=>$request->image ? $imageName:'0.png',
            'name'=>$request->name,
            'weight'=>$request->weight,
            'quantity'=>$request->quantity,
            'activity'=>$request->activity,
            'condition'=>$request->condition,
        ]);
        $tool->save();

            Alert::success('Success!','New equipment has been added');
            return back();
    }

    public function profile(Request $request){
       if (Auth::user()->hasRole('user') && $request->user()->approved = 1){
            $equipment = DB::select('select * from equipment');
            $memberapprove = Member::where('approved', '=', '1')->get();
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

    public function add_transactions(Request $request){
        $transactions = transactions::create([
            'tran_fname'=>$request->tran_fname,
            'tran_lname'=>$request->tran_lname,
            'tran_plan'=>$request->tran_plan,
            'tran_type'=>$request->tran_type,
            'tran_amount'=>$request->tran_amount,
        ]);

        $transactions->save();
        Alert::success('Success!','Transaction has been added');
            return back();
    }

    public function staff_equipment_Panel(){
        $equipment = Equipment::all();
        return view('staff/staff_equipment_panel', ['equipment' =>$equipment]);
    }
    
    public function staff_transaction_Panel(){
        $transactions = transactions::all();
        return view('staff/staff_transaction_panel', ['transactions' =>$transactions]);
    }
    public function member(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'address'=>'required',
            'sex'=>'required',
            'DOB'=>'required',
            'plan'=>'required',
            'type'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'age'=>'required|integer',
            'mobilenum'=>'required|max:11',
            'email'=>'required',
            'password'=>'required',


        ]);
        $image = $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $imageName = time(). '.'.$extension;
            $image->move(public_path('/images/members'), $imageName);
        }
        $members = Member::create([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'address'=>$request->address,
            'sex'=>$request->sex,
            'DOB'=>$request->DOB,
            'plan'=>$request->plan,
            'type'=>$request->type,
            'image'=>$request->image ? $imageName:'0.png',
            'age'=>$request->age,
            'mobilenum'=>$request->mobilenum,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'approved' => false,


        ]);
        $save = $members -> save();
        if($save){
            Alert::success('Success!','New member has been added successfully');
            return back();
        }else{
            Alert::error('Oops...', 'Something went wrong!');
            return back();
        }

    }

    public function delete_tools($id){
        DB::delete('delete from equipment where id = ?', [$id]);
        Alert::success('Success!','Equipment has been deleted successfully');
        return back();
    }

    public function return(){
        $equipment = DB::select('select * from equipments');
        $memberapprove = Member::where('approved', '=', '1')->get();
        return view('userdash', ['equipment' =>$equipment, 'memberapprove'=>$memberapprove]);
    }


    public function update_tool(Request $request){
        // $filename='';
            // if($request->hasFile('image')){
            //     $image = $request->file('image');
            //     $extension = $image->getClientOriginalExtension();
            //         $filename = time(). '.'. $extension;
            //         $image->move('/images/equipments', $filename);
            //     if($data->image){
            //         Storage::delete('/images/equipments' .$data->image);
            //     }else{
            //         $filename = $request->image;
            //     }
            // }

        $data = Equipment:: where('id', $request->id)->update([
            // 'image'=>$filename,
        'name' => $request->name,
        'weight' => $request->weight,
        'quantity' => $request->quantity,
        'activity' => $request->activity,
        'condition' => $request->condition,
       ]);     

        if($data){
            return response()->json([
                'status' =>200,
                ]);
            }else{
                return response()->json([
                    'status' =>200,
                    ]);
            }   
    }

    public function avail_extend(Request $request){
        $updateStatus = Member:: where('id', $request->id)->update([
            'plan'=>$request->plan,
            'type'=>$request->type,
        ]);

        if ($updateStatus){
            return response()->json([
                'status' =>200,
                ]);
        }else{
            return response()->json([
                'status' =>200,
                ]);
        }   
    }
}
