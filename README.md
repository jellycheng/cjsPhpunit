
### php单元测试


```php
preg_match('/APP_ENV=(\w+)/',$env, $matches);

```

###命名规则
单元测试方法以test* 开头， 如testLogin()
单元测试类以Test结尾，如class UserLoginTest extends \CjsPhpunit\TestCaseBase

