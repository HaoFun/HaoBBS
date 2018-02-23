<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //取得登入用戶所有的通知
        $notifications = Auth::user()->notifications()->paginate(20);

        //已讀通知，並將通知數歸零
        Auth::user()->markAsRead();

        return view('notifications.index',compact('notifications'));
    }
}
