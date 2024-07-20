<?php

namespace Sherpa\Core\middlewares;

use Sherpa\Core\controllers\Request;

abstract class Middleware
{

    abstract public function handle(Request $request);

    protected function finish()
    { }

}