<?php

namespace SIGA;

/**
 * Description of Models
 *
 * @author Claudio Campos
 */
class Models extends Model\Conn {

    protected $id = "id";
    protected $Tabela;

    public function findAll() {
        $this->Sql = "SELECT * FROM {$this->Tabela}";

        $this->stmt = $this->Connect->prepare($this->Sql);

        $this->stmt->execute();

        $this->Result = $this->stmt->fetchALL(\PDO::FETCH_ASSOC);
    }

    public function find() {
        $this->Sql ="SELECT * FROM {$this->Tabela} WHERE {$this->id} =:ID";
        
        $this->stmt = $this->Connect->prepare($this->Sql);
        
        $this->stmt->execute();
        
        $this->Result = $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBy(string $Where, string $Parses,$Limit=NULL,$OffSet=NULL) {
        //$this->Sql ="SELECT  "
    }

    public function findOneBy(string $Where, string $Parses,$Limit=NULL,$OffSet=NULL) {
        
    }

}
