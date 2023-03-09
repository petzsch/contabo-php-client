# OpenAPI\Client\VIPApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**assignIp()**](VIPApi.md#assignIp) | **POST** /v1/vips/{ip}/instances/{instanceId} | Assign a VIP to a VPS/VDS |
| [**retrieveVip()**](VIPApi.md#retrieveVip) | **GET** /v1/vips/{ip} | Get specific VIP by ip |
| [**retrieveVipList()**](VIPApi.md#retrieveVipList) | **GET** /v1/vips | List VIPs |
| [**unassignIp()**](VIPApi.md#unassignIp) | **DELETE** /v1/vips/{ip}/instances/{instanceId} | Unassign a VIP from a VPS/VDS |


## `assignIp()`

```php
assignIp($x_request_id, $instance_id, $ip, $x_trace_id): \OpenAPI\Client\Model\AssignVipResponse
```

Assign a VIP to a VPS/VDS

Assign a VIP to a VPS/VDS using the machine id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$ip = 127.0.0.1; // string | The ip you want to add the instance to
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->assignIp($x_request_id, $instance_id, $ip, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->assignIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **ip** | **string**| The ip you want to add the instance to | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\AssignVipResponse**](../Model/AssignVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveVip()`

```php
retrieveVip($x_request_id, $ip, $x_trace_id): \OpenAPI\Client\Model\FindVipResponse
```

Get specific VIP by ip

Get attributes values to a specific VIP on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$ip = 10.214.121.145; // string | The ip of the VIP
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveVip($x_request_id, $ip, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->retrieveVip: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **ip** | **string**| The ip of the VIP | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindVipResponse**](../Model/FindVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveVipList()`

```php
retrieveVipList($x_request_id, $x_trace_id, $page, $size, $order_by, $resource_id, $resource_type, $resource_name, $resource_display_name, $ip_version, $ips, $ip, $type, $data_center, $region): \OpenAPI\Client\Model\ListVipResponse
```

List VIPs

List and filter all vips in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VIPApi(
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
$resource_id = 10001; // string | The resourceId using the VIP.
$resource_type = instance; // string | The resourceType using the VIP.
$resource_name = vmi100101; // string | The name of the resource.
$resource_display_name = my instance; // string | The display name of the resource.
$ip_version = v4; // string | The VIP version.
$ips = 10.214.121.145, 10.214.121.1, 10.214.121.11; // string | Comma separated IPs
$ip = 10.214.121.145; // string | The ip of the VIP
$type = additional; // string | The VIP type.
$data_center = European Union (Germany) 3; // string | The dataCenter of the VIP.
$region = European Union (Germany); // string | The region of the VIP.

try {
    $result = $apiInstance->retrieveVipList($x_request_id, $x_trace_id, $page, $size, $order_by, $resource_id, $resource_type, $resource_name, $resource_display_name, $ip_version, $ips, $ip, $type, $data_center, $region);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->retrieveVipList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **resource_id** | **string**| The resourceId using the VIP. | [optional] |
| **resource_type** | **string**| The resourceType using the VIP. | [optional] |
| **resource_name** | **string**| The name of the resource. | [optional] |
| **resource_display_name** | **string**| The display name of the resource. | [optional] |
| **ip_version** | **string**| The VIP version. | [optional] |
| **ips** | **string**| Comma separated IPs | [optional] |
| **ip** | **string**| The ip of the VIP | [optional] |
| **type** | **string**| The VIP type. | [optional] |
| **data_center** | **string**| The dataCenter of the VIP. | [optional] |
| **region** | **string**| The region of the VIP. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListVipResponse**](../Model/ListVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unassignIp()`

```php
unassignIp($x_request_id, $instance_id, $ip, $x_trace_id): \OpenAPI\Client\Model\UnassignVipResponse
```

Unassign a VIP from a VPS/VDS

Unassign a VIP from a VPS/VDS using the machine id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\VIPApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$ip = 127.0.0.1; // string | The ip you want to add the instance to
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->unassignIp($x_request_id, $instance_id, $ip, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VIPApi->unassignIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **ip** | **string**| The ip you want to add the instance to | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UnassignVipResponse**](../Model/UnassignVipResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
