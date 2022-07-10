# OpenAPI\Client\TagAssignmentsApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createAssignment()**](TagAssignmentsApi.md#createAssignment) | **POST** /v1/tags/{tagId}/assignments/{resourceType}/{resourceId} | Create a new assignment for the tag
[**deleteAssignment()**](TagAssignmentsApi.md#deleteAssignment) | **DELETE** /v1/tags/{tagId}/assignments/{resourceType}/{resourceId} | Delete existing tag assignment
[**retrieveAssignment()**](TagAssignmentsApi.md#retrieveAssignment) | **GET** /v1/tags/{tagId}/assignments/{resourceType}/{resourceId} | Get specific assignment for the tag
[**retrieveAssignmentList()**](TagAssignmentsApi.md#retrieveAssignmentList) | **GET** /v1/tags/{tagId}/assignments | List tag assignments


## `createAssignment()`

```php
createAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id): \OpenAPI\Client\Model\CreateAssignmentResponse
```

Create a new assignment for the tag

Create a new tag assignment. This marks the specified resource with the specified tag for organizing purposes or to restrict access to that resource.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagAssignmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tag_id = 12345; // int | The identifier of the tag.
$resource_type = instance; // string | The identifier of the resource type. Resource type is one of `instance|image|object-storage`.
$resource_id = d65ecf3b-30db-4dc2-9e88-dfc21a14a6bc; // string | The identifier of the resource id
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagAssignmentsApi->createAssignment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **tag_id** | **int**| The identifier of the tag. |
 **resource_type** | **string**| The identifier of the resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. |
 **resource_id** | **string**| The identifier of the resource id |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\CreateAssignmentResponse**](../Model/CreateAssignmentResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteAssignment()`

```php
deleteAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id)
```

Delete existing tag assignment

Tag assignment will be removed from the specified resource. If this tag is being used for access restrictions the affected users will no longer be able to access that resource.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagAssignmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tag_id = 12345; // int | The identifier of the tag.
$resource_type = instance; // string | The identifier of the resource type. Resource type is one of `instance|image|object-storage`.
$resource_id = d65ecf3b-30db-4dc2-9e88-dfc21a14a6bc; // string | The identifier of the resource id
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling TagAssignmentsApi->deleteAssignment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **tag_id** | **int**| The identifier of the tag. |
 **resource_type** | **string**| The identifier of the resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. |
 **resource_id** | **string**| The identifier of the resource id |
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

## `retrieveAssignment()`

```php
retrieveAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id): \OpenAPI\Client\Model\FindAssignmentResponse
```

Get specific assignment for the tag

Get attributes for a specific tag assignment in your account. For this the resource type and resource id is required.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagAssignmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tag_id = 12345; // int | The identifier of the tag.
$resource_type = instance; // string | The identifier of the resource type. Resource type is one of `instance|image|object-storage`.
$resource_id = d65ecf3b-30db-4dc2-9e88-dfc21a14a6bc; // string | The identifier of the resource id
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveAssignment($x_request_id, $tag_id, $resource_type, $resource_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagAssignmentsApi->retrieveAssignment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **tag_id** | **int**| The identifier of the tag. |
 **resource_type** | **string**| The identifier of the resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. |
 **resource_id** | **string**| The identifier of the resource id |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\FindAssignmentResponse**](../Model/FindAssignmentResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveAssignmentList()`

```php
retrieveAssignmentList($x_request_id, $tag_id, $x_trace_id, $page, $size, $order_by, $resource_type): \OpenAPI\Client\Model\ListAssignmentResponse
```

List tag assignments

List and filter all existing assignments for a tag in your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\TagAssignmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$tag_id = 12345; // int | The identifier of the tag.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$order_by = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$resource_type = instance; // string | Filter as substring match for assignment resource type. Resource type is one of `instance|image|object-storage`.

try {
    $result = $apiInstance->retrieveAssignmentList($x_request_id, $tag_id, $x_trace_id, $page, $size, $order_by, $resource_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagAssignmentsApi->retrieveAssignmentList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **tag_id** | **int**| The identifier of the tag. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]
 **page** | **int**| Number of page to be fetched. | [optional]
 **size** | **int**| Number of elements per page. | [optional]
 **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional]
 **resource_type** | **string**| Filter as substring match for assignment resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListAssignmentResponse**](../Model/ListAssignmentResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
