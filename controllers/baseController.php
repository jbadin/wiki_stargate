<?php
require_once 'ressources/errors.php';

class BaseController
{
    public array $errors = [];
    public string $formSuccess = '';

    public function display($view): void
    {
        require_once 'views/parts/header.php';
        require_once 'views/' . $view . '.php';
        require_once 'views/parts/footer.php';
    }

}