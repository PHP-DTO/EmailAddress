Installation
```shell script
composer require php-dto/email-address
```

Usage
```php
<?php
use \PhpDto\EmailAddress\EmailAddress;
use \PhpDto\EmailAddress\Exception\InvalidEmailAddressException;

$email = new EmailAddress(' mail@example.com '); //spaces will be trimmed

echo $email->get();              //will print 'mail@example.com'
echo (string) $email;            //will print 'mail@example.com'

echo $email->getUsername();      //will print 'mail'
echo $email->getHostname();      //will print 'example.com'

echo json_encode([$email]);      //will print '["mail@example.com"]'


new EmailAddress('example.com'); //will throw InvalidEmailAddressException (validate by FILTER_VALIDATE_EMAIL)
```
