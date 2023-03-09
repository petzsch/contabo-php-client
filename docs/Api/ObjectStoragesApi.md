# OpenAPI\Client\ObjectStoragesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**cancelObjectStorage()**](ObjectStoragesApi.md#cancelObjectStorage) | **PATCH** /v1/object-storages/{objectStorageId}/cancel | Cancels the specified object storage at the next possible date |
| [**createObjectStorage()**](ObjectStoragesApi.md#createObjectStorage) | **POST** /v1/object-storages | Create a new object storage |
| [**retrieveDataCenterList()**](ObjectStoragesApi.md#retrieveDataCenterList) | **GET** /v1/data-centers | List data centers |
| [**retrieveObjectStorage()**](ObjectStoragesApi.md#retrieveObjectStorage) | **GET** /v1/object-storages/{objectStorageId} | Get specific object storage by its id |
| [**retrieveObjectStorageList()**](ObjectStoragesApi.md#retrieveObjectStorageList) | **GET** /v1/object-storages | List all your object storages |
| [**retrieveObjectStoragesStats()**](ObjectStoragesApi.md#retrieveObjectStoragesStats) | **GET** /v1/object-storages/{objectStorageId}/stats | List usage statistics about the specified object storage |
| [**updateObjectStorage()**](ObjectStoragesApi.md#updateObjectStorage) | **PATCH** /v1/object-storages/{objectStorageId} | Modifies the display name of object storage |
| [**upgradeObjectStorage()**](ObjectStoragesApi.md#upgradeObjectStorage) | **POST** /v1/object-storages/{objectStorageId}/resize | Upgrade object storage size resp. update autoscaling settings. |


## `cancelObjectStorage()`

```php
cancelObjectStorage($x_request_id, $object_storage_id, $x_trace_id): \OpenAPI\Client\Model\CancelObjectStorageResponse
```

Cancels the specified object storage at the next possible date

Cancels the specified object storage at the next possible date. Please be aware of your contract periods.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$object_storage_id = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->cancelObjectStorage($x_request_id, $object_storage_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->cancelObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **object_storage_id** | **string**| The identifier of the object storage | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CancelObjectStorageResponse**](../Model/CancelObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createObjectStorage()`

```php
createObjectStorage($x_request_id, $create_object_storage_request, $x_trace_id): \OpenAPI\Client\Model\CreateObjectStorageResponse
```

Create a new object storage

Create / purchase a new object storage in your account. Please note that you can only buy one object storage per location. You can actually increase the object storage space via `POST` to `/v1/object-storages/{objectStorageId}/resize`

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_object_storage_request = new \OpenAPI\Client\Model\CreateObjectStorageRequest(); // \OpenAPI\Client\Model\CreateObjectStorageRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createObjectStorage($x_request_id, $create_object_storage_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->createObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_object_storage_request** | [**\OpenAPI\Client\Model\CreateObjectStorageRequest**](../Model/CreateObjectStorageRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateObjectStorageResponse**](../Model/CreateObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveDataCenterList()`

```php
retrieveDataCenterList($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug): \OpenAPI\Client\Model\ListDataCenterResponse
```

List data centers

List all data centers and their corresponding regions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
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
$slug = EU1; // string | Filter as match for data centers.
$name = European Union (Germany) 1; // string | Filter for Object Storages regions.
$region_name = European Union (Germany); // string | Filter for Object Storage region names.
$region_slug = EU; // string | Filter for Object Storage region slugs.

try {
    $result = $apiInstance->retrieveDataCenterList($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveDataCenterList: ', $e->getMessage(), PHP_EOL;
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
| **slug** | **string**| Filter as match for data centers. | [optional] |
| **name** | **string**| Filter for Object Storages regions. | [optional] |
| **region_name** | **string**| Filter for Object Storage region names. | [optional] |
| **region_slug** | **string**| Filter for Object Storage region slugs. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListDataCenterResponse**](../Model/ListDataCenterResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStorage()`

```php
retrieveObjectStorage($x_request_id, $object_storage_id, $x_trace_id): \OpenAPI\Client\Model\FindObjectStorageResponse
```

Get specific object storage by its id

Get data for a specific object storage on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$object_storage_id = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveObjectStorage($x_request_id, $object_storage_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **object_storage_id** | **string**| The identifier of the object storage | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindObjectStorageResponse**](../Model/FindObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStorageList()`

```php
retrieveObjectStorageList($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region): \OpenAPI\Client\Model\ListObjectStorageResponse
```

List all your object storages

List and filter all object storages in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
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
$data_center_name = European Union (Germany) 2; // string | Filter for Object Storage locations.
$s3_tenant_id = 2cd2e5e1444a41b0bed16c6410ecaa84; // string | Filter for Object Storage S3 tenantId.
$region = EU; // string | Filter for Object Storage by regions. Available regions: EU, US-central, SIN

try {
    $result = $apiInstance->retrieveObjectStorageList($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStorageList: ', $e->getMessage(), PHP_EOL;
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
| **data_center_name** | **string**| Filter for Object Storage locations. | [optional] |
| **s3_tenant_id** | **string**| Filter for Object Storage S3 tenantId. | [optional] |
| **region** | **string**| Filter for Object Storage by regions. Available regions: EU, US-central, SIN | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListObjectStorageResponse**](../Model/ListObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveObjectStoragesStats()`

```php
retrieveObjectStoragesStats($x_request_id, $object_storage_id, $x_trace_id): \OpenAPI\Client\Model\ObjectStoragesStatsResponse
```

List usage statistics about the specified object storage

List usage statistics about the specified object storage such as the number of objects uploaded / created, used object storage space. Please note that the usage statistics are updated regularly and are not live usage statistics.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$object_storage_id = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveObjectStoragesStats($x_request_id, $object_storage_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->retrieveObjectStoragesStats: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **object_storage_id** | **string**| The identifier of the object storage | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ObjectStoragesStatsResponse**](../Model/ObjectStoragesStatsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateObjectStorage()`

```php
updateObjectStorage($x_request_id, $object_storage_id, $patch_object_storage_request, $x_trace_id): \OpenAPI\Client\Model\CancelObjectStorageResponse
```

Modifies the display name of object storage

Modifies the display name of object storage. Display name must be unique.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$object_storage_id = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage
$patch_object_storage_request = new \OpenAPI\Client\Model\PatchObjectStorageRequest(); // \OpenAPI\Client\Model\PatchObjectStorageRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateObjectStorage($x_request_id, $object_storage_id, $patch_object_storage_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->updateObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **object_storage_id** | **string**| The identifier of the object storage | |
| **patch_object_storage_request** | [**\OpenAPI\Client\Model\PatchObjectStorageRequest**](../Model/PatchObjectStorageRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CancelObjectStorageResponse**](../Model/CancelObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `upgradeObjectStorage()`

```php
upgradeObjectStorage($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id): \OpenAPI\Client\Model\UpgradeObjectStorageResponse
```

Upgrade object storage size resp. update autoscaling settings.

Upgrade object storage size. You can also adjust the autoscaling settings for your object storage. Autoscaling allows you to automatically purchase storage capacity on a monthly basis up to the specified limit.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ObjectStoragesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$object_storage_id = 4a6f95be-2ac0-4e3c-8eed-0dc67afed640; // string | The identifier of the object storage
$upgrade_object_storage_request = new \OpenAPI\Client\Model\UpgradeObjectStorageRequest(); // \OpenAPI\Client\Model\UpgradeObjectStorageRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->upgradeObjectStorage($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectStoragesApi->upgradeObjectStorage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **object_storage_id** | **string**| The identifier of the object storage | |
| **upgrade_object_storage_request** | [**\OpenAPI\Client\Model\UpgradeObjectStorageRequest**](../Model/UpgradeObjectStorageRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UpgradeObjectStorageResponse**](../Model/UpgradeObjectStorageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
