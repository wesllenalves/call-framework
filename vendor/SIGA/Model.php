<?php

namespace SIGA;

/**
 * Description of Model
 *
 * @author Claudio Campos
 */
class Model {
    /** Read  */

    /** @var Services\Read */
    protected $Read;

    /** Create */

    /** @var Services\Create */
    protected $Create;

    /** Update */

    /** @var Services\Update */
    protected $Update;

    /** Delete */

    /** @var Services\Delete */
    protected $Delete;
    
     protected $Tabela;

    /**
     * ****************************************
     *     *********** READ ************
     * ****************************************
     */
    public function getRead() : Services\Read {
        $this->Read = new Services\Read();
        $this->Read->Tabela= $this->Tabela;
        return $this->Read;
    }

    /**
     * ****************************************
     *    *********** CREATE ************
     * ****************************************
     */
    public function getCreate(): Services\Create {
        $this->Create = new Services\Create();
        $this->Create->Tabela = $this->Tabela;
        return $this->Create;
    }

    /**
     * ****************************************
     *    *********** UPDATE ************
     * ****************************************
     */
    public function getUpdate(): Services\Update {
        $this->Update = new Services\Update();
        $this->Update->Tabela= $this->Tabela;
        return $this->Update;
    }

    /**
     * ****************************************
     *    *********** DELETE ************
     * ****************************************
     */
    
    public function getDelete(): Services\Delete {
        $this->Delete = new Services\Delete();
        $this->Delete->Tabela= $this->Tabela;
        return $this->Delete;
    }


}
