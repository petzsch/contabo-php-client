# OpenAPI\Client\UsersApi

All URIs are relative to https://api.contabo.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createUser()**](UsersApi.md#createUser) | **POST** /v1/users | Create a new user |
| [**deleteUser()**](UsersApi.md#deleteUser) | **DELETE** /v1/users/{userId} | Delete existing user by id |
| [**generateClientSecret()**](UsersApi.md#generateClientSecret) | **PUT** /v1/users/client/secret | Generate new client secret |
| [**getObjectStorageCredentials()**](UsersApi.md#getObjectStorageCredentials) | **GET** /v1/users/{userId}/object-storages/{objectStorageId}/credentials/{credentialId} | Get S3 compatible object storage credentials |
| [**listObjectStorageCredentials()**](UsersApi.md#listObjectStorageCredentials) | **GET** /v1/users/{userId}/object-storages/credentials | Get list of S3 compatible object storage credentials for user |
| [**regenerateCredentials()**](UsersApi.md#regenerateCredentials) | **PATCH** /v1/users/{userId}/object-storages/{objectStorageId}/credentials/{credentialId} | Regenerates secret key of specified user for the S3 compatible object storages |
| [**resendEmailVerification()**](UsersApi.md#resendEmailVerification) | **POST** /v1/users/{userId}/resend-email-verification | Resend email verification |
| [**resetPassword()**](UsersApi.md#resetPassword) | **POST** /v1/users/{userId}/reset-password | Send reset password email |
| [**retrieveUser()**](UsersApi.md#retrieveUser) | **GET** /v1/users/{userId} | Get specific user by id |
| [**retrieveUserClient()**](UsersApi.md#retrieveUserClient) | **GET** /v1/users/client | Get client |
| [**retrieveUserList()**](UsersApi.md#retrieveUserList) | **GET** /v1/users | List users |
| [**updateUser()**](UsersApi.md#updateUser) | **PATCH** /v1/users/{userId} | Update specific user by id |


## `createUser()`

```php
createUser($x_request_id, $create_user_request, $x_trace_id): \OpenAPI\Client\Model\CreateUserResponse
```

Create a new user

Create a new user with required attributes name, email, enabled, totp (=Two-factor authentication 2FA), admin (=access to all endpoints and resources), accessAllResources and roles. You can't specify any password / secrets for the user. For security reasons the user will have to specify secrets on his own.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$create_user_request = new \OpenAPI\Client\Model\CreateUserRequest(); // \OpenAPI\Client\Model\CreateUserRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->createUser($x_request_id, $create_user_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->createUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **create_user_request** | [**\OpenAPI\Client\Model\CreateUserRequest**](../Model/CreateUserRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\CreateUserResponse**](../Model/CreateUserResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteUser()`

```php
deleteUser($x_request_id, $user_id, $x_trace_id)
```

Delete existing user by id

By deleting a user he will not be able to access any endpoints or resources any longer. In order to temporarily disable a user please update its `enabled` attribute.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $apiInstance->deleteUser($x_request_id, $user_id, $x_trace_id);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->deleteUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
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

## `generateClientSecret()`

```php
generateClientSecret($x_request_id, $x_trace_id): \OpenAPI\Client\Model\GenerateClientSecretResponse
```

Generate new client secret

Generate and get new client secret.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->generateClientSecret($x_request_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->generateClientSecret: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\GenerateClientSecretResponse**](../Model/GenerateClientSecretResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getObjectStorageCredentials()`

```php
getObjectStorageCredentials($x_request_id, $user_id, $object_storage_id, $credential_id, $x_trace_id): \OpenAPI\Client\Model\FindCredentialResponse
```

Get S3 compatible object storage credentials

Get S3 compatible object storage credentials for accessing it via S3 compatible tools like `aws` cli.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$object_storage_id = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage
$credential_id = 12345; // int | The ID of the object storage credential
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->getObjectStorageCredentials($x_request_id, $user_id, $object_storage_id, $credential_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getObjectStorageCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **object_storage_id** | **string**| The identifier of the S3 object storage | |
| **credential_id** | **int**| The ID of the object storage credential | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindCredentialResponse**](../Model/FindCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listObjectStorageCredentials()`

```php
listObjectStorageCredentials($x_request_id, $user_id, $x_trace_id, $page, $size, $order_by, $object_storage_id): \OpenAPI\Client\Model\ListCredentialResponse
```

Get list of S3 compatible object storage credentials for user

Get list of S3 compatible object storage credentials for accessing it via S3 compatible tools like `aws` cli.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$page = 1; // int | Number of page to be fetched.
$size = 10; // int | Number of elements per page.
$order_by = name:asc; // string[] | Specify fields and ordering (ASC for ascending, DESC for descending) in following format `field:ASC|DESC`.
$object_storage_id = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage

try {
    $result = $apiInstance->listObjectStorageCredentials($x_request_id, $user_id, $x_trace_id, $page, $size, $order_by, $object_storage_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->listObjectStorageCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **page** | **int**| Number of page to be fetched. | [optional] |
| **size** | **int**| Number of elements per page. | [optional] |
| **order_by** | [**string[]**](../Model/string.md)| Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. | [optional] |
| **object_storage_id** | **string**| The identifier of the S3 object storage | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListCredentialResponse**](../Model/ListCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `regenerateCredentials()`

```php
regenerateCredentials($x_request_id, $user_id, $object_storage_id, $credential_id, $x_trace_id): \OpenAPI\Client\Model\FindCredentialResponse
```

Regenerates secret key of specified user for the S3 compatible object storages

Regenerates secret key of specified user for the a specific S3 compatible object storages.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$object_storage_id = d8417276-d2d9-43a9-a0a8-9a6fa6060246; // string | The identifier of the S3 object storage
$credential_id = 12345; // int | The ID of the object storage credential
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->regenerateCredentials($x_request_id, $user_id, $object_storage_id, $credential_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->regenerateCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **object_storage_id** | **string**| The identifier of the S3 object storage | |
| **credential_id** | **int**| The ID of the object storage credential | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindCredentialResponse**](../Model/FindCredentialResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resendEmailVerification()`

```php
resendEmailVerification($x_request_id, $user_id, $x_trace_id, $redirect_url)
```

Resend email verification

Resend email verification for a specific user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$redirect_url = https://test.contabo.de; // string | The redirect url used for email verification

try {
    $apiInstance->resendEmailVerification($x_request_id, $user_id, $x_trace_id, $redirect_url);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->resendEmailVerification: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **redirect_url** | **string**| The redirect url used for email verification | [optional] |

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

## `resetPassword()`

```php
resetPassword($x_request_id, $user_id, $x_trace_id, $redirect_url)
```

Send reset password email

Send reset password email for a specific user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.
$redirect_url = https://test.contabo.de; // string | The redirect url used for resetting password

try {
    $apiInstance->resetPassword($x_request_id, $user_id, $x_trace_id, $redirect_url);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->resetPassword: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |
| **redirect_url** | **string**| The redirect url used for resetting password | [optional] |

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

## `retrieveUser()`

```php
retrieveUser($x_request_id, $user_id, $x_trace_id): \OpenAPI\Client\Model\FindUserResponse
```

Get specific user by id

Get attributes for a specific user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveUser($x_request_id, $user_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->retrieveUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindUserResponse**](../Model/FindUserResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveUserClient()`

```php
retrieveUserClient($x_request_id, $x_trace_id): \OpenAPI\Client\Model\FindClientResponse
```

Get client

Get idm client.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->retrieveUserClient($x_request_id, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->retrieveUserClient: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\FindClientResponse**](../Model/FindClientResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `retrieveUserList()`

```php
retrieveUserList($x_request_id, $x_trace_id, $page, $size, $order_by, $email, $enabled, $owner): \OpenAPI\Client\Model\ListUserResponse
```

List users

List and filter all your users.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
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
$email = john.doe@example.com; // string | Filter as substring match for user emails.
$enabled = true; // bool | Filter if user is enabled or not.
$owner = true; // bool | Filter if user is owner or not.

try {
    $result = $apiInstance->retrieveUserList($x_request_id, $x_trace_id, $page, $size, $order_by, $email, $enabled, $owner);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->retrieveUserList: ', $e->getMessage(), PHP_EOL;
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
| **email** | **string**| Filter as substring match for user emails. | [optional] |
| **enabled** | **bool**| Filter if user is enabled or not. | [optional] |
| **owner** | **bool**| Filter if user is owner or not. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ListUserResponse**](../Model/ListUserResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateUser()`

```php
updateUser($x_request_id, $user_id, $update_user_request, $x_trace_id): \OpenAPI\Client\Model\UpdateUserResponse
```

Update specific user by id

Update attributes of a user. You may only specify the attributes you want to change. If an attribute is not set, it will retain its original value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_request_id = 04e0f898-37b4-48bc-a794-1a57abe6aa31; // string | [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually.
$user_id = 6cdf5968-f9fe-4192-97c2-f349e813c5e8; // string | The identifier of the user
$update_user_request = new \OpenAPI\Client\Model\UpdateUserRequest(); // \OpenAPI\Client\Model\UpdateUserRequest
$x_trace_id = 'x_trace_id_example'; // string | Identifier to trace group of requests.

try {
    $result = $apiInstance->updateUser($x_request_id, $user_id, $update_user_request, $x_trace_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->updateUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **x_request_id** | **string**| [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. | |
| **user_id** | **string**| The identifier of the user | |
| **update_user_request** | [**\OpenAPI\Client\Model\UpdateUserRequest**](../Model/UpdateUserRequest.md)|  | |
| **x_trace_id** | **string**| Identifier to trace group of requests. | [optional] |

### Return type

[**\OpenAPI\Client\Model\UpdateUserResponse**](../Model/UpdateUserResponse.md)

### Authorization

[bearer](../../README.md#bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
