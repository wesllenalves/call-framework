<?php

namespace App\Admin\Controllers;

/**
 * Description of ClientsController
 *
 * @author Claudio Campos
 */
class ClientsController extends \App\Base\Controllers\AbstractController {
    
    public function __construct(\SIGA\Config $configs = null) {
        parent::__construct($configs);
        $this->model = \App\Admin\Models\Clients::class;
        $this->route = "admin";
        $this->controller = "clients";
    }
    public function createAction() {
        $this->data = ['name'=>'Maria Da Gloria',"email"=>"maria@hotmail.com"];
        parent::createAction();
    }
}
