<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('seller.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'store_name'            => ['nullable', 'string', 'max:255'],
            'store_description'     => ['nullable', 'string'],
            'phone'                 => ['nullable', 'string', 'max:50'],
            'address'               => ['nullable', 'string', 'max:255'],
            'logo'                  => ['nullable', 'image', 'max:2048'],

            'bank_name'            => ['nullable', 'string', 'max:100'],
            'bank_account_number'  => ['nullable', 'string', 'max:50'],
            'bank_account_holder'  => ['nullable', 'string', 'max:100'],
        ]);

        // handle logo
        if ($request->hasFile('logo')) {
            if ($user->store_logo) {
                Storage::disk('public')->delete($user->store_logo);
            }

            $path = $request->file('logo')->store('store_logos', 'public');
            $user->store_logo = $path;
        }

        $user->store_name           = $request->store_name ?: ('Toko ' . $user->name);
        $user->store_description    = $request->store_description;
        $user->phone                = $request->phone;
        $user->address              = $request->address;

        $user->bank_name            = $request->bank_name;
        $user->bank_account_number  = $request->bank_account_number;
        $user->bank_account_holder  = $request->bank_account_holder;

        $user->save();

        return redirect()
            ->route('seller.profil')
            ->with('success', 'Profil seller berhasil diperbarui.');
    }
}
