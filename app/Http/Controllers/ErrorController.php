<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function showErrorAbort403()
    {
        return view('errors.403', 
        [
            'pageHeadings' => [
                'Page not found',
                'You do not have permission to access this page.'
            ]

        ]);
    }
}
