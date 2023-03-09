# OpenAPI\Client\PaymentMethodsApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**retrievePaymentMethodList()**](PaymentMethodsApi.md#retrievePaymentMethodList) | **GET** /v1/payment-methods | List payment methods |


## `retrievePaymentMethodList()`

```php
retrievePaymentMethodList($x_request_id, $x_trace_id, $page, $size, $order_by, $payment_method_id, $payment_method, $direct_debit): \OpenAPI\Client\Model\ListPaymentMethodResponse1
```

List payment methods

List payment methods that you can use to pay with.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\PaymentMethodsApi(
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
$payment_method_id = 1; // int | The id of the payment method
$payment_method = SEPA; // string | Payment method name
$direct_debit = true; // bool | Automatic debit from your payment method

try {
    $result = $apiInstance->retrievePaymentMethodList($x_request_id, $x_trace_id, $page, $size, $order_by, $payment_method_id, $payment_method, $direct_debit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PaymentMethodsApi->retrievePaymentMethodList: ', $e->getMessage(), PHP_EOL;
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
| **payment_method_id** | **int**| The id of the payment method | [optional] |
| **payment_method** | **string**| Payment method name | [optional] |
| **direct_debit** | **bool**| Automatic debit from your payment method | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListPaymentMethodResponse1**](../Model/ListPaymentMethodResponse1.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
