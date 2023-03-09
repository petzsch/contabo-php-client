# OpenAPI\Client\RolesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createRole()**](RolesApi.md#createRole) | **POST** /v1/roles | Create a new role |
| [**deleteRole()**](RolesApi.md#deleteRole) | **DELETE** /v1/roles/{roleId} | Delete existing role by id |
| [**retrieveApiPermissionsList()**](RolesApi.md#retrieveApiPermissionsList) | **GET** /v1/roles/api-permissions | List of API permissions |
| [**retrieveRole()**](RolesApi.md#retrieveRole) | **GET** /v1/roles/{roleId} | Get specific role by id |
| [**retrieveRoleList()**](RolesApi.md#retrieveRoleList) | **GET** /v1/roles | List roles |
| [**updateRole()**](RolesApi.md#updateRole) | **PUT** /v1/roles/{roleId} | Update specific role by id |


## `createRole()`

```php
createRole($x_request_id, $create_role_request, $x_trace_id): \OpenAPI\Client\Model\CreateRoleResponse
```

Create a new role

Create a new role. In order to get a list availbale api enpoints (apiName) and their actions please refer to the GET api-permissions endpoint. For specifying `resources` please enter tag ids. For those to take effect please assign them to a resource in the tag management api.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_role_request = new \OpenAPI\Client\Model\CreateRoleRequest(); // \OpenAPI\Client\Model\CreateRoleRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createRole($x_request_id, $create_role_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->createRole: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_role_request** | [**\OpenAPI\Client\Model\CreateRoleRequest**](../Model/CreateRoleRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateRoleResponse**](../Model/CreateRoleResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteRole()`

```php
deleteRole($x_request_id, $role_id, $x_trace_id)
```

Delete existing role by id

You can't delete a role if it is still assigned to a user. In such cases please remove the role from the users.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$role_id = 12345; // int | The identifier of the role
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteRole($x_request_id, $role_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->deleteRole: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **role_id** | **int**| The identifier of the role | |
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

## `retrieveApiPermissionsList()`

```php
retrieveApiPermissionsList($x_request_id, $x_trace_id, $page, $size, $order_by, $api_name): \OpenAPI\Client\Model\ListApiPermissionResponse
```

List of API permissions

List all available API permissions. This list serves as a reference for specifying roles. As endpoints differ in their possibilities not all actions are available for each endpoint.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
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
$api_name = /v1/compute/instances; // string | The name of api

try {
    $result = $apiInstance->retrieveApiPermissionsList($x_request_id, $x_trace_id, $page, $size, $order_by, $api_name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->retrieveApiPermissionsList: ', $e->getMessage(), PHP_EOL;
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
| **api_name** | **string**| The name of api | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListApiPermissionResponse**](../Model/ListApiPermissionResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveRole()`

```php
retrieveRole($x_request_id, $role_id, $x_trace_id): \OpenAPI\Client\Model\FindRoleResponse
```

Get specific role by id

Get attributes of specific role.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$role_id = 12345; // int | The identifier of the role
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveRole($x_request_id, $role_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->retrieveRole: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **role_id** | **int**| The identifier of the role | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindRoleResponse**](../Model/FindRoleResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveRoleList()`

```php
retrieveRoleList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $api_name, $tag_name, $type): \OpenAPI\Client\Model\ListRoleResponse
```

List roles

List and filter all your roles. A role allows you to specify permission to api endpoints and resources like compute.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
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
$name = Web; // string | The name of the role
$api_name = /v1/compute/instances; // string | The name of api
$tag_name = Web; // string | The name of the tag
$type = custom; // string | The type of the tag. Can be either `default` or `custom`

try {
    $result = $apiInstance->retrieveRoleList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $api_name, $tag_name, $type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->retrieveRoleList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of the role | [optional] |
| **api_name** | **string**| The name of api | [optional] |
| **tag_name** | **string**| The name of the tag | [optional] |
| **type** | **string**| The type of the tag. Can be either &#x60;default&#x60; or &#x60;custom&#x60; | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListRoleResponse**](../Model/ListRoleResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateRole()`

```php
updateRole($x_request_id, $role_id, $update_role_request, $x_trace_id): \OpenAPI\Client\Model\UpdateRoleResponse
```

Update specific role by id

Update attributes to your role. Attributes are optional. If not set, the attributes will retain their original values.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\RolesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$role_id = 12345; // int | The identifier of the role
$update_role_request = new \OpenAPI\Client\Model\UpdateRoleRequest(); // \OpenAPI\Client\Model\UpdateRoleRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateRole($x_request_id, $role_id, $update_role_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RolesApi->updateRole: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **role_id** | **int**| The identifier of the role | |
| **update_role_request** | [**\OpenAPI\Client\Model\UpdateRoleRequest**](../Model/UpdateRoleRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UpdateRoleResponse**](../Model/UpdateRoleResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
