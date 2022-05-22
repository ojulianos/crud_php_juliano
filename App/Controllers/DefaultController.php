<?php

namespace App\Controllers;

use Core\BaseController;


class DefaultController extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $this->view(
            'default/index'
        );
    }

}