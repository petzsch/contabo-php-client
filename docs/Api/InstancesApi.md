# OpenAPI\Client\InstancesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelInstance()**](InstancesApi.md#cancelInstance) | **POST** /v1/compute/instances/{instanceId}/cancel | Cancel specific instance by id |
| [**createInstance()**](InstancesApi.md#createInstance) | **POST** /v1/compute/instances | Create a new instance |
| [**patchInstance()**](InstancesApi.md#patchInstance) | **PATCH** /v1/compute/instances/{instanceId} | Update specific instance |
| [**reinstallInstance()**](InstancesApi.md#reinstallInstance) | **PUT** /v1/compute/instances/{instanceId} | Reinstall specific instance |
| [**retrieveInstance()**](InstancesApi.md#retrieveInstance) | **GET** /v1/compute/instances/{instanceId} | Get specific instance by id |
| [**retrieveInstancesList()**](InstancesApi.md#retrieveInstancesList) | **GET** /v1/compute/instances | List instances |
| [**upgradeInstance()**](InstancesApi.md#upgradeInstance) | **POST** /v1/compute/instances/{instanceId}/upgrade | Upgrading instance capabilities |


## `cancelInstance()`

```php
cancelInstance($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\CancelInstanceResponse
```

Cancel specific instance by id

Your are free to cancel a previously created instance at any time.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelInstance($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->cancelInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CancelInstanceResponse**](../Model/CancelInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createInstance()`

```php
createInstance($x_request_id, $create_instance_request, $x_trace_id): \OpenAPI\Client\Model\CreateInstanceResponse
```

Create a new instance

Create a new instance for your account with the provided parameters.       <table>         <tr><th>ProductId</th><th>Product</th><th>Disk Size</th></tr>         <tr><td>V1</td><td>VPS S SSD</td><td>200 GB SSD</td></tr>         <tr><td>V35</td><td>VPS S Storage</td><td>400 GB SSD</td></tr>         <tr><td>V12</td><td>VPS S NVMe</td><td>50 GB NVMe</td></tr>         <tr><td>V2</td><td>VPS M SSD</td><td>400 GB SSD</td></tr>         <tr><td>V36</td><td>VPS M Storage</td><td>800 GB SSD</td></tr>         <tr><td>V13</td><td>VPS M NVMe</td><td>100 GB NVMe</td></tr>         <tr><td>V3</td><td>VPS L SSD</td><td>800 GB SSD</td></tr>         <tr><td>V37</td><td>VPS L Storage</td><td>1600 GB SSD</td></tr>         <tr><td>V14</td><td>VPS L NVMe</td><td>200 GB NVMe</td></tr>         <tr><td>V4</td><td>VPS XL SSD</td><td>1600 GB SSD</td></tr>         <tr><td>V38</td><td>VPS XL SSD</td><td>3200 GB SSD</td></tr>         <tr><td>V15</td><td>VPS XL NVMe</td><td>400 GB NVMe</td></tr>         <tr><td>V8</td><td>VDS S</td><td>180 GB NVMe</td></tr>         <tr><td>V9</td><td>VDS M</td><td>240 GB NVMe</td></tr>         <tr><td>V10</td><td>VDS L</td><td>360 GB NVMe</td></tr>         <tr><td>V11</td><td>VDS XL</td><td>480 GB NVMe</td></tr>         <tr><td>V16</td><td>VDS XXL</td><td>720 GB NVMe</td></tr>         </table>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_instance_request = new \OpenAPI\Client\Model\CreateInstanceRequest(); // \OpenAPI\Client\Model\CreateInstanceRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createInstance($x_request_id, $create_instance_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->createInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_instance_request** | [**\OpenAPI\Client\Model\CreateInstanceRequest**](../Model/CreateInstanceRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateInstanceResponse**](../Model/CreateInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `patchInstance()`

```php
patchInstance($x_request_id, $instance_id, $patch_instance_request, $x_trace_id): \OpenAPI\Client\Model\PatchInstanceResponse
```

Update specific instance

Update specific instance by instanceId.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$patch_instance_request = new \OpenAPI\Client\Model\PatchInstanceRequest(); // \OpenAPI\Client\Model\PatchInstanceRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->patchInstance($x_request_id, $instance_id, $patch_instance_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->patchInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **patch_instance_request** | [**\OpenAPI\Client\Model\PatchInstanceRequest**](../Model/PatchInstanceRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\PatchInstanceResponse**](../Model/PatchInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `reinstallInstance()`

```php
reinstallInstance($x_request_id, $instance_id, $reinstall_instance_request, $x_trace_id): \OpenAPI\Client\Model\ReinstallInstanceResponse
```

Reinstall specific instance

You can reinstall a specific instance with a new image and optionally add ssh keys, a root password or cloud-init.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$reinstall_instance_request = new \OpenAPI\Client\Model\ReinstallInstanceRequest(); // \OpenAPI\Client\Model\ReinstallInstanceRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->reinstallInstance($x_request_id, $instance_id, $reinstall_instance_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->reinstallInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **reinstall_instance_request** | [**\OpenAPI\Client\Model\ReinstallInstanceRequest**](../Model/ReinstallInstanceRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ReinstallInstanceResponse**](../Model/ReinstallInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveInstance()`

```php
retrieveInstance($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\FindInstanceResponse
```

Get specific instance by id

Get attributes values to a specific instance on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveInstance($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->retrieveInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindInstanceResponse**](../Model/FindInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveInstancesList()`

```php
retrieveInstancesList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $region, $instance_id, $instance_ids, $status, $add_on_ids, $product_types): \OpenAPI\Client\Model\ListInstancesResponse
```

List instances

List and filter all instances in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
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
$name = vmd12345; // string | The name of the instance
$region = EU; // string | The Region of the instance
$instance_id = 100; // int | The identifier of the instance (deprecated)
$instance_ids = 100, 101, 102; // string | Comma separated instances identifiers
$status = provisioning,installing; // string | The status of the instance
$add_on_ids = 1044,827; // string | Identifiers of Addons the instances have
$product_types = ssd, hdd, nvme; // string | Comma separated instance's category depending on Product Id

try {
    $result = $apiInstance->retrieveInstancesList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $region, $instance_id, $instance_ids, $status, $add_on_ids, $product_types);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->retrieveInstancesList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of the instance | [optional] |
| **region** | **string**| The Region of the instance | [optional] |
| **instance_id** | **int**| The identifier of the instance (deprecated) | [optional] |
| **instance_ids** | **string**| Comma separated instances identifiers | [optional] |
| **status** | **string**| The status of the instance | [optional] |
| **add_on_ids** | **string**| Identifiers of Addons the instances have | [optional] |
| **product_types** | **string**| Comma separated instance&#39;s category depending on Product Id | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListInstancesResponse**](../Model/ListInstancesResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `upgradeInstance()`

```php
upgradeInstance($x_request_id, $instance_id, $upgrade_instance_request, $x_trace_id): \OpenAPI\Client\Model\PatchInstanceResponse
```

Upgrading instance capabilities

In order to enhance your instance with additional features you can purchase add-ons. Currently only firewalling and private network addon is allowed.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$upgrade_instance_request = new \OpenAPI\Client\Model\UpgradeInstanceRequest(); // \OpenAPI\Client\Model\UpgradeInstanceRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->upgradeInstance($x_request_id, $instance_id, $upgrade_instance_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->upgradeInstance: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **upgrade_instance_request** | [**\OpenAPI\Client\Model\UpgradeInstanceRequest**](../Model/UpgradeInstanceRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\PatchInstanceResponse**](../Model/PatchInstanceResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
