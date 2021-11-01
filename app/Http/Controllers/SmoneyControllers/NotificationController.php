<?php

namespace App\Http\Controllers\SmoneyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SmoneyModels\Notification;

class NotificationController extends Controller
{
    public function makeNotification($content, $idFrom, $idTo, 
        $link, $type_from, $type_to, $type)
    {
        $newNo = new Notification();
        $newNo->no_content = $content;
        $newNo->no_id_from = $idFrom;
        $newNo->no_id_to = $idTo;
        $newNo->no_link = $link;
        $newNo->no_type_from = $type_from;
        $newNo->no_type_to = $type_to;
        $newNo->no_type = $type;
        $newNo->save();
    }
}
