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
        $result = LogReader::tail($path, $logpos, 0);

        $this->assertEquals(preg_replace('/\s+/S', " ", $lines), preg_replace('/\s+/S', " ", $result['log']));

        $this->assertEquals($logpos, $result['logPos']);
    }

    public function provideSampleLogData()
    {
        $expectedLog = '10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-spam.1month.png HTTP/1.1" 200 2651
    10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-spam-ratio.1month.png HTTP/1.1" 200 2023
    10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-hashes.1month.png HTTP/1.1" 200 1636
    10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-spam.1year.png HTTP/1.1" 200 2262
    10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-spam-ratio.1year.png HTTP/1.1" 200 1906
    10.0.0.153 - - [12/Mar/2004:12:23:41 -0800] "GET /dccstats/stats-hashes.1year.png HTTP/1.1" 200 1582
    216.139.185.45 - - [12/Mar/2004:13:04:01 -0800] "GET /mailman/listinfo/webber HTTP/1.1" 200 6051
    pd95f99f2.dip.t-dialin.net - - [12/Mar/2004:13:18:57 -0800] "GET /razor.html HTTP/1.1" 200 2869
    d97082.upc-d.chello.nl - - [12/Mar/2004:13:25:45 -0800] "GET /SpamAssassin.html HTTP/1.1" 200 7368
    ';

        return [
            [
                'path' => __DIR__ . '/../../storage/logs/access_log',
                'logPos' => 10,
                'lines' => $expectedLog,
            ],
        ];
    }
}
