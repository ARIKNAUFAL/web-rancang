<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelProfileAdmin;
use Illuminate\Support\Facades\Hash;

class ProfileAdmin extends Controller
{

    public function __construct()
    {
        $this->ModelProfileAdmin = new ModelProfileAdmin();
    }

    public function index($admin_id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title' => 'My Profile',
            'admin' => $this->ModelProfileAdmin->getProfile($admin_id)
        ];

        return view('admin.profile.index', $data);
    }

    public function updateProfile($admin_id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title' => 'My Profile / Update Profile',
            'admin' => $this->ModelProfileAdmin->getProfile($admin_id)
        ];

        return view('admin.profile.updateProfile', $data);
    }

    public function update($admin_id)
    {
        Request()->validate([
            'first_name'   => 'required',
            'email'        => 'required|email',
        ]);

        if (Request()->photo_profile <> "") {
            $admin = $this->ModelProfileAdmin->getProfile($admin_id);
            if ($admin->photo_profile <> "") {
                unlink(public_path('userPhoto') . '/' . $admin->photo_profile);
            }

            $file       = Request()->photo_profile;
            $fileName   = date('mdYHis') . '.' . $file->extension();
            $file->move(public_path('userPhoto'), $fileName);

            $data = [
                'admin_id'      => $admin_id,
                'first_name'    => Request()->first_name,
                'last_name'     => Request()->last_name,
                'address'       => Request()->address,
                'phone_number'  => Request()->phone_number,
                'gender'        => Request()->gender,
                'photo_profile' => $fileName,
            ];

            $dataAdmin = [
                'id'    => $admin_id,
                'email' => Request()->email
            ];

            $this->ModelProfileAdmin->editAdmin($dataAdmin);
            $this->ModelProfileAdmin->edit($data);
        } else {

            $data = [
                'admin_id'      => $admin_id,
                'first_name'    => Request()->first_name,
                'last_name'     => Request()->last_name,
                'address'       => Request()->address,
                'phone_number'  => Request()->phone_number,
                'gender'        => Request()->gender,
            ];

            $dataAdmin = [
                'id'    => $admin_id,
                'email' => Request()->email
            ];

            $this->ModelProfileAdmin->editAdmin($dataAdmin);
            $this->ModelProfileAdmin->edit($data);
        }

        return redirect()->to("/profile-admin/" . $admin_id)->with('success', 'Data Updated Successfully !');
    }

    public function changeStatus($admin_id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'id'        => $admin_id,
            'status'    => 'Non-active'
        ];

        $this->ModelProfileAdmin->editAdmin($data);
        return redirect()->to("/profile-admin/" . $admin_id)->with('success', 'Data Updated Status Successfully !');
    }

    public function changePassword()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        $data = [
            'title' => 'My Profile / Change Password ',
        ];

        return view('admin.profile.changePassword', $data);
    }

    public function updatePassword($admin_id)
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        Request()->validate([
            'oldPassword'   => 'required',
            'newPassword'   => 'required|min:8',
        ]);

        $dataAdmin = $this->ModelProfileAdmin->detailAdmin($admin_id);

        if ($dataAdmin) {
            if (Hash::check(Request()->oldPassword, $dataAdmin->password)) {
                $data = [
                    'id'        => $dataAdmin->id,
                    'password'  => Hash::make(Request()->newPassword)
                ];

                $this->ModelProfileAdmin->editAdmin($data);
                return redirect()->to("change-password")->with('success', 'Password Updated Successfully !');
            } else {
                return back()->with('error', 'Your password not match.');
            }
        } else {
            return back()->with('error', 'Data admin not found!');
        }
    }
}
