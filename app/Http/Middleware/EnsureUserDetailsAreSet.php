<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserDetailsAreSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role == 'student')
        {
            $student = Student::where('email', Auth::user()->email)->firstOrFail();
            if (isset($student->first_name,
                    $student->middle_name,
                    $student->last_name,
                    $student->university)) 
            {
                return $next($request);
            }
            return redirect('/student/setup')
                ->with('notification', [
                    'message' => 'Finish student initial setup first',
                    'type' => 'warning'
                ]
            );
        }
        else if (Auth::user()->role == 'company')
        {
            $company = Company::where('email', Auth::user()->email)->firstOrFail();
            if (isset($company->name,
                    $company->industry,
                    $company->address,
                    $company->contact_number)) 
            {
                return $next($request);
            }
            return redirect('/company/setup')
                ->with('notification', [
                    'message' => 'Finish company initial setup first',
                    'type' => 'warning'
                ]
            );
        }
    }
}
