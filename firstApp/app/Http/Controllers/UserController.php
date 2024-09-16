<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo_file' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();

        if ($request->hasFile('photo_file')) {
            $user->photo_file = Storage::disk('public')->put('profile_photos', $request->photo_file);
        } elseif ($request->photo_url) {
            $user->photo_url = $request->photo_url;
        } else {
            $user->photo_file = 'profile_photos/users_default.jpg';
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->authority = 'user';
        $user->password = Hash::make($request->password);
        $user->created_at = now();
        $user->save();

        return redirect()->route('users.index')->with('success', 'User successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userAuthority = $user->authority;
        return view('users.edit', compact('user', 'userAuthority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $authority = $request->input('authority', 'user');
        $user->authority = $authority;

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function editPhoto(User $user)
    {
        return view('users.editPhoto', compact('user'));
    }

    public function updatePhoto(Request $request, User $user)
    {
        $request->validate([
            'photo_file' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo_file')) {
            $user->photo_file = $request->file('photo_file')->store('profile_photos', 'public');
            $user->photo_url = null;
        } elseif ($request->photo_url) {
            $user->photo_url = $request->photo_url;
            $user->photo_file = null;
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Photo updated successfully!');
    }

    /* public function destroy(Request $request)
    {
        $userIds = $request->input('user_ids');

        if ($userIds) {
            User::whereIn('id', $userIds)->delete();
            return response()->json(['success' => true]);
        }


        return response()->json(['success' => false, 'message' => 'No users selected.'], 400);
    } */
    public function destroy(Request $request)
    {
        $userIds = $request->input('user_ids');

        if ($userIds) {
            $users = User::whereIn('id', $userIds)->get();

            $currentUser = Auth::user();
            foreach ($users as $user) {
                if ($user->authority == 'superadmin') {
                    if ($currentUser->authority != 'superadmin' || $currentUser->id == $user->id) {
                        return redirect()->route('your.route.name')->with('danger', 'You do not have permission to delete a superadmin.');
                    }
                }
            }

            User::whereIn('id', $userIds)->delete();

            return redirect()->route('your.route.name')->with('danger', 'Users deleted successfully!');
        }

        return redirect()->route('your.route.name')->with('danger', 'No users selected');
    }
}

