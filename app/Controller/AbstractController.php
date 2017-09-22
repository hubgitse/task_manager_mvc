<?php

namespace app\Controller;

use app\Lib\Registry;
use app\Lib\View;

/**
 * Class AbstractController.
 */
abstract class AbstractController
{
    /**
     * @param $templateName
     * @param array $params
     */
    protected function renderView($templateName, array $params = [])
    {
        /** @var View $view */
        $view = Registry::get('view');

        $view->renderView($templateName, $params);
    }

    protected function redirect($url)
    {
        header(sprintf('Location: %s', $url));
        exit;
    }
}