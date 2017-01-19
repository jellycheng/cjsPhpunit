<?php
namespace CjsPhpunit\Db;

use PDO;
class MySqlConnector implements ConnectorInterface {

    protected $options = array(
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public function __construct()
    {

    }

    public static function create()
    {
        return new static();
    }

    /**
     * @param  array  $config
     * @return array
     */
    public function getOptions(array $config)
    {
        $options = \CjsPhpunit\array_get($config, 'options', array());
        return array_diff_key($this->options, $options) + $options;
    }

    /**
     * @param  string  $dsn
     * @param  array   $config
     * @param  array   $options
     * @return \PDO
     */
    public function createConnection($dsn, array $config, array $options)
    {
        $username = \CjsPhpunit\array_get($config, 'username');
        $password = \CjsPhpunit\array_get($config, 'password');
        return new PDO($dsn, $username, $password, $options);
    }

    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->options;
    }

    /**
     * @param  array  $options
     * @return void
     */
    public function setDefaultOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config)
    {
        $dsn = $this->getDsn($config);
        $options = $this->getOptions($config);
       $connection = $this->createConnection($dsn, $config, $options);
        if (isset($config['unix_socket']))
        {
            $connection->exec("use `{$config['database']}`;");
        }
        $collation = $config['collation'];
        $charset = $config['charset'];
        $names = "set names '$charset'".
            ( ! is_null($collation) ? " collate '$collation'" : '');
        $connection->prepare($names)->execute();
        if (isset($config['timezone']))
        {
            $connection->prepare(
                'set time_zone="'.$config['timezone'].'"'
            )->execute();
        }
        if (isset($config['strict']) && $config['strict'])
        {
            $connection->prepare("set session sql_mode='STRICT_ALL_TABLES'")->execute();
        }

        return $connection;
    }

    /**
     * @param  array   $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        return $this->configHasSocket($config) ? $this->getSocketDsn($config) : $this->getHostDsn($config);
    }

    /**
     * @param  array  $config
     * @return bool
     */
    protected function configHasSocket(array $config)
    {
        return isset($config['unix_socket']) && ! empty($config['unix_socket']);
    }

    /**
     *
     * @param  array  $config
     * @return string
     */
    protected function getSocketDsn(array $config)
    {
        extract($config);
        return "mysql:unix_socket={$config['unix_socket']};dbname={$database}";
    }

    /**
     * @param  array  $config
     * @return string
     */
    protected function getHostDsn(array $config)
    {
        extract($config);
        return isset($config['port'])
            ? "mysql:host={$host};port={$port};dbname={$database}"
            : "mysql:host={$host};dbname={$database}";
    }

}
