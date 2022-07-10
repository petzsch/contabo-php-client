# OpenAPI\Client\LedgerApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**retrieveLedgerEntriesList()**](LedgerApi.md#retrieveLedgerEntriesList) | **GET** /v1/ledger/ledger-entries | List ledger entries


## `retrieveLedgerEntriesList()`

```php
retrieveLedgerEntriesList($x_request_id, $x_trace_id, $page, $size, $order_by, $transaction_start_date, $transaction_end_date): \OpenAPI\Client\Model\ListLedgerEntriesReponse
```

List ledger entries

List all transactions for your account

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\LedgerApi(
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
$transaction_start_date = 2020-09-01; // string | Start date of the interval in which you want to see the transactions
$transaction_end_date = 2020-09-30; // string | Start date of the interval in which you want to see the transactions

try {
    $result = $apiInstance->retrieveLedgerEntriesList($x_request_id, $x_trace_id, $page, $size, $order_by, $transaction_start_date, $transaction_end_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgerApi->retrieveLedgerEntriesList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. |
 **x_trace_id** | **string**| Identifier to trace group of requests. | [optional]
 **page** | **int**| Number of page to be fetched. | [optional]
 **size** | **int**| Number of elements per page. | [optional]
 **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional]
 **transaction_start_date** | **string**| Start date of the interval in which you want to see the transactions | [optional]
 **transaction_end_date** | **string**| Start date of the interval in which you want to see the transactions | [optional]

### Return type

[**\OpenAPI\Client\Model\ListLedgerEntriesReponse**](../Model/ListLedgerEntriesReponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
