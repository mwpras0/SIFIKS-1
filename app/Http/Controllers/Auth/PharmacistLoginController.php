<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PharmacistLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:pharmacist');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.pharmacist-login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Validate Data
        $validate = Validator::make($data, [
            'email' => 'required|exists:pharmacist|email',
            'password' => 'required|min:6'
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt Login
        if(Auth::guard('pharmacist')->attempt($credentials, $request->remember)) {
            // If 'true' -> redirect to admin.index
            session([
                'role' => 'Pharmacist',
                'guard' => 'pharmacist'
            ]);
            return redirect()->intended(route('admin.dashboard'));
        }
        // If 'false' -> send failed login response
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     */
    private function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
           'email' => [trans('auth.failed')],
        ]);
    }
}
