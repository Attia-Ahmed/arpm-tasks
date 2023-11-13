<?php

namespace Controllers;

class PageController
{
    public function home()
    {
        $this->renderView('the homepage');
    }

    public function folder($folder)
    {
        $this->renderView($folder);
    }

    private function renderView($content)
    {
        require_once __DIR__.'/../Views/view.php';
    }
}