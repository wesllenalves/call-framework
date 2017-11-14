<?php

namespace App\Admin\Controllers;

/**
 * Description of ProductsConttroller
 *
 * @author Claudio Campos
 */
class ProductsController extends \App\Base\Controllers\AbstractController {
   
    public function __construct(\SIGA\Config $configs = null) {
        parent::__construct($configs);
        $this->model = \App\Admin\Models\Products::class;
    }
    
    public function createAction() {
        $this->data= ['title'=>"Batata Doce","name"=>"batata-doce","prod_desc"=>"Saco De 50 Kilos"];
        parent::createAction();
    }
}
