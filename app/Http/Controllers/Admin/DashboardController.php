<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Slider;
use App\Models\Reservation;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index() {
        $categoryCount = Category::count();
        $itemCount = Item::count();
        $sliderCount = Slider::count();
        $reservation = Reservation::where('status',false)->get();
        $contactCount = Message::count();
        $reservations = Reservation::all();
        return view('admin.dashboard',compact('reservations','categoryCount','itemCount','sliderCount','reservation','contactCount'));
    }
}
