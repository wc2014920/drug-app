<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //這裡可讓通過帳號登入驗證的成員不會跑出其他頁面或服務

                if ($guard == 'admin'){//但是若有不同身分，就需要在建立條件來支持
                    return redirect(route('admin.home'));
                }
                return redirect(route('user.home'));

            }
        }

        return $next($request);
    }
}
