# OpenAPI\Client\FirewallsAuditsApi

All URIs are relative to https://api.contabo.com.

Method | HTTP request | Description
------------- | ------------- | -------------
[**retrieveFirewallAuditsList()**](FirewallsAuditsApi.md#retrieveFirewallAuditsList) | **GET** /v1/firewalls/audits | List history about your Firewalls (audit)


## `retrieveFirewallAuditsList()`

```php
retrieveFirewallAuditsList($x_request_id, $x_trace_id, $page, $size, $order_by, $firewall_id, $request_id, $changed_by, $start_date, $end_date): \OpenAPI\Client\Model\ListFirewallAuditResponse
```

List history about your Firewalls (audit)

List and filters the history about your Firewalls.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\FirewallsAuditsApi(
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
$firewall_id = 1b943b25a-c8b5-4570-9135-4bbaa7615b812345; // string | The identifier of the Firewall.
$request_id = D5FD9FAF-58C0-4406-8F46-F449B8E4FEC3; // string | The requestId of the API call which led to the change.
$changed_by = 23cbb6d6-cb11-4330-bdff-7bb791df2e23; // string | User name which did the change.
$start_date = 2021-01-01; // \DateTime | Start of search time range.
$end_date = 2021-01-01; // \DateTime | End of search time range.

try {
    $result = $apiInstance->retrieveFirewallAuditsList($x_request_id, $x_trace_id, $page, $size, $order_by, $firewall_id, $request_id, $changed_by, $start_date, $end_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FirewallsAuditsApi->retrieveFirewallAuditsList: ', $e->getMessage(), PHP_EOL;
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
 **firewall_id** | **string**| The identifier of the Firewall. | [optional]
 **request_id** | **string**| The requestId of the API call which led to the change. | [optional]
 **changed_by** | **string**| User name which did the change. | [optional]
 **start_date** | **\DateTime**| Start of search time range. | [optional]
 **end_date** | **\DateTime**| End of search time range. | [optional]

### Return type

[**\OpenAPI\Client\Model\ListFirewallAuditResponse**](../Model/ListFirewallAuditResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
