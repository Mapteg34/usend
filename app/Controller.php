<?php

namespace App;

class Controller
{
    /**
     * @return string
     * @throws \Exception
     */
    public function fetch()
    {
        // валидации тут быть не должно, нужно принимать Request в котором и осуществляется предвалидация
        if (!isset($_GET['id']) || !isset($_GET['from'])) {
            throw new \Exception('Invalid params: id and from required');
        }

        $id = intval($_GET['id']);

        if (!$id) {
            throw new \Exception('Invalid id');
        }

        $from = trim($_GET['from']);
        if (!$from) {
            throw new \Exception('Invalid from');
        }

        // репозиторий тоже по хорошему должен из сервис-провайдера приходить
        $factory    = new AdRepositoryFactory();
        $repository = $factory->make($from);
        $ad         = $repository->get($id);

        return view('ad', [ // можно и compact, вот только гторм его пока не уметь
            'ad'=>$ad,
        ]);
    }

}