<?php

class BaseController
{

    protected function display($view)
    {
        require_once 'views/parts/header.php';
        require_once 'views/' . $view . '.php';
        require_once 'views/parts/footer.php';
    }

}