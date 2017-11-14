 <?php

namespace SIGA;

/**
 * Description of View
 *
 * @author Claudio Campos
 */
class View {

    protected $configs;
    protected $view;
    protected $subfolder;
    private $controller;
    private $action;
    public $layout="layout";
    public $vars=null;

    public function __construct() {
        $this->view = new \stdClass;
    }

    public function render(Config $configs, $subfolder, $controller, $action, $layout = true) {
        /**
         * Tratamento das variáveis
         */
        $this->configs = $configs;
        $this->subfolder = $subfolder;
        $this->controller = strtolower(str_replace(['App', 'Controllers', 'Controller', $this->subfolder, '\\'], '', $controller));
        $this->action =  $action;
        $this->action = str_replace('Action', '', $this->action);
        if ("error404" == $this->controller):
            $this->subfolder = "Base";
            $this->action = "404";
        endif;
        if ($layout && file_exists(sprintf('%s/App/Base/views/layout/%s.phtml', ROOT_PATH, $this->layout))):
            include_once sprintf('%s/App/Base/views/layout/%s.phtml', ROOT_PATH, $this->layout);
        else:
            $this->content();
        endif;
    }

    public function content() {
        include_once sprintf('%s/App/%s/views/%s/%s.phtml', ROOT_PATH, $this->subfolder, $this->controller, $this->action);
    }
    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
    }
    public function getVars() {
        return $this->vars;
    }

    public function setVars($vars) {
        $this->vars = $vars;
    }



}
