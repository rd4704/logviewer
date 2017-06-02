<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Rahul\Util\LogReader;

class HomeController
{
    public function index(Request $request)
    {
        $file = __DIR__ . '/../../../storage/logs/access_log';
        $data = LogReader::tail($file, 10, 0, LogReader::FIRST);
        $request->session()->put('logPos', $data['logPos']);

        return View::make(
            'welcome',
            [
                'logs' => $data['log'],
                'defaultFile' => '/storage/logs/access_log',
            ]
        );
    }

    public function fetchLog(Request $request)
    {
        $file = $request->input('file');
        $file = __DIR__ . '/../../../storage/logs/' . $file;
        $command = $request->input('seek');

        $currentPos = intval($request->session()->get('logPos'));

        $result = LogReader::tail($file, 10, $currentPos, $command);

        $request->session()->put('logPos', $result['logPos']);

        return json_encode($result);
    }
}
