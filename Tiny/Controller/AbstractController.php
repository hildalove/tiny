<?php

namespace Tiny\Controller;


use Tiny\Config\Application;

class AbstractController
{
    protected $data;
    protected $controller_name;
    protected $view_name;
    protected $template_dir;

    function __construct($controller_name, $view_name)
    {
        $this->controller_name = $controller_name;
        $this->view_name = $view_name;
        $this->template_dir = Application::getInstance()->baseDir.'templates';
    }

    function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    function __destruct()
    {
        if (empty($file))
        {
            $file = strtolower($this->controller_name).'/'.$this->view_name.'.php';
        }
        $path = $this->template_dir.'/'.$file;
        if (file_exists($path)) {
            if (!empty($this->data)) {
                extract($this->data);
            }
            include $path;
        }
    }
}