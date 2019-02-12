<?php

namespace App\Legacy;

class Mysql
{
    /**
     * @param integer $id
     *
     * @return array
     */
    public function getAdRecord($id)
    {
        // пример ответа
        return [
            'id'       => $id,
            'name'     => 'AdName_FromMySQL',
            'text'     => 'AdText_FromMySQL',
            'keywords' => 'Some Keywords',
            'price'    => 10, // 10$
        ];
    }
}