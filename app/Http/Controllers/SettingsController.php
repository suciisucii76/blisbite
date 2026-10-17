<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function theme()
    {
        return view('settings.theme', [
            'title' => 'Theme Settings',
        ]);
    }
}
