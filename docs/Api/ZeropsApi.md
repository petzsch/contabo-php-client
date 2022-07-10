# OpenAPI\Client\ZeropsApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**retrieveZeropsUser()**](ZeropsApi.md#retrieveZeropsUser) | **GET** /v1/zerops/user | get zerops user
[**signInZerops()**](ZeropsApi.md#signInZerops) | **GET** /v1/zerops/sign-in | authenticate to zerops


## `retrieveZeropsUser()`

```php
retrieveZeropsUser($x_request_id, $x_trace_id): \OpenAPI\Client\Model\FindZeropsUserResponse
```

get zerops user

get zerops user with information like your zerops email

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ZeropsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveZeropsUser($x_request_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ZeropsApi->retrieveZeropsUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindZeropsUserResponse**](../Model/FindZeropsUserResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signInZerops()`

```php
signInZerops($x_request_id, $x_trace_id): \OpenAPI\Client\Model\FindZeropsSignInResponse
```

authenticate to zerops

get an url to authenticate to zerops with contabo api

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ZeropsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->signInZerops($x_request_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ZeropsApi->signInZerops: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindZeropsSignInResponse**](../Model/FindZeropsSignInResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
