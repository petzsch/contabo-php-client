# OpenAPI\Client\InstanceActionsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**restart()**](InstanceActionsApi.md#restart) | **POST** /v1/compute/instances/{instanceId}/actions/restart | Restart a compute instance / resource identified by its id |
| [**shutdown()**](InstanceActionsApi.md#shutdown) | **POST** /v1/compute/instances/{instanceId}/actions/shutdown | Shutdown compute instance / resource by its id |
| [**start()**](InstanceActionsApi.md#start) | **POST** /v1/compute/instances/{instanceId}/actions/start | Start a compute instance / resource identified by its id |
| [**stop()**](InstanceActionsApi.md#stop) | **POST** /v1/compute/instances/{instanceId}/actions/stop | Stop compute instance / resource by its id |


## `restart()`

```php
restart($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\InstanceRestartActionResponse
```

Restart a compute instance / resource identified by its id

Restarting a compute instance / resource is like powering off and powering on again a real server. If the compute instance / resource is already started it will stopped and started again. If it is stopped the compute instance / resource will be started. So please be aware that data may be lost. You may check the current status anytime when getting information about a compute instance / resource.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstanceActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the compute instance / resource to be started.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->restart($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceActionsApi->restart: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the compute instance / resource to be started. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\InstanceRestartActionResponse**](../Model/InstanceRestartActionResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `shutdown()`

```php
shutdown($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\InstanceShutdownActionResponse
```

Shutdown compute instance / resource by its id

Shutdown an compute instance / resource. This is similar to pressing the power button on a physical machine. This will send an ACPI event for the guest OS, which should then proceed to a clean shutdown.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstanceActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance to be shutdown
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->shutdown($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceActionsApi->shutdown: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance to be shutdown | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\InstanceShutdownActionResponse**](../Model/InstanceShutdownActionResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `start()`

```php
start($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\InstanceStartActionResponse
```

Start a compute instance / resource identified by its id

Starting a compute instance / resource is like powering on a real server. If the compute instance / resource is already started nothing will happen. You may check the current status anytime when getting information about a compute instance / resource.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstanceActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the compute instance / resource to be started.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->start($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceActionsApi->start: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the compute instance / resource to be started. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\InstanceStartActionResponse**](../Model/InstanceStartActionResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `stop()`

```php
stop($x_request_id, $instance_id, $x_trace_id): \OpenAPI\Client\Model\InstanceStopActionResponse
```

Stop compute instance / resource by its id

Stopping a compute instance / resource is like powering off a real server. So please be aware that data may be lost. Alternatively you may log in and shut your compute instance / resource gracefully via the operating system. If the compute instance / resource is already stopped nothing will happen. You may check the current status anytime when getting information about a compute instance / resource.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InstanceActionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance to stop
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->stop($x_request_id, $instance_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceActionsApi->stop: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance to stop | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\InstanceStopActionResponse**](../Model/InstanceStopActionResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
