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

        $request->session()->put('logPos', 0);

        return View::make(
            'welcome',
            [
                'logs' => LogReader::tail($file, 10, 0)['log'],
                'defaultFile' => '/storage/logs/access_log',
            ]
        );
    }

    public function fetchLog(Request $request)
    {
        $offset = intval($request->input('offset'));
        $file = $request->input('file');
        $file = __DIR__ . '/../../../storage/logs/' . $file;

        $currentLogPos = intval($request->session()->get('logPos'));
        $request->session()->put('logPos', $currentLogPos + $offset);

        return json_encode(LogReader::tail($file, 10, $currentLogPos + $offset));
    }
}
