## テスト駆動開発 PHP version 写経

quick start
```
composer install
```
use static analysis with phpstan.   
example:
```$xslt
./vendor/bin/phpstan analyse -l 7 ./src
```
use coding standards fixer php-cs-fixer.
example:
```$xslt
./vendor/bin/php-cs-fixer --rules=@PSR2 fix ./src
```
