<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all(); // جلب جميع الغرف من قاعدة البيانات
        return view('public_site.layouts.roompage', compact('rooms')); // إرسال المتغير $rooms إلى الـ View
    }

    public function show($id)
    {
        $room = Room::findOrFail($id); // جلب تفاصيل الغرفة بناءً على الـ ID
        return view('public_site.layouts.bookingpage', compact('room'));
    }
}
