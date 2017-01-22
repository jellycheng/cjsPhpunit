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
        // 插入数据
        $this->insertFixtureTable($data_set, $fixture_type);
    }

    protected function importJsonFixture($fixture_file, $fixture_type)
    {
        $data_set = json_decode(file_get_contents($fixture_file), true);
        // 插入数据
        $this->insertFixtureTable($data_set, $fixture_type);
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
            // 插入一条数据
            $this->insertFixtureData($name, $rows, $fixture_type);
        }
    }

    protected function insertFixtureTable($data, $fixture_type)
    {

    }

    protected function insertFixtureData($db_tblname, $rows, $fixture_type)
    {

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
                $method =  \CjsPhpunit\array_get($tmp, '1', '');
                if(class_exists($cls)) {
                    if(!$method) {
                        \CjsPhpunit\printInfo(PHP_EOL . 'class ' . $cls . ' method "' . $method . '" not exists');
                    } else {
                        if(!is_array($args)) {
                            $args = array($args);
                        }
                        $output = call_user_func_array([new $cls, $method], $args);
                        //\CjsPhpunit\printInfo($output);
                    }
                } else {
                    \CjsPhpunit\printInfo(PHP_EOL . 'class not exists: ' . $cls);
                }
                TestApp::create()->getLog()->debugLog($method, $args, $output);
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

    /**
     * 在当前文件第1个测试用例类执行前执行，一般用于连接db及其它初始化
     */
    public static function setUpBeforeClass() {
        //echo PHP_EOL . "current first test before " . PHP_EOL;
        parent::setUpBeforeClass();

    }

    /**
     * 在当前文件所有测试用例类执行完后执行
     */
    public static function tearDownAfterClass()
    {
        //echo PHP_EOL . "current file all test finsh " . PHP_EOL;
        parent::tearDownAfterClass();

    }

    /**
     * 每个测试用例执行前执行
     * 一般用途： 开始计算时间，判断是否跳过当前用例，等
     */
    protected function setUp()
    {
        TestCaseCount::create()->addI();
        $msg = sprintf('========================setup %s========================%s', TestCaseCount::create()->getI(), PHP_EOL);
        TestApp::create()->getLog()->debugLog($msg);
        Benchmark::start('set_up_tear_tag');
        //echo PHP_EOL . 'setUp ' . PHP_EOL;
        parent::setUp();
        //标记跳过本次用例，执行单元测试加上 --verbose 参数会看到跳过原因
        //$this->markTestSkipped('跳过本用例方法原因： MySQLi 扩展不可用');

    }

    /**
     * 每个测试用例执行完毕后执行
     */
    protected function tearDown()
    {
        parent::tearDown();
        $msg = sprintf("========================消耗时间：%ss========================%s" , Benchmark::elapsed_time('set_up_tear_tag'), PHP_EOL);
        TestApp::create()->getLog()->debugLog($msg);
    }

}