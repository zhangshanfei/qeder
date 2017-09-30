<?php

namespace app\modules\controllers;

use app\modules\controllers\BaseController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    protected $mustlogin = ['index'];
    public function actionIndex()
    {
        return $this->render('index');
    }
}
