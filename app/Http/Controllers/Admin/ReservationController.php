<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Notifications\ReservationConfirm;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservation.index',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required | email',
            'dateandtime' => 'required'
        ]);

        $reservation = new Reservation();
        $reservation -> name = $request->name;
        $reservation -> phone = $request->phone;
        $reservation -> email = $request->email;
        $reservation -> date_and_time = $request->dateandtime;
        $reservation -> massage = $request->massage;
        $reservation -> status = false;
        $reservation -> save();
        
        //Toastr::success('Reservation request sent successfully. We will confirm to you shortly','Success',["positionClass" => "toast-top-center"]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = true;
        $reservation->save();

        /* Notification::route('mail', $reservation->email)
            ->route('slack', 'https://hooks.slack.com/services/...')
            ->notify(new ReservationConfirm()); */

        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation -> delete();
        return redirect()->route('reservation.index');
    }
}
