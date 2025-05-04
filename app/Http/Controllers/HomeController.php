<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        // Redirect berdasarkan role pengguna yang login
        if (Auth::check()) {
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'driver':
                    return redirect()->route('driver.dashboard');
                case 'customer':
                    return redirect()->route('customer.dashboard');
                default:
                    return view('index');
            }
        }

        return view('index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'role' => ['sometimes', 'string', 'in:admin,driver,customer'], // Validasi role
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        // Jika yang mengubah adalah admin, maka role bisa diupdate
        if (Auth::user()->isAdmin() && $request->has('role')) {
            $user->role = $request->get('role');
        }

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }

    /**
     * Middleware untuk membatasi akses berdasarkan role
     */
    public function checkRole($role)
    {
        return function ($request, $next) use ($role) {
            if (Auth::check() && Auth::user()->role === $role) {
                return $next($request);
            }
            return redirect('/')->with('error', 'Unauthorized access');
        };
    }

    /**
     * Menampilkan dashboard admin
     */
    public function adminDashboard()
    {
        // Pastikan user adalah admin
        if (!Auth::user()->isAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return view('index');
    }

    /**
     * Menampilkan dashboard driver
     */
    public function driverDashboard()
    {
        // Pastikan user adalah driver
        if (Auth::user()->role !== 'driver') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return view('driver.dashboard');
    }

    /**
     * Menampilkan dashboard customer
     */
    public function customerDashboard()
    {
        // Pastikan user adalah customer
        if (Auth::user()->role !== 'customer') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return view('customer.dashboard');
    }
}
