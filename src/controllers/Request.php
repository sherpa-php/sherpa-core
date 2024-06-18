<?php

namespace Sherpa\Core\controllers;

class Request
{
    private array $parameters;
    private array $inputs;

    public function __construct(bool $neutralizeInputs = true)
    {
        $this->initializeParameters();
        $this->initializeInputs($neutralizeInputs);
    }

    /**
     * Initialize new parameters array with
     * current request GET parameters.
     */
    private function initializeParameters(): void
    {
        $this->parameters = [];

        foreach ($_GET as $key => $value)
        {
            $this->parameters[$key] = $value;
        }
    }

    /**
     * Initialize new inputs array with
     * current request POST inputs.
     *
     * @param bool $neutralize If inputs must be neutralized
     */
    private function initializeInputs(bool $neutralize = true): void
    {
        $this->inputs = [];

        foreach ($_POST as $key => $value)
        {
            $input = $neutralize
                ? htmlspecialchars($value)
                : $value;

            $this->inputs[$key] = $input;
        }
    }

    /**
     * @return array Request GET parameters
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $key Request GET parameter key
     * @return bool If request has this key as GET parameter key
     */
    public function hasParameter(string $key): bool
    {
        return isset($this->getParameters()[$key]);
    }

    /**
     * @return array Prepared request POST parameters
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }

    /**
     * @param string $key Request POST input key
     * @return bool If request has this key as POST input key
     */
    public function hasInput(string $key): bool
    {
        return isset($this->inputs[$key]);
    }

}