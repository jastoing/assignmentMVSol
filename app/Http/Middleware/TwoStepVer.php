<?php

namespace App\Http\Middleware;

use Closure;
Use Auth;
use App\Jobs\EmailSenderJob;
use Illuminate\Support\Facades\Mail;
use Session;
class TwoStepVer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user = Auth::user();
        if($user->token_2stp_exp > \Carbon\Carbon::now()){
            return $next($request);
        } 
        
        $user->token_2stp = mt_rand(100000,999999);
        $user->save();        

        dispatch(new EmailSenderJob(['to'=>$user,'code'=>$user->token_2stp]));

        Session::flash('CodeMsg', 'Verifcation code sent to your mail !'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/2step'); 
    }
}
