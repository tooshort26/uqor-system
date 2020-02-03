<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Repository\FormRepository;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RemindFormSubmission
{
    private $formRepository;

    public function __construct(FormRepository  $formRepo)
    {
        $this->formRepository = $formRepo;
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
        if (!$this->formRepository->remindSubmission()) {
            Session::put('form_submission_review', 'no_form');
        } else {
            Session::put('form_submission_review', 'has_form');
        }
        
        return $next($request);
    }
}
