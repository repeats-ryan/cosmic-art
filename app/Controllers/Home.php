<?php

namespace App\Controllers;

class Home extends BaseController
{
    public static $navigation = [
        '' => 'Home',
        'product' => 'Products',
        'about' => 'About',
    ];

    public function getIndex()
    {
        return view('home');
    }
}
