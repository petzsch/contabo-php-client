# OpenAPI\Client\DPASApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**concludeDpa()**](DPASApi.md#concludeDpa) | **POST** /v1/dpas/{dpaId}/conclude | Concludes a data processing agreement |
| [**createDpa()**](DPASApi.md#createDpa) | **POST** /v1/dpas | Create a new data processing agreement |
| [**downloadDpaFile()**](DPASApi.md#downloadDpaFile) | **GET** /v1/dpas/{dpaId}/download | Download concluded DPA PDF file |
| [**downloadPreviewDpa()**](DPASApi.md#downloadPreviewDpa) | **GET** /v1/dpas/{dpaId}/preview | Download preview version of DPA |
| [**listDpaServices()**](DPASApi.md#listDpaServices) | **GET** /v1/dpas/services | List services |
| [**retrieveDpa()**](DPASApi.md#retrieveDpa) | **GET** /v1/dpas/{dpaId} | Get specific Dpa by it&#39;s dpaId |
| [**retrieveDpaList()**](DPASApi.md#retrieveDpaList) | **GET** /v1/dpas | List all Dpas |
| [**terminateDpa()**](DPASApi.md#terminateDpa) | **POST** /v1/dpas/{dpaId}/terminate | Terminate an existing DPA by id |


## `concludeDpa()`

```php
concludeDpa($x_request_id, $dpa_id, $x_trace_id): \OpenAPI\Client\Model\DpaResponse
```

Concludes a data processing agreement

Concludes data processing agreement for a specific service that you own.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$dpa_id = 6C65CD0E-572F-4051-9161-0D731DB44B6E; // string | The identifier of the data processing agreement
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->concludeDpa($x_request_id, $dpa_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->concludeDpa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **dpa_id** | **string**| The identifier of the data processing agreement | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\DpaResponse**](../Model/DpaResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createDpa()`

```php
createDpa($x_request_id, $create_dpa_request, $x_trace_id): \OpenAPI\Client\Model\DpaResponse
```

Create a new data processing agreement

Create a new data processing agreement for a specific service that you own.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_dpa_request = new \OpenAPI\Client\Model\CreateDpaRequest(); // \OpenAPI\Client\Model\CreateDpaRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createDpa($x_request_id, $create_dpa_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->createDpa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_dpa_request** | [**\OpenAPI\Client\Model\CreateDpaRequest**](../Model/CreateDpaRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\DpaResponse**](../Model/DpaResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadDpaFile()`

```php
downloadDpaFile($x_request_id, $dpa_id, $x_trace_id, $content_disposition): object
```

Download concluded DPA PDF file

Download the data processing agreement PDF file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$dpa_id = 6C65CD0E-572F-4051-9161-0D731DB44B6E; // string | The identifier of the data processing agreement
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$content_disposition = inline; // string | Set the content dispotion header for download PDF or only preview it. Default is inline

try {
    $result = $apiInstance->downloadDpaFile($x_request_id, $dpa_id, $x_trace_id, $content_disposition);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->downloadDpaFile: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **dpa_id** | **string**| The identifier of the data processing agreement | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **content_disposition** | **string**| Set the content dispotion header for download PDF or only preview it. Default is inline | [optional] |

### Return type

**object**

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadPreviewDpa()`

```php
downloadPreviewDpa($x_request_id, $dpa_id, $x_trace_id, $content_disposition): object
```

Download preview version of DPA

Obtain a preview version pdf of the DPA.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$dpa_id = 6C65CD0E-572F-4051-9161-0D731DB44B6E; // string | The identifier of the data processing agreement
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$content_disposition = inline; // string | Set the content dispotion header for download PDF or only preview it. Default is inline

try {
    $result = $apiInstance->downloadPreviewDpa($x_request_id, $dpa_id, $x_trace_id, $content_disposition);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->downloadPreviewDpa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **dpa_id** | **string**| The identifier of the data processing agreement | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **content_disposition** | **string**| Set the content dispotion header for download PDF or only preview it. Default is inline | [optional] |

### Return type

**object**

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listDpaServices()`

```php
listDpaServices($x_request_id, $x_trace_id, $page, $size, $order_by, $search, $has_concluded_dpa): \OpenAPI\Client\Model\ListDpaServicesResponse
```

List services

List all services for which you can create a data processing agreement

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$order_by = serviceName:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`. Possible fields: `serviceName`, `ipAddress`, `displayName`
$search = MyVps2; // string | Filter services by `serviceName`, `ipAddress` or `displayName`
$has_concluded_dpa = false; // string | Filters services which already have a concluded DPA (hasConcludedDpa=true) or not (hasConcludedDpa=false)

try {
    $result = $apiInstance->listDpaServices($x_request_id, $x_trace_id, $page, $size, $order_by, $search, $has_concluded_dpa);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->listDpaServices: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. Possible fields: &#x60;serviceName&#x60;, &#x60;ipAddress&#x60;, &#x60;displayName&#x60; | [optional] |
| **search** | **string**| Filter services by &#x60;serviceName&#x60;, &#x60;ipAddress&#x60; or &#x60;displayName&#x60; | [optional] |
| **has_concluded_dpa** | **string**| Filters services which already have a concluded DPA (hasConcludedDpa&#x3D;true) or not (hasConcludedDpa&#x3D;false) | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListDpaServicesResponse**](../Model/ListDpaServicesResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveDpa()`

```php
retrieveDpa($x_request_id, $dpa_id, $x_trace_id): \OpenAPI\Client\Model\DpaResponse
```

Get specific Dpa by it's dpaId

Get data for a specific Dpa on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$dpa_id = 6C65CD0E-572F-4051-9161-0D731DB44B6E; // string | The identifier of the data processing agreement
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveDpa($x_request_id, $dpa_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->retrieveDpa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **dpa_id** | **string**| The identifier of the data processing agreement | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\DpaResponse**](../Model/DpaResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveDpaList()`

```php
retrieveDpaList($x_request_id, $x_trace_id, $page, $size, $order_by, $status, $search, $dpa_service_id): \OpenAPI\Client\Model\ListDpaResponse
```

List all Dpas

List and filter all Dpas on your account.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
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
$status = preview; // string | The status of the Dpa
$search = preview; // string | Filter dpas by `serviceName`, `dpaId` or `status`
$dpa_service_id = true; // string | The dpaServiceId by which we want to filter the Dpas

try {
    $result = $apiInstance->retrieveDpaList($x_request_id, $x_trace_id, $page, $size, $order_by, $status, $search, $dpa_service_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->retrieveDpaList: ', $e->getMessage(), PHP_EOL;
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
| **status** | **string**| The status of the Dpa | [optional] [default to &#39;concluded,invalid&#39;] |
| **search** | **string**| Filter dpas by &#x60;serviceName&#x60;, &#x60;dpaId&#x60; or &#x60;status&#x60; | [optional] |
| **dpa_service_id** | **string**| The dpaServiceId by which we want to filter the Dpas | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListDpaResponse**](../Model/ListDpaResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `terminateDpa()`

```php
terminateDpa($x_request_id, $dpa_id, $x_trace_id)
```

Terminate an existing DPA by id

Terminate an existing DPA for a specific service by id.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DPASApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$dpa_id = 6C65CD0E-572F-4051-9161-0D731DB44B6E; // string | The identifier of the data processing agreement
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->terminateDpa($x_request_id, $dpa_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling DPASApi->terminateDpa: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **dpa_id** | **string**| The identifier of the data processing agreement | |
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
