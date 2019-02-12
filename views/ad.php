<?php

/** @noinspection PhpUnhandledExceptionInspection */
/** @var \App\Ad $ad */

?>

<h1><?=htmlspecialchars($ad->getName())?></h1>
<p><?=htmlspecialchars($ad->getText())?></p>
<p><?=htmlspecialchars($ad->getPrice(\App\CurrencyConverter::RUB))?>руб</p>