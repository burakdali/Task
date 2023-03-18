<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function addUser(Request $req)
    {
        $req->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone_number' => ['string', 'max:13'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'first_name' => $req->input('first_name'),
            'last_name' => $req->input('last_name'),
            'email' => $req->input('email'),
            'phone_number' => $req->input('phone_number'),
            'password' => Hash::make($req->input('phone_number')),
        ]);
        return response()->json($user);
    }
    public function deleteUser(Request $req)
    {
        $user = User::find($req->input('id'));
        $user->delete();
        return response()->json("User deleted succesfully");
    }
    public function updateUser(Request $req)
    {
        $req->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone_number' => ['string', 'max:13'],
            'password' => ['required'],
        ]);

        $user = User::find($req->input('id'));
        $user->update([
            'first_name' => $req->input('first_name'),
            'last_name' => $req->input('last_name'),
            'email' => $req->input('email'),
            'phone_number' => $req->input('phone_number'),
            'password' => Hash::make($req->input('password')),
        ]);
        return response()->json("User edited succesfully");
    }
    public function getUserProducts(Request $req)
    {
        $user = User::find($req->input('id'));
        $products = $user->product()->get()->toArray();
        return response()->json($products);
    }
    public function assignProducts(Request $req)
    {
        DB::table('user_product')->insert([
            'user_id' => $req->input('user_id'),
            'product_id' => $req->input('product_id'),
        ]);

        return response()->json("Products assigned succesfully");
    }
}
