<?php
namespace CjsPhpunit;

class TestApp {

    protected static $instance = null;
    protected $path = [
                            'schemaPath'=>'',
                            'basePath'=>'',
                            'logPath'=>'',
                            'fixturesPath'=>'',
                        ];
    protected $frameWorkType = 'lsf'; //框架类型
    protected $log;

    public static function create()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @return null
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    public function setTestBasePath($path) {
        $this->path['basePath'] = $path;
        return $this;
    }

    public function getTestBasePath() {
        if(isset($this->path['basePath']) && $this->path['basePath']) {
            return $this->path['basePath'];
        }
        return '';
    }

    public function setTestFixturesPath($path){
        $this->path['fixturesPath'] = $path;
        return $this;
    }

    public function getTestFixturesPath() {
        if(isset($this->path['fixturesPath']) && $this->path['fixturesPath']) {
            return $this->path['fixturesPath'];
        }
        return $this->getTestBasePath() . 'fixtures/';
    }


    public function setTestSchemaPath($path){
        $this->path['schemaPath'] = $path;
        return $this;
    }

    public function getTestSchemaPath() {
        if(isset($this->path['schemaPath']) && $this->path['schemaPath']) {
            return $this->path['schemaPath'];
        }
        return $this->getTestBasePath() . 'schemas/';
    }

    /**
     * @param array|string $key
     * @param string $val
     */
    public function setPath($key, $val = null)
    {
        if(is_array($key)) {
            $this->path = array_merge($this->path, $key);
        } else {
            $this->path[$key] = $val;
        }
        return $this;
    }

    public function getPath($key = null)
    {
        if(is_null($key)) {
            return $this->path;
        } else if(isset($this->path[$key])) {
            return $this->path[$key];
        }
        return '';
    }

    /**
     * 设置框架类型
     * @param string $frameWorkType
     */
    public function setFrameWorkType($frameWorkType)
    {
        $this->frameWorkType = $frameWorkType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrameWorkType()
    {
        return $this->frameWorkType;
    }

    /**
     * @return mixed
     */
    public function getLog()
    {
        return $this->log?: EmptyImpl::create();
    }

    /**
     * @param mixed $log
     */
    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }


}