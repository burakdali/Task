<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function userProducts()
    {
        $user = User::find(Auth::user()->id);
        $products = $user->product()->get()->toArray();
        return view('user.index')->with('products', $products);
    }

    public function getUsers(Request $req)
    {
        if ($req->ajax()) {
            $data = User::select('id', 'first_name', 'last_name', 'email', 'phone_number')->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($data) {
                $actionBtn = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm text-dark" data-bs-toggle="modal" data-bs-target= "#editUser">Edit</button><button type="button" id="' . $data->id . '" class="text-dark delete btn btn-danger btn-sm" >Delete</button>
                <button type="button" id="' . $data->id . '" class="assign btn btn-primary text-dark btn-sm"  data-bs-toggle="modal" data-bs-target= "#assignProducts">Assign</button>';
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
    public function deleteUser($id)
    {
        if (request()->ajax()) {
            $user = User::find($id);
            $user->delete();
            return response()->json(['result' => 'Deleted succesfully']);
        }
    }
    public function editUser($id)
    {

        if (request()->ajax()) {
            $user = User::findOrFail($id);
            return response()->json(['result' => $user]);
        }
    }
    public function updateUser(Request $req)
    {
        $req->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone_number' => ['string', 'max:13'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::find($req->id);
        $user->update([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'phone_number' => $req->phone_number,
            'password' => Hash::make($req->password),
        ]);
        return view('admin.users.index')->with('success', 'User edited succesfully');
    }
    public function assignSave(Request $req)
    {
        foreach ($req->input('products') as $index) {
            DB::table('user_product')->insert([
                'user_id' => $req->id,
                'product_id' => $index,
            ]);
        }
        return view('admin.products.index');
    }
}
