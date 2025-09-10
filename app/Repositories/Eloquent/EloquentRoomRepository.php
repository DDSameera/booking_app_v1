<?php

namespace App\Repositories\Eloquent;

use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EloquentRoomRepository implements RoomRepositoryInterface
{
    public function searchAvailable(
        \DateTimeInterface $checkIn,
        \DateTimeInterface $checkOut,
        int $guests,
        int $perPage = 9
    ): LengthAwarePaginator {
        // A room is available if no overlapping booking exists
        // Overlap rule: (existing.check_in < requested.check_out) && (existing.check_out > requested.check_in)
        $q = Room::query()
            ->where('capacity', '>=', $guests)
            ->whereNotExists(function($sub) use ($checkIn, $checkOut) {
                $sub->select(DB::raw(1))
                    ->from('bookings')
                    ->whereColumn('bookings.room_id', 'rooms.id')
                    ->where('bookings.status', 'confirmed')
                    ->where('bookings.check_in', '<', $checkOut->format('Y-m-d'))
                    ->where('bookings.check_out', '>', $checkIn->format('Y-m-d'));
            })
            ->orderBy('price_per_night');

        return $q->paginate($perPage)->withQueryString();
    }

    public function findById(int $id) {
        return Room::findOrFail($id);
    }
}
