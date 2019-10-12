<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function allNotification(){
    	return view('admin.notifications.index');
    }

    public function markallasread(){
    	auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
    }
}
