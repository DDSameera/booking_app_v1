<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRoomsRequest;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function __construct(private RoomRepositoryInterface $rooms) {}

    public function search()
    {
        return Inertia::render('Booking/RoomSearch', [
            'defaults' => [
                'check_in' => now()->toDateString(),
                'check_out' => now()->addDay()->toDateString(),
                'guests' => 1,
            ],
        ]);
    }

    public function list(SearchRoomsRequest $request)
    {
        $checkIn = Carbon::parse($request->input('check_in'));
        $checkOut = Carbon::parse($request->input('check_out'));
        $guests = (int) $request->input('guests');

        $rooms = $this->rooms->searchAvailable($checkIn, $checkOut, $guests);

        return Inertia::render('Booking/Rooms', [
            'rooms' => $rooms,
            'search' => $request->only(['check_in','check_out','guests']),
        ]);
    }
}
