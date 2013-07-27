# Google Drive Client PHP

[![Build Status](https://travis-ci.org/soramugi/google-drive-client-php.png?branch=master)](https://travis-ci.org/soramugi/google-drive-client-php)

The php library to Google Drive API operate.
The wrapper which uses the library based on the following library.

<https://github.com/bitgandtter/google-api> based on <http://code.google.com/p/google-api-php-client/>


## Installation

### Using Composer

composer.json

```json
{
    "require": {
        "soramugi/google-drive-client-php": "*"
    }
}
```

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

## Usage

#### Attestation

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new Soramugi\GoogleDrive\Client;

$client->setClientId('your client id');
$client->setClientSecret('your client secret');

$token = '{"access_token":"your_access_token","token_type":"Bearer","expires_in":3600,"refresh_token":"your_refresh_token","created":0000000000}';
$client->setAccessToken($token);
```

get client id or client secret.

<https://code.google.com/apis/console/>

get json type string access_token.

<https://gist.github.com/soramugi/6060776>

#### List display

```php
<?php
$files = new Soramugi\GoogleDrive\Files($client);

foreach ($files->listFiles()->getItems() as $item) {
    if (!$item->getLabels()->getTrashed()) {
        echo "file : {$item->getTitle()}\n";
        echo "{$item->getId()}\n";
    }
}
```

#### Add Spreadsheet

```php
$file = new Soramugi\GoogleDrive\Spreadsheet();
$file->setClient($client);
$file->setTitle('test file '. time());
$file->setDescription('test description');

$data = "foo,var\nhi";
$createdFile = $file->insert($data);
echo $createdFile->getTitle() . "\n";
```

When adding into folder, id of forder file is set up.

    $file->setParentId($folderId);

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request

## License

Apache License, Version 2.0
