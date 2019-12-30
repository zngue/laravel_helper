<?php


namespace Zngue\Helper;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Zngue\User\Models\User;

trait Helpers
{

    public function returnArray($result = [], $message = 'success', $code = 200)
    {
        $res = [
            'statusCode' => $code,
            'message' => $message,
            'data' =>$result
        ];
        return response()->json($res);
    }
    public function returnJson($data=[],$message = 'success', $code = 200 )
    {
        $res = [
            'statusCode' => $code,
            'message' => $message,
            'data'=>$data
        ];
        header('Content-type: text/json');
        echo json_encode($res);
    }
    /**
     * @param $user
     * @return mixed
     * @author zngue
     * @time  2019-12-25
     * @desc 创建token...
     */
    public function token($user){
        return JWTAuth::fromUser($user);
    }
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     * @author zngue
     * @time  2019-12-25
     * @desc 解析token...
     */
    public function user(){
        return auth('api')->user();
    }

    /**
     * @param $data
     * @return bool
     * @author zngue
     * @time  2019-12-30
     * @desc 用户登录处理...
     */
    public function userLogin($data){
        if (Auth::attempt($data) ){
            $userinfo =User::where('username',$data['username'])->first();
            if ($userinfo){
                return  JWTAuth::fromUser($userinfo);
            }else{
                return false;
            }
        }else{
            return  false;
        }
    }

    /**
     * @return mixed
     * @author zngue
     * @time  2019-12-30
     * @desc  刷新token...
     */
    public function refreshToken(){
       return  auth('api')->refresh();
    }
}
