<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Profile;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    use UploadImageTrait;

    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locals' => Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:200'],
            'last_name' => ['required', 'string', 'min:3', 'max:200'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female'],
            'country' => ['nullable', 'string', 'size:2'],
        ]);
        $user = Auth::user();

        $user->profile->fill($request->all())->save();

        // $profile = $user->profile;
        // if ($profile->user_id) {
        //     # code...
        //     $profile->update($request->all());
        // } else {
        //     $request->merge([
        //         'user_id' => $user->id
        //     ]);
        //     Profile::create($request->all());

        //     $user->profile()->create($request->all());
        // }
        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'profile updated');
    }
}
