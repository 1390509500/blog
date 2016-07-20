<?php
namespace App\Modules\Admin\Http\Controllers;

use App\Model\Admin\AdminModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function login(){
        //post验证
        $post = Input::all();
        if($post){
            $user = AdminModel::where('name',$post['name'])->first();
            $rules = ['captcha'=>'required|captcha'];
            $validator = Validator::make(Input::all(),$rules);
            if($validator->fails()){
                return back()->with('msg','验证码错误');
            }else{
                if(!empty($user) && $post['pwd']==Crypt::decrypt($user->pwd)) {
                    //session(["user"=>$user]);
                    $token = JWTAuth::fromUser($user);
                    return redirect("home/index?token=".$token);
                } else {
                    //session(["user"=>null]);
                    return back()->with('msg', '用户名或密码错误');
                }
            }
        }
        return view('admin.login');
    }

    public function logout(){
        try{
            $old_token = JWTAuth::getToken();
            $token = JWTAuth::refresh($old_token);
            JWTAuth::invalidate($token);
            if(!empty($token)){
                return redirect("admin/login");
            }
        }catch (JWTException $e){
            return redirect("admin/login");
        }
    }

    public function editPwd(){
        $user = JWTAuth::parseToken()->authenticate();
        if($_POST){
            $input = Input::all();
            $rules = ["password"=>"required|between:6,20|confirmed"];
            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                //查询当前登陆用户
                $pwd = AdminModel::where("name",$user->name)->first();
                if(!empty($user) && $input['password_o']!=Crypt::decrypt($pwd->pwd)){
                    return response()->json(['msg'=>'原密码错误','status'=>0]);
                }else{
                    $pwd->pwd = Crypt::encrypt($input['password']);
                    $pwd->update();
                    return response()->json(['msg'=>'修改成功','status'=>1]);
                }
            }else{
                return response()->json(['msg'=>$validator->errors()->all(),'status'=>0]);
            }
        }else{
            $data = [
                'token'=>$_GET['token'],
                'user'=>$user
            ];
            return view("admin.editPwd",$data);
        }
    }
}