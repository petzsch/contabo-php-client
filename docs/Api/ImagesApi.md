# OpenAPI\Client\ImagesApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createCustomImage()**](ImagesApi.md#createCustomImage) | **POST** /v1/compute/images | Provide a custom image |
| [**deleteImage()**](ImagesApi.md#deleteImage) | **DELETE** /v1/compute/images/{imageId} | Delete an uploaded custom image by its id |
| [**retrieveCustomImagesStats()**](ImagesApi.md#retrieveCustomImagesStats) | **GET** /v1/compute/images/stats | List statistics regarding the customer&#39;s custom images |
| [**retrieveImage()**](ImagesApi.md#retrieveImage) | **GET** /v1/compute/images/{imageId} | Get details about a specific image by its id |
| [**retrieveImageList()**](ImagesApi.md#retrieveImageList) | **GET** /v1/compute/images | List available standard and custom images |
| [**updateImage()**](ImagesApi.md#updateImage) | **PATCH** /v1/compute/images/{imageId} | Update custom image name by its id |


## `createCustomImage()`

```php
createCustomImage($x_request_id, $create_custom_image_request, $x_trace_id): \OpenAPI\Client\Model\CreateCustomImageResponse
```

Provide a custom image

In order to provide a custom image please specify an URL from where the image can be directly downloaded. A custom image must be in either `.iso` or `.qcow2` format. Other formats will be rejected. Please note that downloading can take a while depending on network speed resp. bandwidth and size of image. You can check the status by retrieving information about the image via a GET request. Download will be rejected if you have exceeded your limits.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_custom_image_request = new \OpenAPI\Client\Model\CreateCustomImageRequest(); // \OpenAPI\Client\Model\CreateCustomImageRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createCustomImage($x_request_id, $create_custom_image_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->createCustomImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_custom_image_request** | [**\OpenAPI\Client\Model\CreateCustomImageRequest**](../Model/CreateCustomImageRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateCustomImageResponse**](../Model/CreateCustomImageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteImage()`

```php
deleteImage($x_request_id, $image_id, $x_trace_id)
```

Delete an uploaded custom image by its id

Your are free to delete a previously uploaded custom images at any time.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$image_id = 9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d; // string | The identifier of the image
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteImage($x_request_id, $image_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->deleteImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **image_id** | **string**| The identifier of the image | |
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

## `retrieveCustomImagesStats()`

```php
retrieveCustomImagesStats($x_request_id, $x_trace_id): \OpenAPI\Client\Model\CustomImagesStatsResponse
```

List statistics regarding the customer's custom images

List statistics regarding the customer's custom images such as the number of custom images uploaded, used disk space, free available disk space and total available disk space

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveCustomImagesStats($x_request_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->retrieveCustomImagesStats: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CustomImagesStatsResponse**](../Model/CustomImagesStatsResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveImage()`

```php
retrieveImage($x_request_id, $image_id, $x_trace_id): \OpenAPI\Client\Model\FindImageResponse
```

Get details about a specific image by its id

Get details about a specific image. This could be either a standard or custom image. In case of an custom image you can also check the download status.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$image_id = 9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d; // string | The identifier of the image
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveImage($x_request_id, $image_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->retrieveImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **image_id** | **string**| The identifier of the image | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindImageResponse**](../Model/FindImageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveImageList()`

```php
retrieveImageList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image): \OpenAPI\Client\Model\ListImageResponse
```

List available standard and custom images

List and filter all available standard images provided by [Contabo](https://contabo.com) and your uploaded custom images.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
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
$name = Ubuntu; // string | The name of the image
$standard_image = true; // bool | Flag indicating that image is either a standard (true) or a custom image (false)

try {
    $result = $apiInstance->retrieveImageList($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->retrieveImageList: ', $e->getMessage(), PHP_EOL;
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
| **name** | **string**| The name of the image | [optional] |
| **standard_image** | **bool**| Flag indicating that image is either a standard (true) or a custom image (false) | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListImageResponse**](../Model/ListImageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateImage()`

```php
updateImage($x_request_id, $image_id, $update_custom_image_request, $x_trace_id): \OpenAPI\Client\Model\UpdateCustomImageResponse
```

Update custom image name by its id

Update name of the custom image.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$image_id = 9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d; // string | The identifier of the image
$update_custom_image_request = new \OpenAPI\Client\Model\UpdateCustomImageRequest(); // \OpenAPI\Client\Model\UpdateCustomImageRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateImage($x_request_id, $image_id, $update_custom_image_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->updateImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **image_id** | **string**| The identifier of the image | |
| **update_custom_image_request** | [**\OpenAPI\Client\Model\UpdateCustomImageRequest**](../Model/UpdateCustomImageRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UpdateCustomImageResponse**](../Model/UpdateCustomImageResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
