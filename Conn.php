<?php

namespace SIGA\Model;

/**
 * Description of Conn
 *
 * @author Claudio Campos
 */
abstract class Conn {

    private $Host;
    private $User;
    private $Pass;
    private $Db;

    /**
     * $Connect
     * @var \PDO
     */
    protected $Connect = NULL;

    /**
     * $stmt
     * @var \PDOStatement 
     */
    protected $stmt;
    protected $Sql;
    protected $Result;
    protected $Plases;

    public function __construct(\SIGA\Config $configs) {
        $this->Host = $configs->dbHost;
        $this->User = $configs->dbUser;
        $this->Pass = $configs->dbPass;
        $this->Db = $configs->dbDb;
        $this->Conectar();
    }

    private function Conectar() {
        try {
            if ($this->connect == NULL):
                $dsn = sprintf("mysql:host=%s;dbname=%s", $this->Host, $this->Db);
                $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                $this->connect = new \PDO($dsn, $this->User, $this->Pass, $options);
                $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            endif;
        } catch (\PDOException $exc) {
            throw new \PDOException(\SIGA\Utils::dump([$exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine()]));
        }
    }

    public function getResult() {
        return $this->Result;
    }

    public function setParses(string $ParsesString) {
        parse_str($ParsesString, $this->Plases);
        return $this->Plases;
    }

    public function getSyntax() {
        if ($this->Plases):
            foreach ($this->Plases as $key => $value) {
                $this->stmt->bindValue(":{$key}", $value, (is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
            }
        endif;
    }

}
