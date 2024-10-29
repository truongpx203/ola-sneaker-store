<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Else_;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.list-user', compact('users'));
    }

    public function update($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();
        }
        return back()->with('success', 'Trạng thái tài khoản đã được cập nhật.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
       
        $validatedData = $request->validate([
            'full_name' => 'required|max:100',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8', // Mật khẩu không bắt buộc
            'phone_number' => 'nullable|max:15',
            'address' => 'nullable|max:255',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:pending,active,inactive',
        ]);
    
        $user = User::findOrFail($id);
        $user->full_name = $validatedData['full_name'];
        // $user->email = $validatedData['email'];
    
        // Cập nhật mật khẩu nếu có
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
    
        $user->phone_number = $validatedData['phone_number'];
        $user->address = $validatedData['address'];
        $user->role = $validatedData['role'];
        $user->status = $validatedData['status'];
    
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật Tài khoản thành công.');
    }
}
