<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginUserRequest;

class AuthController extends Controller
{
    use ApiResponses;
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());
        if(!Auth::attempt($request->only('email','password'))){
            return $this->error('InValid Credentials',401);
        }
        $user = User::firstWhere('email',$request->email);
        return $this->ok( 'Authenticated',
        [
        'token' => $user->createToken(
            'API Token for'. $user->email,['*'],
            now()->addMonth())->plainTextToken
        ]
        );

    }
    public function logout(Request $request)
    {
        // $request->user()->tokens()->where('id',$tokenable_Id)->delete();
        $request->user()->currentAccessToken()->delete();
        return $this->ok("log out");
    }
    public function register()
    {
    }
}
