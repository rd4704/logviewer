<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Rahul\Util\LogReader;

class HomeController
{
    public function index()
    {
        $file = __DIR__ . '/../../../storage/logs/laravel.log';


        return View::make('welcome', ['logs' => LogReader::tail($file)]);

    }
}
