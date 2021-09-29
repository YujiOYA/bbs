<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestMailController extends Controller
{
    public function sendmail()
    {
        Mail::to('test@example.com')
        ->send(new TestMail());
    }
}
