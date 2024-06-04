<?php

namespace App\Controllers;

use App\Models\FilmModel;

class Home extends BaseController
{
    public function index()
    {
        $filmModel = new FilmModel();
        $data['films'] = $filmModel->findAll();
        echo view('templates/header', $data);
        echo view('home', $data);
        echo view('templates/footer');
    }
}
