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
        $file = $request->input('file');
        $file = __DIR__ . '/../../../storage/logs/' . $file;
        $offset = intval($request->input('offset'));

        if ($offset === 0) {
            $gotoOffset = 0;
        } elseif ($offset === -1) {
            $gotoOffset = -1;
        } else {
            $gotoOffset = intval($request->session()->get('logPos')) + $offset;
        }

        $request->session()->put('logPos', $gotoOffset);

        return json_encode(LogReader::tail($file, 10, $gotoOffset));
    }
}
