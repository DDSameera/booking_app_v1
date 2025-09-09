<?php

namespace App\Services;

use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Carbon\Carbon;

class BookingService
{
    public function __construct(
        private BookingRepositoryInterface $bookings,
        private RoomRepositoryInterface $rooms
    ) {}

    public function priceForStay(float $pricePerNight, \DateTimeInterface $checkIn, \DateTimeInterface $checkOut): float
    {
        $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
        $nights = max($nights, 1);
        return round($nights * $pricePerNight, 2);
    }
}
