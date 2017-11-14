<?php

namespace App\Admin\Controllers;

use App\Admin\Models\{Users};

/**
 * Description of IndexController
 *
 * @author Claudio Campos
 */
class IndexController extends \App\Base\Controllers\AbstractController {

    public function __construct(\SIGA\Config $configs = null) {
        parent::__construct($configs);
        $this->model = Users::class;
    }

}
