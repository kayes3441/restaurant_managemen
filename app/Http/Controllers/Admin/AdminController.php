<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPasswordMail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;

class AdminController extends Controller
{
    public function loginForm(){
        return view('admin.auth.login_form');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
           'email'      => 'required',
           'password'   => 'required'
        ]);
        //return response()->json(request()->all());
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return response()->json(['success'=>true]);
        }
        else
            return response()->json(['success'=>false]);
    }

    public function logout(){
        Auth::guard('admins')->logout();
        return redirect('/admin/login-form');
    }

    public function resetPasswordForm(){
        return view('admin.auth.reset_password_form');
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:admins'
        ]);
        if ($validator->fails()){
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }

        $check_email = DB::table('password_reset_tokens')->where('email',$request->email)->first();
        if (!empty($check_email)){
            DB::table('password_reset_tokens')->where('email',$request->email)->delete();
         //   return 'deleted';
        }
//        return $check_email;

        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::to($request->email)->send(new AdminResetPasswordMail($request->email,$token));

        return response()->json(['success'=>true]);

    }

    public function updateResetPasswordForm($token){

         $email = DB::table('password_reset_tokens')->select('email')->where('token',$token)->first();

        if($email == null ){
            return 'Linked Expired !!'. url('/admin/login-form');
        }
//         return $email;
//         $admin = Admin::find($email);
         return view('admin.auth.update_reset_password_form',compact('email','token'));
    }

    public function updateResetPassword(Request $request ){

        //return $request->all();
        $validator = Validator::make($request->all(),[
           'password' =>'required|min:8',
        ]);
        if ($validator->fails()){
            return response()->json(['success'=>false,'message'=>$validator->errors()]);
        }
        $update_password = Admin::where('email',$request->email)->first();
        $update_password->password = bcrypt($request->password);
        $update_password->save();

        DB::table('password_reset_tokens')->where('token',$request->token)->delete();

        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password,]))
        {
            return response()->json(['success'=>true ,'message'=>'Password Reset Successfully']);
        }
     //   return response()->json(['success'=>true ,'message'=>'Password Reset Successfully']);

    }
}
