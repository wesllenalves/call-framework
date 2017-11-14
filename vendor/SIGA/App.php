<?php

namespace SIGA;

/**
 * Description of App
 *
 * @author Claudio Campos
 */
class App {

    /**
     * Injeção das configurações
     * @var object
     */
    public $controllers_directory;
    public $controllers_notFound;
    public $configs;

    /**
     * Injeção do Request
     * @var object
     */
    public $request;

    /**
     * Injeção do Response
     * @var object
     */
    public $response;

    /**
     * Método Construtor
     */
    public function __construct(Config $configs) {
        $this->controllers_directory = str_replace("/", DS, sprintf('%s/%s/Controllers', APP_PATH, "%s"));
        $this->controllers_notFound = 'Error404Controller';
        $this->configs = $configs;
        $this->configs->controllers_directory= $this->controllers_directory;
        $this->request = new Http\Request($configs->baseURI, $this->controllers_directory, $this->controllers_notFound);
        $this->response = new Http\Response;
    }

    /**
     * Executa a aplicação
     */
    public function run() {
        /**
         * Variáveis
         */
        $subfolder = $this->request->subfolder . DS;
        $controller = sprintf("%s%s", $this->request->namespace, $this->request->controller);
        $namespace = $this->request->namespace;
        $action = $this->request->action;
        $controllersDir = sprintf($this->controllers_directory, $subfolder);
        $this->controllers_directory = $controllersDir;
        $notFoundController = $this->controllers_notFound;
        /**
         * Caminho do controller
         * @var string
         */
        $controllerFile = sprintf("%s.php", $controller);
        $notFoundControllerFile = str_replace($this->request->controller, $notFoundController, $controllerFile);
        if (!file_exists(sprintf("%s/%s", ROOT_PATH, $controllerFile))):
            //Inclusão do Controller
            require_once(sprintf("%s/%s", ROOT_PATH, $notFoundControllerFile));
        else:
            //Inclusão do Controller
            require_once(sprintf("%s/%s", ROOT_PATH, $controllerFile));
            //Verifica se a classe correspondente ao Controller existe
            if (!class_exists($controller)) {
                require_once($notFoundControllerFile);
                $controller = sprintf("%s%s", $namespace, $notFoundController);
            }
        endif;
        $app = new $controller($this->configs);
        //Verifica se a Action requisitada não existe
        if (!method_exists($app, $action)):
            throw new \Exception("U Função <$action> nao encontrado no controller {$controller}.", 1);
        endif;
        //Injeção das configurações
        $app->setConfigs($this->configs);
        /**
         * Atribuição de parâmetros
         */
        call_user_func_array([&$app, $action], $this->request->params);
        $app->view->render($this->configs, $this->request->subfolder, $controller, $action);
    }

}
