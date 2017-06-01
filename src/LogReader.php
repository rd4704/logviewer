<?php

namespace Rahul\Util;

use SplFileObject;

class LogReader
{
    /**
     * @param $filename
     * @param int $lines
     * @param int $offset
     *
     * @return bool|array
     */
    public static function tail($filename, $lines = 10, $offset = 0)
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

        // Seek to end of file minus line offsets
        $fileHandler->seek(count(file($filename)) - ($lines + $offset));

        // Append each line to the output
        $output = '';
        for ($i = 1; $i < $lines; $i++) {
            $fileHandler->next();
            $output .= $fileHandler->current();
        }

        // close file
        $fileHandler = null;

        return ['log' => $output, 'logPos' => $offset + $lines];
    }
}
