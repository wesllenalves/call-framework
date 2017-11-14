<?php

namespace SIGA\Services;

/**
 * Description of Container
 *
 * @author Claudio Campos
 */
class Container {

    public static function getModel($class) {
           return new $class();
    }

}
