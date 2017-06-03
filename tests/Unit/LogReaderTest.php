<?php
namespace Tests\Unit;

use Rahul\Util\LogReader;
use Tests\TestCase;

class LogReaderTest extends TestCase
{
    /**
     * Test case for LogReader tail function.
     *
     * @dataProvider provideSampleLogData
     *
     * @param $path
     * @param $logpos
     * @param $lines
     *
     * @test
     */
    public function shouldReturnCorrectLogAndLinePosition($path, $logpos, $lines)
    {
        $result = LogReader::head($path, $logpos, 0);

        $this->assertEquals(preg_replace('/\s+/S', " ", $lines), preg_replace('/\s+/S', " ", $result['log']));

        $this->assertEquals($logpos, $result['logPos']);
    }

    public function provideSampleLogData()
    {
        $expectedLog = '64.242.88.10 - - [07/Mar/2004:16:32:50 -0800] "GET /twiki/bin/view/Main/WebChanges HTTP/1.1" 200 40520
                        64.242.88.10 - - [07/Mar/2004:16:33:53 -0800] "GET /twiki/bin/edit/Main/Smtpd_etrn_restrictions?topicparent=Main.ConfigurationVariables HTTP/1.1" 401 12851
                        64.242.88.10 - - [07/Mar/2004:16:35:19 -0800] "GET /mailman/listinfo/business HTTP/1.1" 200 6379
                        64.242.88.10 - - [07/Mar/2004:16:36:22 -0800] "GET /twiki/bin/rdiff/Main/WebIndex?rev1=1.2&rev2=1.1 HTTP/1.1" 200 46373
                        64.242.88.10 - - [07/Mar/2004:16:37:27 -0800] "GET /twiki/bin/view/TWiki/DontNotify HTTP/1.1" 200 4140
                        64.242.88.10 - - [07/Mar/2004:16:39:24 -0800] "GET /twiki/bin/view/Main/TokyoOffice HTTP/1.1" 200 3853
                        64.242.88.10 - - [07/Mar/2004:16:43:54 -0800] "GET /twiki/bin/view/Main/MikeMannix HTTP/1.1" 200 3686
                        64.242.88.10 - - [07/Mar/2004:16:45:56 -0800] "GET /twiki/bin/attach/Main/PostfixCommands HTTP/1.1" 401 12846
                        64.242.88.10 - - [07/Mar/2004:16:47:12 -0800] "GET /robots.txt HTTP/1.1" 200 68
                        64.242.88.10 - - [07/Mar/2004:16:47:46 -0800] "GET /twiki/bin/rdiff/Know/ReadmeFirst?rev1=1.5&rev2=1.4 HTTP/1.1" 200 5724
                        ';

        return [
            [
                'path' => __DIR__ . '/../../storage/logs/access_log',
                'logPos' => 10,
                'lines' => $expectedLog,
            ],
            [
                'path' => 'invalid/path',
                'logPos' => 0,
                'lines' => false
            ]
        ];
    }
}
