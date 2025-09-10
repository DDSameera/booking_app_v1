<?php

namespace App\Repositories\Contracts;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;

    public function byUser(int $userId, int $perPage = 10): LengthAwarePaginator;

    public function cancel(Booking $booking): Booking;

    public function findByReference(string $reference): ?Booking;

    public function pastByUser(?int $userId, int $perPage = 10);
    public function upcomingByUser(?int $userId, int $perPage = 10);

    public function cancelledByUser(?int $userId, int $perPage = 10);


}
