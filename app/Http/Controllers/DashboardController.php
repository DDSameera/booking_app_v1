<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookingRepositoryInterface;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(private BookingRepositoryInterface $bookings) {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        $items = $this->bookings->byUser(auth()->id());

        return Inertia::render('Dashboard/Index', [
            'bookings' => $items
        ]);
    }
}
