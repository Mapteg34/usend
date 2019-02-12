<?php

namespace App\Adapters;

use App\Legacy\FileLogger;
use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class FileLoggerAdapter extends AbstractLogger implements LoggerInterface
{
    private $enabled;
    private $fileLogger;

    public function __construct(bool $enabled)
    {
        $this->enabled = $enabled;

        if ($this->enabled) {
            $this->fileLogger = new FileLogger('/path/to/file');
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        if (!defined(LogLevel::class.'::'.strtoupper($level))) {
            throw new InvalidArgumentException('level '.$level.' no supported');
        }

        $message = (string)$message;

        if (!$this->enabled) {
            return;
        }

        $this->fileLogger->log(date('c').' ['.$level.'] '.$message);
    }
}