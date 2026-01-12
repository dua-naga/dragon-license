<?php

namespace DuaNaga\DragonLicense\Helpers;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class FinalInstallManager
{
    /**
     * Run final commands.
     *
     * @return string
     */
    public function runFinal()
    {
        $outputLog = new BufferedOutput;

        $this->generateKey($outputLog);
        $this->publishVendorAssets($outputLog);

        return $outputLog->fetch();
    }

    /**
     * Generate New Application Key.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return \Symfony\Component\Console\Output\BufferedOutput|array
     */
    private static function generateKey(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('key:generate', ['--force' => true], $outputLog);
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Publish vendor assets.
     *
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return \Symfony\Component\Console\Output\BufferedOutput|array
     */
    private static function publishVendorAssets(BufferedOutput $outputLog)
    {
        try {
            Artisan::call('vendor:publish', ['--all' => true], $outputLog);
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private static function response($message, BufferedOutput $outputLog)
    {
        return [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}
