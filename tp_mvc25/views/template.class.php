<?php
class Template {

    protected $content = "";

    public function __construct($file) {

        if (!file_exists($file)) {
            die("Template file not found: " . $file);
        }

        $this->content = file_get_contents($file);
    }

    public function replace($placeholder, $value) {
        $this->content = str_replace($placeholder, $value, $this->content);
    }

    public function write() {
        echo $this->content;
    }
}
