<?php

namespace jericho\Http\Middleware;

use Illuminate\Support\Facades\App;

use Closure;
use jericho\Permissions\PermissionValidator;

/**
 * This middleware class is used to validate if a user belongs to a role that has the specified permission.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-03
 *
 */
class ValidatePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission_name)
    {
    	if (!PermissionValidator::hasPermission($permission_name))
    	{
    		App::abort('404', 'You do not have the following permission: ' . $permission_name);
    	}
    	//Else through an exception
        return $next($request);
    }
}
