<?php

namespace Sherpa\Core\router\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class RouteAndCurrentHttpMethodsDoesNotMatchException extends SherpaException
{

    protected $message = "Given route is not defined for current HTTP method.";
    protected $code = "SHERPA_002_RTR";

}