<?php

namespace calendar_generator\Controllers;

class Main extends BaseController 
{
    public function index() 
    {
        $this->view('index');
    }
}