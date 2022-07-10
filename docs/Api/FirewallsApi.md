# OpenAPI\Client\FirewallsApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createFirewall()**](FirewallsApi.md#createFirewall) | **POST** /v1/firewalls | Create a new firewall
[**deleteFirewall()**](FirewallsApi.md#deleteFirewall) | **DELETE** /v1/firewalls/{firewallId} | Delete existing Firewall by id
[**patchFirewall()**](FirewallsApi.md#patchFirewall) | **PATCH** /v1/firewalls/{firewallId} | Update a Firewall by id
[**putFirewall()**](FirewallsApi.md#putFirewall) | **PUT** /v1/firewalls/{firewallId} | Update specific firewall rules
[**retrieveFirewall()**](FirewallsApi.md#retrieveFirewall) | **GET** /v1/firewalls/{firewallId} | Get specific firewall by its id
[**retrieveFirewallList()**](FirewallsApi.md#retrieveFirewallList) | **GET** /v1/firewalls | List firewalls
[**setDefaultFirewall()**](FirewallsApi.md#setDefaultFirewall) | **PUT** /v1/firewalls/{firewallId}/default | Set specific firewall to be default


## `createFirewall()`

```php
createFirewall($x_request_id, $create_firewall_request, $x_trace_id): \OpenAPI\Client\Model\CreateFirewallResponse
```

Create a new firewall

Create a firewall for you account with the provided setup.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_firewall_request = new \OpenAPI\Client\Model\CreateFirewallRequest(); // \OpenAPI\Client\Model\CreateFirewallRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createFirewall($x_request_id, $create_firewall_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->createFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **create_firewall_request** | [**\OpenAPI\Client\Model\CreateFirewallRequest**](../Model/CreateFirewallRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\CreateFirewallResponse**](../Model/CreateFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteFirewall()`

```php
deleteFirewall($x_request_id, $firewall_id, $x_trace_id)
```

Delete existing Firewall by id

Delete existing Firewall by id. A firewall cannot be deleted if there are instances attached to it.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewall_id = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteFirewall($x_request_id, $firewall_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->deleteFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **firewall_id** | **string**| The identifier of the firewall |
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

## `patchFirewall()`

```php
patchFirewall($x_request_id, $firewall_id, $patch_firewall_request, $x_trace_id): \OpenAPI\Client\Model\PatchFirewallResponse
```

Update a Firewall by id

Update a Firewall by id in your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewall_id = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$patch_firewall_request = new \OpenAPI\Client\Model\PatchFirewallRequest(); // \OpenAPI\Client\Model\PatchFirewallRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchFirewall($x_request_id, $firewall_id, $patch_firewall_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->patchFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **firewall_id** | **string**| The identifier of the firewall |
 **patch_firewall_request** | [**\OpenAPI\Client\Model\PatchFirewallRequest**](../Model/PatchFirewallRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\PatchFirewallResponse**](../Model/PatchFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `putFirewall()`

```php
putFirewall($x_request_id, $firewall_id, $put_firewall_request, $x_trace_id): \OpenAPI\Client\Model\PutFirewallResponse
```

Update specific firewall rules

Set rules for a specific firewall

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewall_id = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$put_firewall_request = new \OpenAPI\Client\Model\PutFirewallRequest(); // \OpenAPI\Client\Model\PutFirewallRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->putFirewall($x_request_id, $firewall_id, $put_firewall_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->putFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **firewall_id** | **string**| The identifier of the firewall |
 **put_firewall_request** | [**\OpenAPI\Client\Model\PutFirewallRequest**](../Model/PutFirewallRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\PutFirewallResponse**](../Model/PutFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveFirewall()`

```php
retrieveFirewall($x_request_id, $firewall_id, $x_trace_id): \OpenAPI\Client\Model\FindFirewallResponse
```

Get specific firewall by its id

Get data for a specific firewall on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewall_id = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveFirewall($x_request_id, $firewall_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->retrieveFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **firewall_id** | **string**| The identifier of the firewall |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindFirewallResponse**](../Model/FindFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveFirewallList()`

```php
retrieveFirewallList($x_request_id, $x_trace_id, $page, $size, $order_by, $name): \OpenAPI\Client\Model\ListFirewallResponse
```

List firewalls

List and filter all Firewalls in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
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
$name = myPrivateNetwork; // string | The name of the Firewall

try {
    $result = $apiInstance->retrieveFirewallList($x_request_id, $x_trace_id, $page, $size, $order_by, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->retrieveFirewallList: ', $e->getMessage(), PHP_EOL;
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
 **name** | **string**| The name of the Firewall | [optional]

### Return type

[**\OpenAPI\Client\Model\ListFirewallResponse**](../Model/ListFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setDefaultFirewall()`

```php
setDefaultFirewall($x_request_id, $firewall_id, $x_trace_id): \OpenAPI\Client\Model\SetDefaultFirewallResponse
```

Set specific firewall to be default

Set a specific firewall to be the default

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$firewall_id = b943b25a-c8b5-4570-9135-4bbaa7615b81; // string | The identifier of the firewall
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->setDefaultFirewall($x_request_id, $firewall_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsApi->setDefaultFirewall: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **firewall_id** | **string**| The identifier of the firewall |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\SetDefaultFirewallResponse**](../Model/SetDefaultFirewallResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
