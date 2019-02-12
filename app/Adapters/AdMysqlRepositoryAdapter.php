<?php

namespace App\Adapters;

use App\Ad;
use App\Legacy\Mysql;

class AdMysqlRepositoryAdapter implements AdRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Ad
     * @throws \Exception
     */
    public function get(int $id) : Ad
    {
        $repository = new Mysql();
        $ad         = $repository->getAdRecord($id);
        logger()->debug('getAdRecord(ID='.$id.')');

        if (empty($ad)) {
            throw new \Exception('Legacy mysql ad empty');
        }

        return new Ad($id, $ad['name'], $ad['text'], $ad['price']);
    }
}