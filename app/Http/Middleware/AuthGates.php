<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\AppConfiguration;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        if ($user = User::find($request->user()?->id)) {

            $permissions = $user->computed_permissions();

            foreach ($permissions as $permission) {
                Gate::define($permission->title, fn() => true);
            }
        }
        return $next($request);
    }
}
