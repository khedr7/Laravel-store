<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validation = $request->validate([
            'name'      => 'required|string|min:3|max:25',
            'email'     => 'required|email',
            'password'  => 'required',
            'phone'     => 'numeric',
        ]);

        $validation['password'] = bcrypt($validation['password']);
        $user = User::create($validation);
        $token = $user->createToken('auth');
        if ($user) {
            return response()->json([
                'message' => 'user successfully registered',
                'name'   => $user->name,
                'email'   => $user->email,
                'phone'   => $user->phone,
                'token'   => $token->plainTextToken
            ], 201);
        }
        return response()->json([
            'message' => 'register failed',
        ], 400);
    }

    public function logIn(Request $request)
    {
        $credentials = $request->validate([
            'email'        => 'required|email',
            'password'     => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('auth');
            return response()->json([
                    'message' => 'User successfully loged in',
                    'name'   => $user->name,
                    'token'   => $token->plainTextToken
            ], 201);
        }
        return response()->json([
            'message' => 'Email or password is wrong',
        ], 400);
    }

    public function logOut(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted',
        ], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
