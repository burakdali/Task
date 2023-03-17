<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function getUsers(Request $req)
    {
        if ($req->ajax()) {
            $data = User::select('first_name', 'last_name', 'email', 'phone_number')->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($data) {
                $actionBtn = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm" >Edit</button> ';
                $actionBtn .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" >Delete</button>';
                return $actionBtn;
            })->rawColumns(['action'])->make(true);
        }
    }
    public function addUser()
    {
        return view('admin.users.addUser');
    }
    public function storeUser(Request $req)
    {

        $req->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['string', 'max:13'],
            'password' => ['required', Rules\Password::defaults()],
        ]);
        User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'phone_number' => $req->phone_number,
            'password' => Hash::make($req->password)
        ]);
        return redirect()->back();
    }
}
