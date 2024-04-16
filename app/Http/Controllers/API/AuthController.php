<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CodeGenerator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name"          =>      "required|string|max:50",
            "email"         =>      "required|email|unique:users,email",
            "password"      =>      "required|confirmed",
            "phone"         =>      "required|numeric|unique:users,phone",
        ]);

        User::create([
            "name"          =>      $request->name,
            "email"         =>      $request->email,
            "password"      =>      bcrypt($request->password),
            "phone"         =>      $request->phone
        ]);

        return response([
            "isSuccess"     =>      true,
            "msg"           =>      "Registration is done"
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email"         =>      "required|email",
            "password"      =>      "required",
            "device_name"   =>      "required"
        ]);
        $user = User::where("email", "=", $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'msg' => ['username or password are incorrect.'],
            ]);
        }
        if (DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()->count() > 0) {
            $user->tokens()->delete();
        }
        $new_token = $user->createToken($request->device_name)->plainTextToken;
        return response([
            "isSuccess"         =>      true,
            "token"             =>      $new_token
        ], 200);
    }

    public function logout()
    {
        $user = User::find(auth()->user()->id);
        $user->tokens()->delete();
        return response([
            "isSuccess"         =>      true,
            "msg"               =>      "You are logged out"
        ], 200);
    }

    public function forget_password(Request $request)
    {
        $request->validate([
            "phone"         =>      "required|numeric"
        ]);
        $user = User::where("phone", "=", $request->phone)->first();
        if (!$user) {
            return response([
                "isSuccess"         =>      false,
                "msg"               =>      "This phone number isn't found"
            ], 404);
        }
        $code = rand(1000, 9999);
        $code_generation = CodeGenerator::where("phone", "=", $request->phone)->first();
        if (!$code_generation) {
            $date = Carbon::now();
            CodeGenerator::create([
                "phone"         =>          $request->phone,
                "code"          =>          $code,
                "updated_at"    =>          $date->addMinutes(5)
            ]);
        } else {
            $date = Carbon::parse($code_generation->updated_at);
            if ($date->isFuture()) {
                return response([
                    "isSuccess"         =>      true,
                    "msg"               =>      "You have previous code is $code_generation->code still active"
                ], 200);
            } else {
                $code_generation->code = $code;
                $code_generation->updated_at = Carbon::now()->addMinutes(5);
                $code_generation->save();
            }
        }
        return response([
            "isSuccess"             =>          true,
            "code"                  =>          $code
        ], 200);
    }

    public function code_validation(Request $request)
    {
        $request->validate([
            "phone"         =>          "required|numeric",
            "code"          =>          "required|numeric"
        ]);
        $code = CodeGenerator::where("phone", "=", $request->phone)->where("code", "=", $request->code)->first();
        if (!$code) {
            return response([
                "isSuccess"     =>      false,
                "msg"           =>      "OTP code is wrong!"
            ], 406);
        } else {
            $date = Carbon::parse($code->updated_at);
            if ($date->isFuture()) {
                return response([
                    "isSuccess"     =>      true,
                    "msg"           =>      "OTP code is valid"
                ], 200);
            } else {
                return response([
                    "isSuccess"     =>      false,
                    "msg"           =>      "OTP code is expired"
                ], 406);
            }
        }
    }

    public function change_password(Request $request)
    {
        $request->validate([
            "phone"         =>      "required|numeric",
            "code"          =>      "required",
            "password"      =>      "required|confirmed"
        ]);
        $code = CodeGenerator::where("phone", "=", $request->phone)->where("code", "=", $request->code)->first();
        if (!$code) {
            return response([
                "isSuccess"     =>      false,
                "msg"           =>      "OTP code or phone is wrong!"
            ], 406);
        }
        $date = Carbon::parse($code->updated_at);
        if (!$date->isFuture()) {
            return response([
                "isSuccess"         =>      false,
                "msg"               =>      "OTP code is expired"
            ], 406);
        } else {
            $user = User::where("phone", "=", $request->phone)->first();
            if (!$user) {
                return response([
                    "isSuccess"     =>      false,
                    "msg"           =>      "This user isn't found"
                ], 404);
            } else {
                $user->password = bcrypt($request->password);
                $user->save();
                $code->updated_at = Carbon::now();
                $code->save();
                return response([
                    "isSuccess"     =>      true,
                    "msg"           =>      "Your password is changed"
                ], 200);
            }
        }
    }

    public function delete_account()
    {
        $user = User::find(auth()->user()->id);
        $user->tokens()->delete();
        $user->delete();
        return response([
            "isSuccess"     =>      true,
            "msg"           =>      "Your account is deleted"
        ], 200);
    }
}
