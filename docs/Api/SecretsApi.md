# OpenAPI\Client\SecretsApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createSecret()**](SecretsApi.md#createSecret) | **POST** /v1/secrets | Create a new secret
[**deleteSecret()**](SecretsApi.md#deleteSecret) | **DELETE** /v1/secrets/{secretId} | Delete existing secret by id
[**retrieveSecret()**](SecretsApi.md#retrieveSecret) | **GET** /v1/secrets/{secretId} | Get specific secret by id
[**retrieveSecretList()**](SecretsApi.md#retrieveSecretList) | **GET** /v1/secrets | List secrets
[**updateSecret()**](SecretsApi.md#updateSecret) | **PATCH** /v1/secrets/{secretId} | Update specific secret by id


## `createSecret()`

```php
createSecret($x_request_id, $create_secret_request, $x_trace_id): \OpenAPI\Client\Model\CreateSecretResponse
```

Create a new secret

Create a new secret in your account with attributes name, type and value. Attribute type can be password or ssh.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_secret_request = new \OpenAPI\Client\Model\CreateSecretRequest(); // \OpenAPI\Client\Model\CreateSecretRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createSecret($x_request_id, $create_secret_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->createSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **create_secret_request** | [**\OpenAPI\Client\Model\CreateSecretRequest**](../Model/CreateSecretRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\CreateSecretResponse**](../Model/CreateSecretResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSecret()`

```php
deleteSecret($x_request_id, $secret_id, $x_trace_id)
```

Delete existing secret by id

You can remove a specific secret from your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$secret_id = 123; // int | The id of the secret
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteSecret($x_request_id, $secret_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->deleteSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **secret_id** | **int**| The id of the secret |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

void (empty response body)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveSecret()`

```php
retrieveSecret($x_request_id, $secret_id, $x_trace_id): \OpenAPI\Client\Model\FindSecretResponse
```

Get specific secret by id

Get attributes values for a specific secret on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$secret_id = 123; // int | The id of the secret
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveSecret($x_request_id, $secret_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->retrieveSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **secret_id** | **int**| The id of the secret |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindSecretResponse**](../Model/FindSecretResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveSecretList()`

```php
retrieveSecretList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $type): \OpenAPI\Client\Model\ListSecretResponse
```

List secrets

List and filter all secrets in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$order_by = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$name = mysecret; // string | Filter secrets by name
$type = 'type_example'; // string | Filter secrets by type

try {
    $result = $apiInstance->retrieveSecretList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->retrieveSecretList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]
 **page** | **int**| Number of page to be fetched. | [optional]
 **size** | **int**| Number of elements per page. | [optional]
 **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional]
 **name** | **string**| Filter secrets by name | [optional]
 **type** | **string**| Filter secrets by type | [optional]

### Return type

[**\OpenAPI\Client\Model\ListSecretResponse**](../Model/ListSecretResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSecret()`

```php
updateSecret($x_request_id, $secret_id, $update_secret_request, $x_trace_id): \OpenAPI\Client\Model\UpdateSecretResponse
```

Update specific secret by id

Update attributes to your secret. Attributes are optional. If not set, the attributes will retain their original values. Only name and value can be updated.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$secret_id = 123; // int | The id of the secret
$update_secret_request = new \OpenAPI\Client\Model\UpdateSecretRequest(); // \OpenAPI\Client\Model\UpdateSecretRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateSecret($x_request_id, $secret_id, $update_secret_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->updateSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **secret_id** | **int**| The id of the secret |
 **update_secret_request** | [**\OpenAPI\Client\Model\UpdateSecretRequest**](../Model/UpdateSecretRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\UpdateSecretResponse**](../Model/UpdateSecretResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
