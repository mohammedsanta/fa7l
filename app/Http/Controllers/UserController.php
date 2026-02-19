<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get authenticated user profile
     */
    public function show()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }

    /**
     * Update authenticated user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6'
        ]);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user'    => $user
        ]);
    }
}
