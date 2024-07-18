<?php

namespace Core;

class View
{
    protected $path;
    protected $data = [];

    public function __construct($path, $data = [])
    {
        $this->path = $path;
        $this->data = $data;
    }

    public function render()
    {
        if (file_exists($this->path)) {
            extract($this->data);
            ob_start();
            include $this->path;
            $content = ob_get_clean();
            echo $content;
        } else {
            throw new \Exception("View file not found: " . $this->path);
        }
    }

    public static function make($view, $data = [])
    {
        $path = __DIR__ . '/../views/' . $view . '.php';
        $instance = new self($path, $data);
        $instance->render();
    }
}
?>
