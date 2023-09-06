<?php namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $re = $request->server('AUTH_USER');
        if ($request->server('AUTH_USER') && ($user = User::where('name', $request->server('AUTH_USER'))->first()))
        {
            $this->auth->login($user);
        }
        else
        {
            return redirect()->guest('login');
        }

        return $next($request);
    }

}
