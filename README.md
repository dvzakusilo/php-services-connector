# php-services-connector
Extensible library to connect to API services from PHP.

The library allows you to inherit connectors to any service and create any set of methods.
To work, you need to create your own class and inherit the service.
```php
class TestConnect extends PSRVConnector\Service
```
Next, we connect to the library a set of methods for working with the service, issued in the form of traits.

```php
use TraitName;
``` 

You can write your own connectors or use ready-made ones. All of them must inherit the connector class `` \ PSRVConnector \ Interfaces \ ConnectorInterface``

We initialize the connector, connect the traits (a set of methods for interacting with the connector), and write our own any methods - wrappers over the traits, or use as is.

An example of using the service when connecting to the DaData standardization API.
```php
use PSRVConnector\Connectors\Dadata\API\Clean;
use PSRVConnector\Connectors\Dadata\Connector;

require 'vendor/autoload.php';

class TestConnect extends PSRVConnector\Service
{
    use Clean;

    public function __construct()
    {
        parent::__construct(new Connector(
                'API_KEY',
                'SECRET_KEY',
                ['base_uri' => 'https://cleaner.dadata.ru/api/v1/']
            )
        );
    }

    public function getDatByAddress(string $sBody)
    {
        return $this->getAddress($sBody);
    }
}

$obTest = new TestConnect();
var_dump($obTest->getDatByAddress('мск сухонска 11/-89'));
``` 
