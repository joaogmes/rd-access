<?php

class Test extends Controller
{
    public function index($str)
    {
        $this->assign('x', $str);
        $this->display('index.tpl');
        return $str;
    }
}
