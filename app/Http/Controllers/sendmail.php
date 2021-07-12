<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class sendmail extends Controller
{
    public function send(){
    	Mail::send(['text'=>'id'],['name','Sathkak'],function($message){
    		$message->to('shikatora1999@gmail.com','to me')->subject('Text mail');
    		$message->from('shikatora1999@gmail.com','Long');
    	});
    }
}
