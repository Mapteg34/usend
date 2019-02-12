<?php

namespace App\Legacy;

class Daemon
{
    /**
     * @param $id
     *
     * Возвращает строку, разделенную табуляциями
     * где колонки:
     * 0. id - объявления
     * 1. id - кампании
     * 2. id - пользователя
     * 3. название объявления
     * 4. текст объявления
     * 5. стоимость объявления в $
     *
     * @return string
     */
    public function get_deamon_ad_info($id)
    {
        // пример ответа: строка разделенная табуляцией
        return "{$id}\t235678\t12348\tAdName_FromDaemon\tAdText_FromDaemon\t11";
    }
}