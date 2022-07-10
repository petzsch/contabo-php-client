# OpenAPI\Client\PrivateNetworksApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**assignInstancePrivateNetwork()**](PrivateNetworksApi.md#assignInstancePrivateNetwork) | **POST** /v1/private-networks/{privateNetworkId}/instances/{instanceId} | Add instance to a Private Network
[**createPrivateNetwork()**](PrivateNetworksApi.md#createPrivateNetwork) | **POST** /v1/private-networks | Create a new Private Network
[**deletePrivateNetwork()**](PrivateNetworksApi.md#deletePrivateNetwork) | **DELETE** /v1/private-networks/{privateNetworkId} | Delete existing Private Network by id
[**patchPrivateNetwork()**](PrivateNetworksApi.md#patchPrivateNetwork) | **PATCH** /v1/private-networks/{privateNetworkId} | Update a Private Network by id
[**retrievePrivateNetwork()**](PrivateNetworksApi.md#retrievePrivateNetwork) | **GET** /v1/private-networks/{privateNetworkId} | Get specific Private Network by id
[**retrievePrivateNetworkList()**](PrivateNetworksApi.md#retrievePrivateNetworkList) | **GET** /v1/private-networks | List Private Networks
[**unassignInstancePrivateNetwork()**](PrivateNetworksApi.md#unassignInstancePrivateNetwork) | **DELETE** /v1/private-networks/{privateNetworkId}/instances/{instanceId} | Remove instance from a Private Network


## `assignInstancePrivateNetwork()`

```php
assignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse
```

Add instance to a Private Network

Add a specific instance to a Private Network

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$private_network_id = 12345; // int | The identifier of the Private Network
$instance_id = 100; // int | The identifier of the instance
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->assignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->assignInstancePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **private_network_id** | **int**| The identifier of the Private Network |
 **instance_id** | **int**| The identifier of the instance |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse**](../Model/AssignInstancePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createPrivateNetwork()`

```php
createPrivateNetwork($x_request_id, $create_private_network_request, $x_trace_id): \OpenAPI\Client\Model\CreatePrivateNetworkResponse
```

Create a new Private Network

Create a new Private Network in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_private_network_request = new \OpenAPI\Client\Model\CreatePrivateNetworkRequest(); // \OpenAPI\Client\Model\CreatePrivateNetworkRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createPrivateNetwork($x_request_id, $create_private_network_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->createPrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **create_private_network_request** | [**\OpenAPI\Client\Model\CreatePrivateNetworkRequest**](../Model/CreatePrivateNetworkRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\CreatePrivateNetworkResponse**](../Model/CreatePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePrivateNetwork()`

```php
deletePrivateNetwork($x_request_id, $private_network_id, $x_trace_id)
```

Delete existing Private Network by id

Delete existing Private Network by id and automatically unassign all instances from it

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$private_network_id = 12345; // int | The identifier of the Private Network
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deletePrivateNetwork($x_request_id, $private_network_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->deletePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **private_network_id** | **int**| The identifier of the Private Network |
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

## `patchPrivateNetwork()`

```php
patchPrivateNetwork($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id): \OpenAPI\Client\Model\PatchPrivateNetworkResponse
```

Update a Private Network by id

Update a Private Network by id in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$private_network_id = 12345; // int | The identifier of the Private Network
$patch_private_network_request = new \OpenAPI\Client\Model\PatchPrivateNetworkRequest(); // \OpenAPI\Client\Model\PatchPrivateNetworkRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchPrivateNetwork($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->patchPrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **private_network_id** | **int**| The identifier of the Private Network |
 **patch_private_network_request** | [**\OpenAPI\Client\Model\PatchPrivateNetworkRequest**](../Model/PatchPrivateNetworkRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\PatchPrivateNetworkResponse**](../Model/PatchPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePrivateNetwork()`

```php
retrievePrivateNetwork($x_request_id, $private_network_id, $x_trace_id): \OpenAPI\Client\Model\FindPrivateNetworkResponse
```

Get specific Private Network by id

Get attributes values to a specific Private Network on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$private_network_id = 12345; // int | The identifier of the Private Network
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrievePrivateNetwork($x_request_id, $private_network_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->retrievePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **private_network_id** | **int**| The identifier of the Private Network |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindPrivateNetworkResponse**](../Model/FindPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrievePrivateNetworkList()`

```php
retrievePrivateNetworkList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids): \OpenAPI\Client\Model\ListPrivateNetworkResponse
```

List Private Networks

List and filter all Private Networks in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
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
$name = myPrivateNetwork; // string | The name of the Private Network
$instance_ids = 100, 101, 102; // string | Comma separated instances identifiers

try {
    $result = $apiInstance->retrievePrivateNetworkList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->retrievePrivateNetworkList: ', $e->getMessage(), PHP_EOL;
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
 **name** | **string**| The name of the Private Network | [optional]
 **instance_ids** | **string**| Comma separated instances identifiers | [optional]

### Return type

[**\OpenAPI\Client\Model\ListPrivateNetworkResponse**](../Model/ListPrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unassignInstancePrivateNetwork()`

```php
unassignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse
```

Remove instance from a Private Network

Remove a specific instance from a Private Network

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PrivateNetworksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$private_network_id = 12345; // int | The identifier of the Private Network
$instance_id = 100; // int | The identifier of the instance
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->unassignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNetworksApi->unassignInstancePrivateNetwork: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **private_network_id** | **int**| The identifier of the Private Network |
 **instance_id** | **int**| The identifier of the instance |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse**](../Model/UnassignInstancePrivateNetworkResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
