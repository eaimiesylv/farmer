<?php

namespace App\Http\Controllers\Core\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Core\Auth\User\LoginRequest as Request;
use App\Services\Core\Auth\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use App\Hooks\User\CustomRoute;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        return env('APP_INSTALLED') ? view('auth.login') : redirect('install');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
       
        try {
            $this->service->login();
            // custom hook
            $route = CustomRoute::new(true)->handle();
            $route = count($route) ? $route : home_route();
            return route(
                $route['route_name'],
                $route['route_params']
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception instanceof ModelNotFoundException ? trans('default.resource_not_found', ['resource' => trans('default.user')]) : $exception->getMessage()
            ], 400);
        }
    }

    public function logOut(): RedirectResponse
    {
        session()->flush();
        auth()->logout();
        session()->flush();

        return redirect()->route('users.login.index');
    }
    public function verify($email){
        try {
            $decryptedEmail = Crypt::decrypt($email);
    
            $user = User::where('email', $decryptedEmail)->first();
    
            if ($user) {
                // Email found, update the 'verify' column to 1
                $user->update(['verify' => 1]);
                return redirect()->route('verification')->with('success', 'Your email has been verified.');
    
            } else {
                // Email not found
                return redirect()->route('verification')->with('error', 'Email not found');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Invalid or corrupted email parameter
            return redirect()->route('verification')->with('error', 'Invalid email parameter');
        }
    }
    
}
