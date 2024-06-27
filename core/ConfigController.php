<?php

namespace Core;

use Error;
use Exception;

class ConfigController extends Config
{

    private array $url;
    private string $urlController;
    private string $urlMethod;
    private ?array $urlParameters = null;

    public function __construct()
    {

        Config::__construct();

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL))) {
            $this->url = explode("/", filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL));

            if (isset($this->url[0]) and isset($this->url[1])) {
                $this->urlController = ucwords($this->url[0]);
                $this->urlMethod = (!empty($this->url[1])) ? $this->url[1] : "index";
                $this->urlParameters = filter_input_array(INPUT_GET);
                unset($this->urlParameters['url']);
            } else {
                $this->urlController = "Error";
                $this->urlMethod = "index";
            }
        } else {
            $this->urlController = "Home";
            $this->urlMethod = "index";
        }

        // var_dump($this->urlController);
        // var_dump($this->urlMethod);

    }

    public function loadPage()
    {
        $classLoad = "\\Adm\Controllers\\" . $this->urlController;
        try {
            $classPage = new $classLoad();
            $classPage->{$this->urlMethod}($this->urlParameters);
            // var_dump($classPage);
        } catch (Error $err) {
            // die($err);
            $classLoad = "\\Adm\Controllers\\" . "NotFound";
            $classPage = new $classLoad();
            $classPage->index();
        }
    }

}