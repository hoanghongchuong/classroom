<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailWelcomeJob;
use App\Mail\SendMailWellCome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function sendMail() {
        $users = User::all();
        foreach($users as $user) {
            SendEmailWelcomeJob::dispatch($user->email, $user->name);
        }
//        Mail::to('test12@gmail.com')->send(new SendMailWellCome('TestSendMail'));

    }
}
