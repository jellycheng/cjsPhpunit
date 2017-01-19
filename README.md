
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


