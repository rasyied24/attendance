<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role !== 'admin') {
            $data = User::with('employee')->find($user->id);

            // Periksa apakah relasi employee ada dan statusnya 2
            if ($data->employee && $data->employee->status == 2) {
                // Logout user
                auth()->logout();

                // Kembali ke halaman login dengan pesan error
                return redirect()
                    ->route('login')
                    ->with('failed', 'Tidak dapat akses');
            } else {
                $user->status = 1;
                $user->login_at = now()->format('Y-m-d');
                $user->save();
                return redirect()->route('home');
            }
        }

        // Update user status to active

        if ($user->role === 'admin') {
            // Redirect ke halaman admin
            $user->status = 1;
            $user->save();
            return redirect()->route('admin.index');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Update user status to inactive
        $user = $request->user();
        if ($user) {
            $user->status = 2;
            $user->save();
        }

        // Logout the user
        auth()->logout();

        // Redirect to login page
        return redirect('/login');
    }

}
