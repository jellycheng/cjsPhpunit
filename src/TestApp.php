<?php
namespace CjsPhpunit;

class TestApp {

    protected static $instance = null;
    protected $path = [];

    public static function create()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function setTestBasePath($path) {
        $this->path['basePath'] = $path;
        return $this;
    }

    public function getTestBasePath() {
        if(isset($this->path['basePath'])) {
            return $this->path['basePath'];
        }
        return '';
    }

    public function setTestFixturesPath($path){
        $this->path['fixturesPath'] = $path;
        return $this;
    }

    public function getTestFixturesPath() {
        if(isset($this->path['fixturesPath'])) {
            return $this->path['fixturesPath'];
        }
        return $this->getTestBasePath() . 'fixtures/';
    }


    public function setTestSchemaPath($path){
        $this->path['schemaPath'] = $path;
        return $this;
    }

    public function getTestSchemaPath() {
        if(isset($this->path['schemaPath'])) {
            return $this->path['schemaPath'];
        }
        return $this->getTestBasePath() . 'schemas/';
    }

}