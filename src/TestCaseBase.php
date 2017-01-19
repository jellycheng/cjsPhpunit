<?php
namespace CjsPhpunit;

class TestCaseBase extends \PHPUnit_Framework_TestCase {

    /**
     * 测试基境
     * @param array $fixtures = ['database/user_db/t_user.php','redis/common']
     */
    protected function requireFixture($fixtures = [])
    {
        if (!is_array($fixtures)) {
            $fixtures = array($fixtures);
        }
        if (count($fixtures)<1) {
            return false;
        }
        // 读取fixture数据，写入DB
        foreach ($fixtures as $fixture) {
            if (!$fixture) {
                continue;
            }
            // 计算fixture的类型(database? cache?)
            $fixture_type = 'database';
            if (preg_match('/(\w+)\/.+/', $fixture, $matches)) {
                $fixture_type = $matches[1];
            }
            $fixture_file = TestApp::create()->getTestFixturesPath() . $fixture;
            if (strpos($fixture, '.php')) {//php文件
                $this->importPHPFixture($fixture_file, $fixture_type);
            } elseif (strpos($fixture, '.yml')) {
                $this->importYamlFixture($fixture_file, $fixture_type);
            } elseif (strpos($fixture, '.json')) {
                $this->importJsonFixture($fixture_file, $fixture_type);
            } else {
                $fixture_file .= ".yml";
                $this->importYamlFixture($fixture_file, $fixture_type);
            }
        }
        return true;

    }

    protected function importPHPFixture($fixture_file, $fixture_type)
    {
        $data_set = require $fixture_file;
        foreach ($data_set as $name => $rows) {
            // 插入数据
            //$this->insertFixtureTable($name, $rows, $fixture_type);
        }
    }

    protected function importJsonFixture($fixture_file, $fixture_type)
    {
        $data_set = json_decode(file_get_contents($fixture_file), true);
        foreach ($data_set as $name => $rows) {
            // 插入数据
            //$this->insertFixtureTable($name, $rows, $fixture_type);
        }
    }

    protected function importYamlFixture($yml_file, $fixture_type)
    {
        $data_set = new \PHPUnit_Extensions_Database_DataSet_YamlDataSet($yml_file);
        $table_names = $data_set->getTableNames();
        foreach ($table_names as $name) {
            $data   = $data_set->getTable($name);
            $count  = $data->getRowCount();
            $rows   = array();
            for ($i=0; $i< $count; $i++) {
                $row = $data->getRow($i);
                array_push($rows, $row);
            }
            // 插入数据
            //$this->insertFixtureTable($name, $rows, $fixture_type);
        }
    }

    protected function invoke()
    {
        $args   = func_get_args();
        $method = array_shift($args);
        $output = '';
        switch (TestApp::create()->getFrameWorkType()) {
            case 'lsf':
                $output = call_user_func_array("\\Paf\\Lsf\\Core\\App::invokeMethod", [$method, $args]);
                TestApp::create()->getLog()->debugLog($method,$args, $output);
                break;
            case 'laravel4':

                break;
            case 'laravel5':

                break;
            case 'phpunit':
                $tmp = explode('.', $method);
                $cls = $tmp[0];
                $method =  \CjsPhpunit\array_get($tmp, '1', 'hello');
                if(class_exists($cls)) {
                    $output = call_user_func_array([new $cls, $method], (array)$args);
                    echo $output;
                } else {
                    echo  PHP_EOL . 'class not exists: ' . $cls . PHP_EOL;
                }
                //TestApp::create()->getLog()->debugLog($method, $args, $output);
                break;
        }
        return $output;
    }

    protected function exitIfNotTestDatabase($database)
    {
        if (strpos($database, 'test') === false) {
            echo "$database is not a test database!!!";
            exit;
        }
    }

}