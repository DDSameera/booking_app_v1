<?php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class EloquentBookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        $data['reference'] = $data['reference'] ?? Str::upper(Str::random(10));
        return Booking::create($data);
    }

    public function byUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Booking::with('room')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function cancel(Booking $booking): Booking
    {
        $booking->update(['status' => 'cancelled']);
        return $booking;
    }

    public function findByReference(string $reference): ?Booking
    {
        return Booking::with('room')->where('reference', $reference)->first();
    }
}
