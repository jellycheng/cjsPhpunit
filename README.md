
### php单元测试


```php
preg_match('/APP_ENV=(\w+)/',$env, $matches);

```

###命名规则
```
单元测试方法以test* 开头， 如testLogin()
单元测试类以Test结尾，如class UserLoginTest extends \CjsPhpunit\TestCaseBase
```

### phpunit phar
```
PHPUnit 4.8 支持 PHP 5.3, PHP 5.4, PHP 5.5, 和 PHP 5.6
PHPUnit 5.7 支持 PHP 5.6, PHP 7.0, 和 PHP 7.1 
https://phar.phpunit.de/
https://phar.phpunit.de/phpunit.phar

linux下安装
wget https://phar.phpunit.de/phpunit.phar
➜ chmod +x phpunit.phar
➜ sudo mv phpunit.phar /usr/local/bin/phpunit
➜ phpunit --version
 ```
 
 ### phpunit
 ```
 查看版本： phpunit.phar --version
    php phpunit-4.8.31.phar --version
    php phpunit-5.7.5.phar --version

```


```
<php>
    <env name="APP_TEST_ENV" value="dev"/>设置php的$_ENV值
</php>
<php>
  <ini name="foo" value="bar"/>
  <const name="foo" value="bar"/>
  <var name="foo" value="bar"/>
  <env name="foo" value="bar"/>
  <post name="foo" value="bar"/>
  <get name="foo" value="bar"/>
  <cookie name="foo" value="bar"/>
  <server name="foo" value="bar"/>
  <files name="foo" value="bar"/>
  <request name="foo" value="bar"/>
</php>
以上xml配置对应php代码如下：
ini_set('foo', 'bar');
define('foo', 'bar');
$GLOBALS['foo'] = 'bar';
$_ENV['foo'] = 'bar';
$_POST['foo'] = 'bar';
$_GET['foo'] = 'bar';
$_COOKIE['foo'] = 'bar';
$_SERVER['foo'] = 'bar';
$_FILES['foo'] = 'bar';
$_REQUEST['foo'] = 'bar';
```

