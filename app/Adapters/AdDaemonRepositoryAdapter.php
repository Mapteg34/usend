<?php

namespace App\Adapters;

use App\Ad;
use App\Legacy\Daemon;

class AdDaemonRepositoryAdapter implements AdRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Ad
     * @throws \Exception
     */
    public function get(int $id): Ad
    {
        $repository = new Daemon();
        $ad         = $repository->get_deamon_ad_info($id);
        logger()->debug('get_deamon_ad_info(ID='.$id.')');

        if (empty($ad)) {
            throw new \Exception('Legacy mysql ad empty');
        }

        $ad = explode("\t", $ad);

        return new Ad($id, $ad[3], $ad[4], $ad[5]);
    }
}