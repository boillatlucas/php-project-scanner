<?php

namespace App\Http\Controllers\API;

use Illuminate\Console\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            $success['url_projets_user'] = route('user_get_projects');
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ],
        [
            'same' => 'The confirm password and password must match.',
            'c_password.required' => 'The confirm password is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user_exist = User::where('email', $input['email'])->first();
        if($user_exist){
            return response()->json(['error' => ["An user already exist with this email."]], 401);
        }
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutApi(Request $request)
    {
        if (\auth('api')->user() === null) {
            $json = [
                ['error' => "You are not logged in."],
                Response::HTTP_UNAUTHORIZED,
            ];

            $request->user()->token()->revoke();
        }

        list($content, $code) = $json ?? [
            ['success' => "You are logout"],
            Response::HTTP_OK,
        ];

        return response()->json($content, $code);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

}