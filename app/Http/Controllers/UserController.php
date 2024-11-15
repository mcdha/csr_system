<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAddedMail;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // public function index(Request $request)
    // {
    //     if (!$request->ajax()) {
    //         return view("users.index");
    //     }

    //     $users = User::query();

    //     return Datatables::of($users)
    //         ->addIndexColumn()
    //         ->editColumn('first_name', function ($row) {
    //             return $row->full_name;
    //         })
    //         ->addColumn('action', function ($row) {
    //             $html = "<a href='" . route('users.edit', ['user' => $row->id]) . "' class='text-decoration-none'>
    //                         <button type='submit' class='btn btn-outline-primary bg-white mb-2 mb-md-0'>Edit</button>
    //                     </a>
    //                     <form method='POST' action='" . route('users.destroy', ['user' => $row->id]) . "' class='d-inline'>
    //                     " . csrf_field() . "
    //                     " . method_field('DELETE') . "
    //                     <button type='submit' class='btn btn-outline-primary bg-white mb-2 mb-md-0'>Delete</button>
    //                 </form>";

    //             $html .= "</div>";

    //             return $html;
    //         })
    //         ->editColumn('created_at', function ($row) {
    //             return $row->created_at->format('M d, Y h:i A');
    //         })
    //         ->editColumn('image_file', function($row){
    //             $image_file = null;

    //             if ($file_name = $row->image_file) {
    //                 $image_file = asset('storage/users/' . $file_name);
    //             } else {
    //                 $image_file = asset('images/users/user_default.jpeg');
    //             }

    //             return "<img class='w-12 h-12 rounded-full shadow mr-2' src='$image_file' alt='Bonnie image'/>";
    //         })
    //         ->rawColumns(['action', 'image_file'])
    //         ->make(true);
    // }

    public function index(Request $request)
{
    if (!$request->ajax()) {
        return view("users.index");
    }

    $users = User::query();

    return Datatables::of($users)
        ->addIndexColumn()
        ->editColumn('first_name', function ($row) {
            return $row->full_name;
        })
        ->addColumn('action', function ($row) {
            // Check if the logged-in user is an admin
            if (auth()->user()->role === 'Admin') {
                $html = "<a href='" . route('users.edit', ['user' => $row->id]) . "' class='text-decoration-none'>
                            <button type='submit' class='btn btn-outline-primary bg-white mb-2 mb-md-0'>Edit</button>
                        </a>
                        <form method='POST' action='" . route('users.destroy', ['user' => $row->id]) . "' class='d-inline'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                        <button type='submit' class='btn btn-outline-primary bg-white mb-2 mb-md-0'>Delete</button>
                    </form>";
                return $html;
            }
            // If the user is not an admin, return an empty string or some other custom value
            return '';
        })
        ->editColumn('created_at', function ($row) {
            return $row->created_at->format('M d, Y h:i A');
        })
        ->editColumn('image_file', function($row){
            $image_file = null;

            if ($file_name = $row->image_file) {
                $image_file = asset('storage/users/' . $file_name);
            } else {
                $image_file = asset('images/users/user_default.jpeg');
            }

            return "<img class='w-12 h-12 rounded-full shadow mr-2' src='$image_file' alt='User Image'/>";
        })
        ->rawColumns(['action', 'image_file'])
        ->make(true);
}


    public function create()
    {
        return view('users.create');
    }


    public function store(StoreRequest $request)
    {
        try {
            // Generate password as "agent" + agent_code
            $generated_password = 'agent' . $request->input('agent_code');

            $user = new User($request->all());
            $user->password = hash('sha256', $generated_password);
            $user->save();

            Mail::to($user->email)
                ->queue(new UserAddedMail($user, $generated_password));

            if ($request->hasFile('image_file')) {
                $directory_path = 'users';

                if (!Storage::disk('public')->exists($directory_path)) {
                    Storage::disk('public')->makeDirectory($directory_path);
                }

                $extension = $request->file('image_file')->getClientOriginalExtension();
                $file_name = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                Storage::disk('public')->putFileAs($directory_path, $request->file('image_file'), $file_name);

                $user->update([
                    'image_file' => $file_name
                ]);
            }

            return redirect()->route('users.create')->with('success', 'User added successfully!');
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->route('users.create')->with('error', 'An error occurred while adding the user. Please try again.');
        }
    }




    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            // Update user details, excluding the 'image_file' field
            $user->update($request->except('image_file'));

            // If an image file was uploaded, handle the file upload
            if ($request->hasFile('image_file')) {
                // Delete the old image file if exists
                if ($user->image_file) {
                    Storage::disk('public')->delete('users/' . $user->image_file);
                }

                $directory_path = 'users'; // Define the directory path for uploaded images

                // Create directory if not exists
                if (!Storage::disk('public')->exists($directory_path)) {
                    Storage::disk('public')->makeDirectory($directory_path);
                }

                // Generate a unique file name for the uploaded image
                $extension = $request->file('image_file')->getClientOriginalExtension();
                $file_name = date('YmdHis') . '_' . uniqid() . '.' . $extension;

                // Save the image file to the specified directory
                Storage::disk('public')->putFileAs($directory_path, $request->file('image_file'), $file_name);

                // Update the image path in the database
                $user->update(['image_file' => $file_name]);
            }

            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return redirect()->route('users.index')->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been successfully deleted!');
    }
}
