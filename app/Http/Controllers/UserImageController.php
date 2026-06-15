<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user()->fresh();
        // $user = Auth::user();

        $request->validate([
            'image_path' => ['required', 'image', 'max:5012'],
        ]);

        if ($user->image_path) {
            Storage::disk('public')->delete($user->image_path);
        }

        $imagePath = $request->image_path->store('users', 'public');

        $user->update(['image_path' => $imagePath]);

        return back()->with('status', 'profile-image-updated');
    }

    public function destroy(Request $request)
    {
        $user = $request->user()->fresh();
        // $user = Auth::user();

        if ($user->image_path) {
            Storage::disk('public')->delete($user->image_path);
        }

        $user->update(['image_path' => null]);

        return back()->with('status', 'profile-image-removed');
    }
}
