# Stamps Client

A Stamps.com SOAP integration.

### Usage

```php
$to = (new \Panacea\Stamps\Contracts\Address)
    ->setFullname('Neymar Jr')
    ->setAddress1('100 Ocean Drive')
    ->setAddress2('#200')
    ->setCity('Miami Beach')
    ->setState('Florida')
    ->setZipcode('33139')
    ->setCountry('US');

$from = (new \Panacea\Stamps\Contracts\Address)
    ->setFullname('Leonel Messi')
    ->setAddress1('300 Broadway')
    ->setAddress2('#400')
    ->setCity('New York City')
    ->setState('NY')
    ->setZipcode('10001')
    ->setCountry('US');

try {
    $shippingLabel = (new \Panacea\Stamps\Entities\ShippingLabel)
        ->setApiUrl('API_URL') // Leave out for default
        ->setApiIntegrationId('YOUR_API_INTEGRATION_ID')
        ->setApiUserId('YOUR_API_USER_ID')
        ->setApiPassword('YOUR_API_PASSWORD')
        ->setImageType(\Panacea\Stamps\Enums\ImageType::PNG)
        ->setPackageType(\Panacea\Stamps\Enums\PackageType::THICK_ENVELOPE)
        ->setServiceType(\Panacea\Stamps\Enums\ServiceType::FC)
        ->setFrom($from)
        ->setTo($to)
        ->setIsSampleOnly(false)
        ->setWeightOz(100)
        ->setShipDate('2018-01-17')
        ->setShowPrice(false);

    // Generate label and get URL to the PDF or PNG
    // Takes an optional filename argument to save label to file
    $labelUrl = $shippingLabel->create();
} catch(Exception $e) {
    // Handle exception
}
```
