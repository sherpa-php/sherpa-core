<?php

namespace Sherpa\Core\controllers;

class Controller
{

    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

}