<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            $totalUsers = User::count();
            $users = User::where('name', '!=', 'Admin')->get();
            return view('dashboard', ['totalUsers' => $totalUsers, 'users' => $users]);
        } else {
            return view('home');
        }
    }
    

    public function dashboard(Request $request)
    {
        $users = User::all();
        return view('admin.dashboard')->with('users', $users);
    }

    public function register()
    {
        $users = User::where('name', '!=', 'Admin')->get();
        return view('pages.register')->with('users', $users);
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);
    }


    public function storeUser(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'permit' => 'required|file|mimes:jpeg,png,pdf|max:2048', // add this validation rule for permit file
        ]);

        // Store the permit file
        $permitPath = $request->file('permit')->store('public/permits');

        // Get only the file name from the file path
        $permitName = basename($permitPath);

        // Create the new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->middlename = $validatedData['middlename'];
        $user->lastname = $validatedData['lastname'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->permitnumber = $validatedData['password'];
        $user->permit = $permitName; // save the permit path to the user model
        $user->save();

        // Redirect to home with success message
        return redirect('pages/register')->with('success', ' Created Successfully!');
    }
}
