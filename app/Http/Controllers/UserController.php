<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('id')->get();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ]);

        User::create($validated + [
            'role' => 'Staff',
            'status' => 'Active',
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$user->id],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        $avatarPath = $user->avatar;
        if ($request->hasFile('avatar')) {
            if (extension_loaded('gd')) {
                $thumbnail = ImageManager::gd()
                    ->read($request->file('avatar')->getRealPath())
                    ->cover(256, 256)
                    ->toJpeg(80);
                $avatarPath = 'avatars/'.Str::uuid().'.jpg';
                Storage::disk('public')->put($avatarPath, $thumbnail);
            } else {
                Log::warning('GD is unavailable; storing the validated avatar without thumbnail processing.');
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        $user->update([
            ...$validated,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
