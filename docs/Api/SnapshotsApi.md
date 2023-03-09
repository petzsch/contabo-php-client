# OpenAPI\Client\SnapshotsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSnapshot()**](SnapshotsApi.md#createSnapshot) | **POST** /v1/compute/instances/{instanceId}/snapshots | Create a new instance snapshot |
| [**deleteSnapshot()**](SnapshotsApi.md#deleteSnapshot) | **DELETE** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Delete existing snapshot by id |
| [**retrieveSnapshot()**](SnapshotsApi.md#retrieveSnapshot) | **GET** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Retrieve a specific snapshot by id |
| [**retrieveSnapshotList()**](SnapshotsApi.md#retrieveSnapshotList) | **GET** /v1/compute/instances/{instanceId}/snapshots | List snapshots |
| [**rollbackSnapshot()**](SnapshotsApi.md#rollbackSnapshot) | **POST** /v1/compute/instances/{instanceId}/snapshots/{snapshotId}/rollback | Rollback the instance to a specific snapshot by id |
| [**updateSnapshot()**](SnapshotsApi.md#updateSnapshot) | **PATCH** /v1/compute/instances/{instanceId}/snapshots/{snapshotId} | Update specific snapshot by id |


## `createSnapshot()`

```php
createSnapshot($x_request_id, $instance_id, $create_snapshot_request, $x_trace_id): \OpenAPI\Client\Model\CreateSnapshotResponse
```

Create a new instance snapshot

Create a new snapshot for instance, with name and description attributes

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$create_snapshot_request = new \OpenAPI\Client\Model\CreateSnapshotRequest(); // \OpenAPI\Client\Model\CreateSnapshotRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createSnapshot($x_request_id, $instance_id, $create_snapshot_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->createSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **create_snapshot_request** | [**\OpenAPI\Client\Model\CreateSnapshotRequest**](../Model/CreateSnapshotRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateSnapshotResponse**](../Model/CreateSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSnapshot()`

```php
deleteSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id)
```

Delete existing snapshot by id

Delete existing instance snapshot by id

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$snapshot_id = snap1628603855; // string | The identifier of the snapshot
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->deleteSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **snapshot_id** | **string**| The identifier of the snapshot | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

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

## `retrieveSnapshot()`

```php
retrieveSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id): \OpenAPI\Client\Model\FindSnapshotResponse
```

Retrieve a specific snapshot by id

Get all attributes for a specific snapshot

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$snapshot_id = snap1628603855; // string | The identifier of the snapshot
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->retrieveSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **snapshot_id** | **string**| The identifier of the snapshot | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindSnapshotResponse**](../Model/FindSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveSnapshotList()`

```php
retrieveSnapshotList($x_request_id, $instance_id, $x_trace_id, $page, $size, $order_by, $name): \OpenAPI\Client\Model\ListSnapshotResponse
```

List snapshots

List and filter all your snapshots for a specific instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$order_by = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$name = Snapshot.Server; // string | Filter as substring match for snapshots names.

try {
    $result = $apiInstance->retrieveSnapshotList($x_request_id, $instance_id, $x_trace_id, $page, $size, $order_by, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->retrieveSnapshotList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **name** | **string**| Filter as substring match for snapshots names. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListSnapshotResponse**](../Model/ListSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rollbackSnapshot()`

```php
rollbackSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id): \OpenAPI\Client\Model\RollbackSnapshotResponse
```

Rollback the instance to a specific snapshot by id

Rollback instance to a specific snapshot. The snapshot must be the latest one in order to be able to restore it, otherwise you will receive an error informing you that the snapshot is not the latest

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$snapshot_id = snap1628603855; // string | The identifier of the snapshot
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->rollbackSnapshot($x_request_id, $instance_id, $snapshot_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->rollbackSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **snapshot_id** | **string**| The identifier of the snapshot | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\RollbackSnapshotResponse**](../Model/RollbackSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSnapshot()`

```php
updateSnapshot($x_request_id, $instance_id, $snapshot_id, $update_snapshot_request, $x_trace_id): \OpenAPI\Client\Model\UpdateSnapshotResponse
```

Update specific snapshot by id

Update attributes of a snapshot. You may only specify the attributes you want to change. If an attribute is not set, it will retain its original value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$instance_id = 12345; // int | The identifier of the instance
$snapshot_id = snap1628603855; // string | The identifier of the snapshot
$update_snapshot_request = new \OpenAPI\Client\Model\UpdateSnapshotRequest(); // \OpenAPI\Client\Model\UpdateSnapshotRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateSnapshot($x_request_id, $instance_id, $snapshot_id, $update_snapshot_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->updateSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **instance_id** | **int**| The identifier of the instance | |
| **snapshot_id** | **string**| The identifier of the snapshot | |
| **update_snapshot_request** | [**\OpenAPI\Client\Model\UpdateSnapshotRequest**](../Model/UpdateSnapshotRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UpdateSnapshotResponse**](../Model/UpdateSnapshotResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
