<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{

    public function register(Request $request)
    {
        $validation = $request->validate([
            'fname'        => 'required|string|min:3|max:25',
            'lname'        => 'required|string|min:3|max:25',
            'email'        => 'required|email',
            'password'     => 'required',
            'phone' => 'numeric',
        ]);

        $validation['password'] = bcrypt($validation['password']);
        $customer = Customer::create($validation);
        $token = $customer->createToken('auth');
        if ($customer) {
            return response()->json([
                'message' => 'Customer successfully registered',
                'fname'   => $customer->fname,
                'lname'   => $customer->lname,
                'email'   => $customer->email,
                'phone'   => $customer->phone,
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
            $customer = Auth::user();
            $customer->tokens()->delete();
            $token = $customer->createToken('auth');
            return response()->json([
                    'message' => 'Customer successfully loged in',
                    'fname'   => $customer->fname,
                    'lname'   => $customer->lname,
                    'token'   => $token->plainTextToken
            ], 201);
        }
        return response()->json([
            'message' => 'Email or password is wrong',
        ], 400);
    }

    public function logOut(Request $request)
    {
        $customer = Auth::user();
        $customer->tokens()->where('id', $customer->currentAccessToken()->id)->delete();

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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
