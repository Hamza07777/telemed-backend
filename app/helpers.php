<?php
use Illuminate\Support\Facades\Auth;

function sendMail($email,$details)
{
    \Mail::to($email)->send(new \App\Mail\otpMail($details));
}
