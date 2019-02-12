<?php

namespace App\Adapters;

use App\Ad;

interface AdRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Ad
     */
    public function get(int $id): Ad;
}