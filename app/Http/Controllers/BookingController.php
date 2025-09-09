<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Room;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function __construct(
        private BookingRepositoryInterface $bookings,
        private RoomRepositoryInterface $rooms,
        private BookingService $service
    ) {
       // $this->middleware('auth');
    }

    public function contact(Request $request)
    {
        // from Rooms page selection
        $validated = $request->validate([
            'room_id' => ['required','exists:rooms,id'],
            'check_in' => ['required','date','after_or_equal:today'],
            'check_out' => ['required','date','after:check_in'],
            'guests' => ['required','integer','min:1'],
        ]);

        $room = $this->rooms->findById((int)$validated['room_id']);
        $total = $this->service->priceForStay(
            (float)$room->price_per_night,
            new \DateTime($validated['check_in']),
            new \DateTime($validated['check_out'])
        );

        return Inertia::render('Booking/ContactInformation', [
            'room' => $room,
            'booking' => $validated,
            'total' => $total,
        ]);
    }

    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        $room = Room::findOrFail($data['room_id']);
        $data['total_price'] = $this->service->priceForStay(
            (float)$room->price_per_night,
            new \DateTime($data['check_in']),
            new \DateTime($data['check_out'])
        );

        $booking = $this->bookings->create($data);

        return Inertia::render('Booking/Confirmation', [
            'reference' => $booking->reference,
            'summary' => [
                'room' => $room->only(['id','title','capacity','price_per_night']),
                'check_in' => $booking->check_in->toDateString(),
                'check_out' => $booking->check_out->toDateString(),
                'guests' => $booking->guests,
                'total_price' => $booking->total_price,
            ]
        ]);
    }

    public function cancel(string $reference)
    {
        $booking = $this->bookings->findByReference($reference);

        abort_unless($booking && $booking->user_id === auth()->id(), 403);

        $this->bookings->cancel($booking);

        return back()->with('success', 'Booking cancelled.');
    }
}
