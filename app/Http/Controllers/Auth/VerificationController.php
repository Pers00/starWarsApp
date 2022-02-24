<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    
    public function verify(Request $request)
    {
        if ($request->user() != null && (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey()))) {
            throw new AuthorizationException;
        }
        if ($request->user() != null && (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification())))) {
            throw new AuthorizationException;
        }
        if ($request->user() != null && $request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }
        $user = \App\Models\User::find($request->route('id'));//14
        //$user = $request->user();
        //if ($request->user()->markEmailAsVerified()) {
        if ($user !== null && $user->markEmailAsVerified()) {
            //event(new Verified($request->user()));
            event(new Verified($user));
        }
        if ($response = $this->verified($request)) {
            return $response;
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }

}
