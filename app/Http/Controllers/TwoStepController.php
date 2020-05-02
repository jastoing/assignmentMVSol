<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EmailSenderJob;
use Illuminate\Support\Facades\Mail;
use Session;
use Auth;

class TwoStepController extends Controller
{
    public function verifyTwoStep(Request $request)
    {
        $request->validate([
            '_2step' => 'required',
        ],
	    [
	        '_2step.required' => 'Please enter 2 step code!',
	    ]);

        $user = Auth::user();
        $timeNow = \Carbon\Carbon::now();
        if ($user->token_2stp_attempt > 3 && $user->token_2stp_wait < $timeNow) {
        	$user->token_2stp_attempt =null;
        	$user->save();  
        }
        if ($user->token_2stp_attempt > 3 && $user->token_2stp_wait > $timeNow) {
        	$start = \Carbon\Carbon::parse($timeNow);
	        $end = \Carbon\Carbon::parse($user->token_2stp_wait);
	    	$seconds = $end->diffInSeconds($start);

        	return redirect()->back()->withErrors(["_2step"=>["Too many attempts, wait for ".$seconds." seconds" ]]);
        }
        else if($request->input('_2step') == Auth::user()->token_2stp){
            $user->token_2stp_exp = \Carbon\Carbon::now()->addMinutes(config('session.lifetime'));
            $user->token_2stp_attempt=null;
            $user->token_2stp_wait=null;
            $user->save();       
            return redirect('/admin');
        } else {
        	$user->token_2stp_wait=\Carbon\Carbon::now()->addSeconds(30);
        	$user->token_2stp_attempt +=1;
        	$user->save();   
            return redirect()->back()->withErrors(["_2step"=>["2 Step verifcation code is INVALID !"]]); 
        }
    }

    public function index()
    {
        return view('auth.two_step');
    } 

    public function resend2step()
    {
        $user = Auth::user();
        if($user->token_2stp_exp > \Carbon\Carbon::now()){
            return redirect('/admin');
        } 
        
        $user->token_2stp = mt_rand(10000,99999);
        $user->save();        

        dispatch(new EmailSenderJob(['to'=>$user,'code'=>$user->token_2stp]));
        Session::flash('CodeMsg', 'Verifcation code sent to your mail !'); 
		Session::flash('alert-class', 'alert-success'); 
        return redirect('/2step'); 
    }  
}
