<?php

namespace SIGA;

/**
 * Description of Controller
 *
 * @author Claudio Campos
 */
abstract class Controller {

    /**
     * Injeção das Configurações
     * @var object
     */
    public $configs = null;

    /**
     * Injeção do Http Request
     * @var object
     */
    private $request;

    /**
     * Injeção do Http Response
     * @var object
     */
    private $response;

    /**
     * Injeção da View
     * @var object
     */
    public $view;

    public function __construct(Config $configs = null) {
        //Injeção da VIEW
        $this->view = new View;
        $this->response = new Http\Response;

        if ($configs):
            $this->setConfigs($configs);
        endif;
    }

    /**
     * Injeta as configurações
     * @param  Config $configs Objeto com as configurações da aplicação
     * @return object
     */
    public function setConfigs(Config $configs): self {
        //Injeção das dependências
        $this->configs = $configs;
        $this->request = new Http\Request($configs->baseURI, $configs->controllers_directory);

        return $this;
    }

    /**
     * Default Action
     */
    public function indexAction() {
        
    }

    /**
     * Método mágico para atalho de objetos injetados na VIEW
     * @param  string $param Atributo
     * @return mixed         Conteúdo do atributo ou Exception
     */
    public function __get(string $param) {
        if (isset($this->view->$param)):
            return $this->view->$param;
        elseif (isset($this->$param)):
            return $this->$param;
        else:
            throw new \Exception("Parametro <$param> nao encontrado.", 1);
        endif;
    }
   
    /**
     * Redirecionamento
     * @param  string $route Link de redirecionamento
     * @param  string $controller Define o controller
     * @param  string $action Define action
     * @param  string $id Define o identificador
     */
    public function redirectTo(string $route, string $controller = "", string $action = "", $id = "") {
        $URL = sprintf("%s/%s", $this->configs->baseURL, $route);
        if (!empty($controller)):
            $URL = sprintf("%s/%s/%s", $this->configs->baseURL, $route, $controller);
        endif;
        if (!empty($controller) && !empty($action)):
            $URL = sprintf("%s/%s/%s/%s", $this->configs->baseURL, $route, $controller, $action);
        endif;
        if (!empty($controller) && !empty($action) && !empty($id)):
            $URL = sprintf("%s/%s/%s/%s/%s", $this->configs->baseURL, $route, $controller, $action, $id);
        endif;
        return $this->response->redirectTo($URL);
    }

}
