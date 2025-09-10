<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookingRepositoryInterface;
use Inertia\Inertia;

class DashboardController extends Controller
{
    private BookingRepositoryInterface $bookings;

    public function __construct(BookingRepositoryInterface $bookings)
    {
        $this->bookings = $bookings;

    }

    public function index()
    {
        $userId = NULL;  //Assume All users are guest

        return Inertia::render('Dashboard/Index', [
            'past' => $this->bookings->pastByUser($userId) ?? collect([]),
            'upcoming' => $this->bookings->upcomingByUser($userId) ?? collect([]),
            'cancelled' => $this->bookings->cancelledByUser($userId) ?? collect([]),
        ]);
    }
}
