<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    public function searchAvailable(
        \DateTimeInterface $checkIn,
        \DateTimeInterface $checkOut,
        int $guests,
        int $perPage = 9
    ): LengthAwarePaginator;

    public function findById(int $id);
}
