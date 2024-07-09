<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        // Save current url for back button
        session()->put('back_url', url()->current());

        return view('user.account');
    }

    public function update(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'cellphone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find(Auth::id());

        $user->forceFill([
            'name' => $request->name,
            'cellphone' => $request->cellphone,
            'address' => $request->address,
        ]);

        if ($request->password) {
            request()->validate([
                'password' => 'confirmed',
            ]);
            $user->forceFill([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->save();

        return redirect()->route('account');
    }
}
