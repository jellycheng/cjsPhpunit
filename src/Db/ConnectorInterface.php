<?php
namespace CjsPhpunit\Db;

interface ConnectorInterface {

    /**
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config);

}