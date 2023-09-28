<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Index');
    }

    public function manageUsers()
    {
        $users = User::all();
        return Inertia::render('Admin/ManageUsers', [
            'users' => $users
        ]);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return Redirect::route('admin.manageUsers')->with('message', 'User added successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return Redirect::route('admin.manageUsers')->with('message', 'User deleted successfully');
        }
        return Redirect::route('admin.manageUsers')->with('message', 'User not found');
    }

    public function editUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return Redirect::route('admin.manageUsers')->with('message', 'User updated successfully');
        }
        return Redirect::route('admin.manageUsers')->with('message', 'User not found');
    }

    public function changeUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:Admin,Editor,User',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->role = $request->role;
            $user->save();
            return redirect()->back()->with('message', 'User role updated successfully');
        }
        return redirect()->back()->with('message', 'User not found');
    }
}
