<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExampleController extends Controller
{
    public function sendExamplemail()
    {
        try {
            //code...

            Mail::to('eddieden@email.com')->send(new ExampleMail());

            return response()->json(
                [
                    "success" => true,
                    "message" => "Example email send succesfully",
                ]
            );

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(
                Log::eror("error sengind Email".$th->getMessage()),
                [
                    "success" => false,
                    "message" => "error sending email"
                ]
            );
        }
    }
}
