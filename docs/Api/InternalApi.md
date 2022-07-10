# OpenAPI\Client\InternalApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTicket()**](InternalApi.md#createTicket) | **POST** /v1/create-ticket | Create a new support ticket
[**retrieveUserIsPasswordSet()**](InternalApi.md#retrieveUserIsPasswordSet) | **GET** /v1/users/is-password-set | Get user is password set status


## `createTicket()`

```php
createTicket($x_request_id, $create_ticket_request, $x_trace_id): \OpenAPI\Client\Model\CreateTicketResponse
```

Create a new support ticket

Create a new support ticket.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InternalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_ticket_request = new \OpenAPI\Client\Model\CreateTicketRequest(); // \OpenAPI\Client\Model\CreateTicketRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createTicket($x_request_id, $create_ticket_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalApi->createTicket: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **create_ticket_request** | [**\OpenAPI\Client\Model\CreateTicketRequest**](../Model/CreateTicketRequest.md)|  |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]

### Return type

[**\OpenAPI\Client\Model\CreateTicketResponse**](../Model/CreateTicketResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveUserIsPasswordSet()`

```php
retrieveUserIsPasswordSet($x_request_id, $x_trace_id, $user_id): \OpenAPI\Client\Model\FindUserIsPasswordSetResponse
```

Get user is password set status

Get info about idm user if the password is set.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\InternalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The user ID for checking if password is set for him

try {
    $result = $apiInstance->retrieveUserIsPasswordSet($x_request_id, $x_trace_id, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InternalApi->retrieveUserIsPasswordSet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]
 **user_id** | **string**| The user ID for checking if password is set for him | [optional]

### Return type

[**\OpenAPI\Client\Model\FindUserIsPasswordSetResponse**](../Model/FindUserIsPasswordSetResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
