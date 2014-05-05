ThecallrBundle
====================

## Prerequisites
* PHP >= 5.2.0
* The PHP JSON extension
* The PHP cURL extension

## Installation

### Get the bundle

With composer :

``` json
{
    "require": {
        "rc2c/the-callr-bundle": "dev-master"
    }
}
```
### Initialize the bundle
To start using the bundle, register the bundle in your application's kernel class:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // Thecallr
        new Rc2c\ThecallrBundle\Rc2cThecallrBundle()
        // ...
    );
)
```
### Configure the bundle

```yml
rc2c.the_callr.login: 'your_login'
rc2c.the_callr.password: 'your_password'
rc2c.the_callr.sender: 'THECALLR'
```
## Code sample

```php
// Load thecallr service
$sms_Manager = $this->container->get('rc2c.the_callr');
// Your phone number (international format)
$phone       = '+33610111213';
// Your message (text)
$message     = 'your text message';

try {
    // Send sms
    $sms_Manager->send($phone, $message);
} catch(Exception $e) {
    $this->logMessage($e->getCode().'-'.$e->getMessage(), 'err');
}
```

## Documentation TheCallr API
http://thecallr.com/docs/