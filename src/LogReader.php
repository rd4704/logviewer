<?php

namespace Rahul\Util;

use SplFileObject;

class LogReader
{
    /*
     * Constants
     */
    const PREV = 'prev';
    const NEXT = 'next';
    const FIRST = 'first';
    const LAST = 'last';

    /**
     * @param $filename
     * @param int $lines
     * @param int $currentPos
     * @param string $command
     *
     * @return array|bool
     */
    public static function head($filename, $lines = 10, $currentPos = 0, $command = self::NEXT)
    {
        // Check if file exists
        if (!is_file($filename)) {
            return false;
        }

        // return if unable to open file
        $fileHandler = fopen($filename, "rb");
        if (!$fileHandler) {
            return false;
        }

        $fileHandler = new SplFileObject($filename);

        switch ($command) {
            case self::PREV:
                $currentPos -= $lines;
                break;
            case self::NEXT:
                $currentPos += $lines;
                break;
            case self::LAST:
                $currentPos = count(file($filename)) - $lines;
                break;
            default:
                $currentPos = 0;
                break;
        }

        $fileHandler->seek($currentPos !== 0 ? $currentPos - 1 : $currentPos);

        // Append each line to the output
        $output = '';
        for ($i = 0; $i < $lines; $i++) {
            $fileHandler->next();
            $output .= $fileHandler->current();
        }

        $isEOF = (count(file($filename)) - $lines) <= $currentPos;

        // close file
        $fileHandler = null;

        return ['log' => $output, 'logPos' => $currentPos, 'isEOF' => $isEOF];
    }
}
