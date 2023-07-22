<?php
use Smarty\Smarty;

class Controller
{
    protected $smarty;

    public function __construct()
    {
        $this->initializeSmarty();
    }

    private function initializeSmarty()
    {
        require_once(root . '/vendor/autoload.php');

        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir(app . 'view/templates');
        $this->smarty->setCompileDir(app . 'view/templates_c');
        $this->smarty->setCacheDir(app . 'view/cache');
        $this->assign("includePath", app . 'view/');
    }

    public function assign($name, $value)
    {
        $this->smarty->assign($name, $value);
    }

    public function display($template)
    {
        $this->smarty->display($template);
    }
}