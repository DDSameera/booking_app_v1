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

    public function __invoke()
    {
        $items = $this->bookings->byUser(auth()->id());

        return Inertia::render('Dashboard/Index', [
            'bookings' => $items,
        ]);
    }
}
