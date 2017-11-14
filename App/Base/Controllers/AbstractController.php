<?php

namespace App\Base\Controllers;

use SIGA\Services\Container;

/**
 * Description of AbstractController
 *
 * @author Claudio Campos
 */
class AbstractController extends \SIGA\Controller {

    protected $model;
    protected $repository;
    protected $create;
    protected $update;
    protected $delete;
    protected $parseString = "";
    protected $places = "";
    protected $form;
    protected $data;
    protected $route;
    protected $controller;
    protected $action;
    protected $layout;

    public function indexAction() {
        if ($this->model):
            $this->repository = Container::getModel($this->model);
            $data = $this->repository->getRead();
            $data->ExeRead($this->parseString, $this->places);
            $this->view->setVars($data);
        endif;
    }

    public function createAction() {
        $this->create = Container::getModel($this->model);
        $data = $this->create->getCreate();
        $data->ExeCreate($this->data);
        $this->view->setVars($data);
    }

    public function editAction() {
        $this->update = Container::getModel($this->model);
        $data = $this->update->getUpdate();
        $Client = ["name" => "Claudio Coelho De Campos", "email" => "contato@gmail.com"];
        $data->ExeUpdate($Client, " WHERE id=:id", "id=1");
        $this->view->setVars($data);
    }

    public function deleteAction() {
        $id = $this->request->getParam(3);
        if ((int) $id):
            $this->delete = Container::getModel($this->model);
            $data = $this->delete->getDelete();
            $data->ExeDelete(" WHERE id=:id", "id={$id}");
            $this->view->setVars($data);
        endif;
        $this->redirectTo($this->route, $this->controller);
    }

}
