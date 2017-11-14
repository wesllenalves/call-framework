<?php

namespace App\Home\Controllers;

/**
 * Description of IndexController
 *
 * @author Claudio Campos
 */
class IndexController extends \App\Base\Controllers\AbstractController {
    public function __construct(\SIGA\Config $configs = null) {
        parent::__construct($configs);
    }
    public function indexAction() {
         //$this->view->layout="login";
        return parent::indexAction();
    }
}
