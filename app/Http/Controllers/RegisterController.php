<?php
    
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
    
class RegisterController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('home');
        }
    }
    
    public function dashboard(Request $request)
    {
        $users = User::all();
    
        return view('admin.dashboard')->with('users', $users);
    }
    
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);
    }

    public function register()
    {
        // $users = User::where('is_admin', 0)->get();
        $users = User::all();
        return view('register')->with('users', $users);
    }

    public function storeUser(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'permit' => 'required|file|mimes:jpeg,png,pdf|max:2048', // add this validation rule for permit file
        ]);

        // Store the permit file
        $permitPath = $request->file('permit')->store('public/permits');

        // Create the new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->permit = $permitPath; // save the permit path to the user model
        $user->save();

        // Redirect to home with success message
        return redirect('admin/register')->with('success', 'User created successfully.');
    }


}