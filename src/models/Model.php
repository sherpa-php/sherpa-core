<?php

namespace Sherpa\Core\models;

class Model
{

    protected array $public;
    protected array $private;

    public function __construct()
    {
        $this->public = [];
        $this->private = [];
    }

}