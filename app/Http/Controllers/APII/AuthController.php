<?php
namespace App\Http\Controllers\APII;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\User;
    use Exception;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Symfony\Component\HttpKernel\Exception\HttpException;
//zitha
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
class AuthController extends ResponseController
{
    //create user


    //login
    public function login(Request $request)
    {



        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            $error = "Unauthorized";
            return $this->sendError($error, 401);
        }
        $user = $request->user();
        return response()->json([
            'success' =>true,
            'token' => $success['token'] =  $user->createToken('token')->accessToken,
            'user' => Auth::user()
        ]);

       // $success['token'] =  $user->createToken('token')->accessToken;
        return $this->sendResponse($response);
    }

    //logout
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }


    }

    //getuser
    public function getUser(Request $request)
    {
        //$id = $request->user()->id;
        $user = $request->user();
        if($user){
            return $this->sendResponse($user);
        }
        else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }
}
