<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('beranda', $data);
    }

    //--------------------------------------------------------------------
}
