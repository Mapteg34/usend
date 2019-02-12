<?php

use App\Adapters\FileLoggerAdapter;
use Psr\Log\LoggerInterface;

if (!function_exists('config')) {
    /**
     * @return stdClass
     */
    function config(): stdClass
    {
        static $config = null;

        if ($config === null) {
            $config = new stdClass();

            // похорошему значения надо брать из config.php, который уже часть будет брать из env
            $config->logEnabled = getenv('LOG_ENABLED') == 1;
            $config->logger     = FileLoggerAdapter::class;
        }

        return $config;
    }
}

if (!function_exists('logger')) {
    /**
     * @return \Psr\Log\LoggerInterface
     */
    function logger(): LoggerInterface
    {
        static $logger = null;

        if ($logger === null) {
            $loggerClass = config()->logger;
            $logger      = new $loggerClass(config()->logEnabled);
        }

        return $logger;
    }
}

if (!function_exists('view')) {
    /**
     * @param string $viewFileName
     * @param array $data
     *
     * @return string (HTML)
     */
    function view(string $viewFileName, array $data = array()): string
    {
        $viewFileName = str_replace('/', '_', $viewFileName);
        extract($data);

        ob_start();
        /** @noinspection PhpIncludeInspection */
        include(__DIR__.'/../views/'.$viewFileName.'.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}