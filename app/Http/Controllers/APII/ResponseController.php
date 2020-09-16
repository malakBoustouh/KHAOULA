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
class ResponseController extends Controller
{
    public function sendResponse($response)
    {

        return response()->json($response, 200,[
            'success' =>true,
            'user' => Auth::user()
        ]);
    }


    public function sendError($error, $code = 404)
    {
        $response = [
            'success' =>false,
            'error' => $error,
        ];
        return response()->json($response, $code);
    }
}
