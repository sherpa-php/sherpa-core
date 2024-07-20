<?php

namespace Sherpa\Core\controllers;

use Sherpa\Core\router\HttpMethod;
use Sherpa\Core\router\Route;
use Sherpa\Core\router\Router;

class Request
{
    private const CSRF_TOKEN_INPUT_KEY = "csrf";

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
     * @return string|null Parameter value if exists or NULL
     */
    public function getParameter(string $key): ?string
    {
        return $this->hasParameter($key)
            ? $this->getParameters()[$key]
            : null;
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
     * @return mixed Input value if exists or NULL
     */
    public function getInput(string $key): mixed
    {
        return $this->hasInput($key)
            ? $this->getInputs()[$key]
            : null;
    }

    /**
     * @param string $key Request POST input key
     * @return bool If request has this key as POST input key
     */
    public function hasInput(string $key): bool
    {
        return isset($this->inputs[$key]);
    }

    /**
     * @return string|null Request CSRF token if exists or NULL
     */
    public function getCSRFToken(): ?string
    {
        return $this->getInput(self::CSRF_TOKEN_INPUT_KEY);
    }

    /**
     * @return bool If request has CSRF token
     */
    public function hasCSRFToken(): bool
    {
        return $this->hasInput(self::CSRF_TOKEN_INPUT_KEY);
    }

}