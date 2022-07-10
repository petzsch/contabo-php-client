<?php
/**
 * ObjectStoragesApi
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Contabo API
 *
 * # Introduction  Contabo API allows you to manage your resources using HTTP requests. This documentation includes a set of HTTP endpoints that are designed to RESTful principles. Each endpoint includes descriptions, request syntax, and examples.  Contabo provides also a CLI tool which enables you to manage your resources easily from the command line. [CLI Download and  Installation instructions.](https://github.com/contabo/cntb)  ## Product documentation  If you are looking for description about the products themselves and their usage in general or for specific purposes, please check the [Contabo Product Documentation](https://docs.contabo.com/).  ## Getting Started  In order to use the Contabo API you will need the following credentials which are available from the [Customer Control Panel](https://my.contabo.com/api/details): 1. ClientId 2. ClientSecret 3. API User (your email address to login to the [Customer Control Panel](https://my.contabo.com/api/details)) 4. API Password (this is a new password which you'll set or change in the [Customer Control Panel](https://my.contabo.com/api/details))  You can either use the API directly or by using the `cntb` CLI (Command Line Interface) tool.  ### Using the API directly  #### Via `curl` for Linux/Unix like systems  This requires `curl` and `jq` in your shell (e.g. `bash`, `zsh`). Please replace the first four placeholders with actual values.  ```sh CLIENT_ID=<ClientId from Customer Control Panel> CLIENT_SECRET=<ClientSecret from Customer Control Panel> API_USER=<API User from Customer Control Panel> API_PASSWORD='<API Password from Customer Control Panel>' ACCESS_TOKEN=$(curl -d \"client_id=$CLIENT_ID\" -d \"client_secret=$CLIENT_SECRET\" --data-urlencode \"username=$API_USER\" --data-urlencode \"password=$API_PASSWORD\" -d 'grant_type=password' 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' | jq -r '.access_token') # get list of your instances curl -X GET -H \"Authorization: Bearer $ACCESS_TOKEN\" -H \"x-request-id: 51A87ECD-754E-4104-9C54-D01AD0F83406\" \"https://api.contabo.com/v1/compute/instances\" | jq ```  #### Via `PowerShell` for Windows  Please open `PowerShell` and execute the following code after replacing the first four placeholders with actual values.  ```powershell $client_id='<ClientId from Customer Control Panel>' $client_secret='<ClientSecret from Customer Control Panel>' $api_user='<API User from Customer Control Panel>' $api_password='<API Password from Customer Control Panel>' $body = @{grant_type='password' client_id=$client_id client_secret=$client_secret username=$api_user password=$api_password} $response = Invoke-WebRequest -Uri 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' -Method 'POST' -Body $body $access_token = (ConvertFrom-Json $([String]::new($response.Content))).access_token # get list of your instances $headers = @{} $headers.Add(\"Authorization\",\"Bearer $access_token\") $headers.Add(\"x-request-id\",\"51A87ECD-754E-4104-9C54-D01AD0F83406\") Invoke-WebRequest -Uri 'https://api.contabo.com/v1/compute/instances' -Method 'GET' -Headers $headers ```  ### Using the Contabo API via the `cntb` CLI tool  1. Download `cntb` for your operating system (MacOS, Windows and Linux supported) [here](https://github.com/contabo/cntb) 2. Unzip the downloaded file 3. You might move the executable to any location on your disk. You may update your `PATH` environment variable for easier invocation. 4. Configure it once to use your credentials                       ```sh    cntb config set-credentials --oauth2-clientid=<ClientId from Customer Control Panel> --oauth2-client-secret=<ClientSecret from Customer Control Panel> --oauth2-user=<API User from Customer Control Panel> --oauth2-password='<API Password from Customer Control Panel>'    ```  5. Use the CLI                       ```sh    # get list of your instances    cntb get instances    # help    cntb help    ```  ## API Overview  ### [Compute Mangement](#tag/Instances)  The Compute Management API allows you to manage compute resources (e.g. creation, deletion, starting, stopping) of VPS and VDS (please note that Storage VPS are not supported via API or CLI) as well as managing snapshots and custom images. It also offers you to take advantage of [cloud-init](https://cloud-init.io/) at least on our default / standard images (for custom images you'll need to provide cloud-init support packages). The API offers provisioning of cloud-init scripts via the `user_data` field.  Custom images must be provided in `.qcow2` or `.iso` format. This gives you even more flexibility for setting up your environment.  ### [Object Storage](#tag/Object-Storages)  The Object Storage API allows you to order, upgrade, cancel and control the auto-scaling feature for [S3](https://en.wikipedia.org/wiki/Amazon_S3) compatible object storage. You may also get some usage statistics. You can only buy one object storage per location. In case you need more storage space in a location you can purchase more space or enable the auto-scaling feature to purchase automatically more storage space up to the specified monthly limit.  Please note that this is not the S3 compatible API. It is not documented here. The S3 compatible API needs to be used with the corresponding credentials, namely an `access_key` and `secret_key`. Those can be retrieved by invoking the User Management API. All purchased object storages in different locations share the same credentials. You are free to use S3 compatible tools like [`aws`](https://aws.amazon.com/cli/) cli or similar.  ### [Private Networking](#tag/Private-Networks)  The Private Networking API allows you to manage private networks / Virtual Private Clouds (VPC) for your Cloud VPS and VDS (please note that Storage VPS are not supported via API or CLI). Having a private network allows the associated instances to have a private and direct network connection. The traffic won't leave the data center and cannot be accessed by any other instance.  With this feature you can create multi layer systems, e.g. having a database server being only accessible from your application servers in one private network and keep the database replication in a second, separate network. This increases the speed as the traffic is NOT routed to the internet and also security as the traffic is within it's own secured VLAN.  Adding a Cloud VPS or VDS to a private network requires a reinstallation to make sure that all relevant parts for private networking are in place. When adding the same instance to another private network it will require a restart in order to make additional virtual network interface cards (NICs) available.  Please note that for each instance being part of one or several private networks a payed add-on is required. You can automatically purchase it via the Compute Management API.  ### [Secrets Management](#tag/Secrets)  You can optionally save your passwords or public ssh keys using the Secrets Management API. You are not required to use it there will be no functional disadvantages.  By using that API you can easily reuse you public ssh keys when setting up different servers without the need to look them up every time. It can also be used to allow Contabo Supporters to access your machine without sending the passwords via potentially unsecure emails.  ### [User Management](#tag/Users)  If you need to allow other persons or automation scripts to access specific API endpoints resp. resources the User Management API comes into play. With that API you are able to manage users having possibly restricted access. You are free to define those restrictions to fit your needs. So beside an arbitrary number of users you basically define any number of so called `roles`. Roles allows access and must be one of the following types:  * `apiPermission`                      This allows you to specify a restriction to certain functions of an API by allowing control over POST (=Create), GET (=Read), PUT/PATCH (=Update) and DELETE (=Delete) methods for each API endpoint (URL) individually. * `resourcePermission`                      In order to restrict access to specific resources create a role with `resourcePermission` type by specifying any number of [tags](#tag-management). These tags need to be assigned to resources for them to take effect. E.g. a tag could be assigned to several compute resources. So that a user with that role (and of course access to the API endpoints via `apiPermission` role type) could only access those compute resources.  The `roles` are then assigned to a `user`. You can assign one or several roles regardless of the role's type. Of course you could also assign a user `admin` privileges without specifying any roles.  ### [Tag Management](#tag/Tags)  The Tag Management API allows you to manage your tags in order to organize your resources in a more convenient way. Simply assign a tag to resources like a compute resource to manage them.The assignments of tags to resources will also enable you to control access to these specific resources to users via the [User Management API](#user-management). For convenience reasons you might choose a color for tag. The Customer Control Panel will use that color to display the tags.  ## Requests  The Contabo API supports HTTP requests like mentioned below. Not every endpoint supports all methods. The allowed methods are listed within this documentation.  Method | Description ---    | --- GET    | To retrieve information about a resource, use the GET method.<br>The data is returned as a JSON object. GET methods are read-only and do not affect any resources. POST   | Issue a POST method to create a new object. Include all needed attributes in the request body encoded as JSON. PATCH  | Some resources support partial modification with PATCH,<br>which modifies specific attributes without updating the entire object representation. PUT    | Use the PUT method to update information about a resource.<br>PUT will set new values on the item without regard to their current values. DELETE | Use the DELETE method to destroy a resource in your account.<br>If it is not found, the operation will return a 4xx error and an appropriate message.  ## Responses  Usually the Contabo API should respond to your requests. The data returned is in [JSON](https://www.json.org/) format allowing easy processing in any programming language or tools.  As common for HTTP requests you will get back a so called HTTP status code. This gives you overall information about success or error. The following table lists common HTTP status codes.  Please note that the description of the endpoints and methods are not listing all possibly status codes in detail as they are generic. Only special return codes with their resp. response data are explicitly listed.  Response Code | Description --- | --- 200 | The response contains your requested information. 201 | Your request was accepted. The resource was created. 204 | Your request succeeded, there is no additional information returned. 400 | Your request was malformed. 401 | You did not supply valid authentication credentials. 402 | Request refused as it requires additional payed service. 403 | You are not allowed to perform the request. 404 | No results were found for your request or resource does not exist. 409 | Conflict with resources. For example violation of unique data constraints detected when trying to create or change resources. 429 | Rate-limit reached. Please wait for some time before doing more requests. 500 | We were unable to perform the request due to server-side problems. In such cases please retry or contact the support.  Not every endpoint returns data. For example DELETE requests usually don't return any data. All others do return data. For easy handling the return values consists of metadata denoted with and underscore (\"_\") like `_links` or `_pagination`. The actual data is returned in a field called `data`. For convenience reasons this `data` field is always returned as an array even if it consists of only one single element.  Some general details about Contabo API from [Contabo](https://contabo.com).  # Authentication  <!-- ReDoc-Inject: <security-definitions> -->
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@contabo.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * ObjectStoragesApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectStoragesApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation cancelObjectStorage
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CancelObjectStorageResponse
     */
    public function cancelObjectStorage($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        list($response) = $this->cancelObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id);
        return $response;
    }

    /**
     * Operation cancelObjectStorageWithHttpInfo
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CancelObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $request = $this->cancelObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\CancelObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CancelObjectStorageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CancelObjectStorageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\CancelObjectStorageResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\CancelObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelObjectStorageAsync
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsync($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        return $this->cancelObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelObjectStorageAsyncWithHttpInfo
     *
     * Cancels the specified object storage at the next possible date
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $returnType = '\OpenAPI\Client\Model\CancelObjectStorageResponse';
        $request = $this->cancelObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cancelObjectStorage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cancelObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling cancelObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.cancelObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        // verify the required parameter 'object_storage_id' is set
        if ($object_storage_id === null || (is_array($object_storage_id) && count($object_storage_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $object_storage_id when calling cancelObjectStorage'
            );
        }

        $resourcePath = '/v1/object-storages/{objectStorageId}/cancel';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }

        // path params
        if ($object_storage_id !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($object_storage_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createObjectStorage
     *
     * Create a new object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateObjectStorageRequest $create_object_storage_request create_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CreateObjectStorageResponse
     */
    public function createObjectStorage($x_request_id, $create_object_storage_request, $x_trace_id = null)
    {
        list($response) = $this->createObjectStorageWithHttpInfo($x_request_id, $create_object_storage_request, $x_trace_id);
        return $response;
    }

    /**
     * Operation createObjectStorageWithHttpInfo
     *
     * Create a new object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateObjectStorageRequest $create_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CreateObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createObjectStorageWithHttpInfo($x_request_id, $create_object_storage_request, $x_trace_id = null)
    {
        $request = $this->createObjectStorageRequest($x_request_id, $create_object_storage_request, $x_trace_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\OpenAPI\Client\Model\CreateObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CreateObjectStorageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CreateObjectStorageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\CreateObjectStorageResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\CreateObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createObjectStorageAsync
     *
     * Create a new object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateObjectStorageRequest $create_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageAsync($x_request_id, $create_object_storage_request, $x_trace_id = null)
    {
        return $this->createObjectStorageAsyncWithHttpInfo($x_request_id, $create_object_storage_request, $x_trace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createObjectStorageAsyncWithHttpInfo
     *
     * Create a new object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateObjectStorageRequest $create_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createObjectStorageAsyncWithHttpInfo($x_request_id, $create_object_storage_request, $x_trace_id = null)
    {
        $returnType = '\OpenAPI\Client\Model\CreateObjectStorageResponse';
        $request = $this->createObjectStorageRequest($x_request_id, $create_object_storage_request, $x_trace_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createObjectStorage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateObjectStorageRequest $create_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createObjectStorageRequest($x_request_id, $create_object_storage_request, $x_trace_id = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling createObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.createObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        // verify the required parameter 'create_object_storage_request' is set
        if ($create_object_storage_request === null || (is_array($create_object_storage_request) && count($create_object_storage_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_object_storage_request when calling createObjectStorage'
            );
        }

        $resourcePath = '/v1/object-storages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($create_object_storage_request)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($create_object_storage_request));
            } else {
                $httpBody = $create_object_storage_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveDataCenterList
     *
     * List data centers
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $slug Filter as match for data centers. (optional)
     * @param  string $name Filter for Object Storages regions. (optional)
     * @param  string $region_name Filter for Object Storage region names. (optional)
     * @param  string $region_slug Filter for Object Storage region slugs. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListDataCenterResponse
     */
    public function retrieveDataCenterList($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $slug = null, $name = null, $region_name = null, $region_slug = null)
    {
        list($response) = $this->retrieveDataCenterListWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug);
        return $response;
    }

    /**
     * Operation retrieveDataCenterListWithHttpInfo
     *
     * List data centers
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $slug Filter as match for data centers. (optional)
     * @param  string $name Filter for Object Storages regions. (optional)
     * @param  string $region_name Filter for Object Storage region names. (optional)
     * @param  string $region_slug Filter for Object Storage region slugs. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListDataCenterResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveDataCenterListWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $slug = null, $name = null, $region_name = null, $region_slug = null)
    {
        $request = $this->retrieveDataCenterListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ListDataCenterResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ListDataCenterResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ListDataCenterResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ListDataCenterResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListDataCenterResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveDataCenterListAsync
     *
     * List data centers
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $slug Filter as match for data centers. (optional)
     * @param  string $name Filter for Object Storages regions. (optional)
     * @param  string $region_name Filter for Object Storage region names. (optional)
     * @param  string $region_slug Filter for Object Storage region slugs. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDataCenterListAsync($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $slug = null, $name = null, $region_name = null, $region_slug = null)
    {
        return $this->retrieveDataCenterListAsyncWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveDataCenterListAsyncWithHttpInfo
     *
     * List data centers
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $slug Filter as match for data centers. (optional)
     * @param  string $name Filter for Object Storages regions. (optional)
     * @param  string $region_name Filter for Object Storage region names. (optional)
     * @param  string $region_slug Filter for Object Storage region slugs. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveDataCenterListAsyncWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $slug = null, $name = null, $region_name = null, $region_slug = null)
    {
        $returnType = '\OpenAPI\Client\Model\ListDataCenterResponse';
        $request = $this->retrieveDataCenterListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $slug, $name, $region_name, $region_slug);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveDataCenterList'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $slug Filter as match for data centers. (optional)
     * @param  string $name Filter for Object Storages regions. (optional)
     * @param  string $region_name Filter for Object Storage region names. (optional)
     * @param  string $region_slug Filter for Object Storage region slugs. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveDataCenterListRequest($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $slug = null, $name = null, $region_name = null, $region_slug = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveDataCenterList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.retrieveDataCenterList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        if ($slug !== null && strlen($slug) < 1) {
            throw new \InvalidArgumentException('invalid length for "$slug" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }

        if ($name !== null && strlen($name) < 1) {
            throw new \InvalidArgumentException('invalid length for "$name" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }

        if ($region_name !== null && strlen($region_name) < 1) {
            throw new \InvalidArgumentException('invalid length for "$region_name" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }

        if ($region_slug !== null && strlen($region_slug) < 1) {
            throw new \InvalidArgumentException('invalid length for "$region_slug" when calling ObjectStoragesApi.retrieveDataCenterList, must be bigger than or equal to 1.');
        }


        $resourcePath = '/v1/data-centers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $size,
            'size', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order_by,
            'orderBy', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $slug,
            'slug', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $region_name,
            'regionName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $region_slug,
            'regionSlug', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveObjectStorage
     *
     * Get specific object storage by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\FindObjectStorageResponse
     */
    public function retrieveObjectStorage($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        list($response) = $this->retrieveObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id);
        return $response;
    }

    /**
     * Operation retrieveObjectStorageWithHttpInfo
     *
     * Get specific object storage by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\FindObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $request = $this->retrieveObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\FindObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\FindObjectStorageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\FindObjectStorageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\FindObjectStorageResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\FindObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStorageAsync
     *
     * Get specific object storage by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageAsync($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        return $this->retrieveObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStorageAsyncWithHttpInfo
     *
     * Get specific object storage by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $returnType = '\OpenAPI\Client\Model\FindObjectStorageResponse';
        $request = $this->retrieveObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveObjectStorage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStorageRequest($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.retrieveObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        // verify the required parameter 'object_storage_id' is set
        if ($object_storage_id === null || (is_array($object_storage_id) && count($object_storage_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $object_storage_id when calling retrieveObjectStorage'
            );
        }

        $resourcePath = '/v1/object-storages/{objectStorageId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }

        // path params
        if ($object_storage_id !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($object_storage_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveObjectStorageList
     *
     * List all your Object Storages
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $data_center_name Filter for Object Storage locations. (optional)
     * @param  string $s3_tenant_id Filter for Object Storage S3 tenantId. (optional)
     * @param  string $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListObjectStorageResponse
     */
    public function retrieveObjectStorageList($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $data_center_name = null, $s3_tenant_id = null, $region = null)
    {
        list($response) = $this->retrieveObjectStorageListWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region);
        return $response;
    }

    /**
     * Operation retrieveObjectStorageListWithHttpInfo
     *
     * List all your Object Storages
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $data_center_name Filter for Object Storage locations. (optional)
     * @param  string $s3_tenant_id Filter for Object Storage S3 tenantId. (optional)
     * @param  string $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStorageListWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $data_center_name = null, $s3_tenant_id = null, $region = null)
    {
        $request = $this->retrieveObjectStorageListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ListObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ListObjectStorageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ListObjectStorageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ListObjectStorageResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ListObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStorageListAsync
     *
     * List all your Object Storages
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $data_center_name Filter for Object Storage locations. (optional)
     * @param  string $s3_tenant_id Filter for Object Storage S3 tenantId. (optional)
     * @param  string $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageListAsync($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $data_center_name = null, $s3_tenant_id = null, $region = null)
    {
        return $this->retrieveObjectStorageListAsyncWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStorageListAsyncWithHttpInfo
     *
     * List all your Object Storages
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $data_center_name Filter for Object Storage locations. (optional)
     * @param  string $s3_tenant_id Filter for Object Storage S3 tenantId. (optional)
     * @param  string $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStorageListAsyncWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $data_center_name = null, $s3_tenant_id = null, $region = null)
    {
        $returnType = '\OpenAPI\Client\Model\ListObjectStorageResponse';
        $request = $this->retrieveObjectStorageListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $data_center_name, $s3_tenant_id, $region);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveObjectStorageList'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $data_center_name Filter for Object Storage locations. (optional)
     * @param  string $s3_tenant_id Filter for Object Storage S3 tenantId. (optional)
     * @param  string $region Filter for Object Storage by regions. Available regions: EU, US-central, SIN (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStorageListRequest($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $data_center_name = null, $s3_tenant_id = null, $region = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveObjectStorageList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.retrieveObjectStorageList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        if ($data_center_name !== null && strlen($data_center_name) < 1) {
            throw new \InvalidArgumentException('invalid length for "$data_center_name" when calling ObjectStoragesApi.retrieveObjectStorageList, must be bigger than or equal to 1.');
        }


        $resourcePath = '/v1/object-storages';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $size,
            'size', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order_by,
            'orderBy', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $data_center_name,
            'dataCenterName', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $s3_tenant_id,
            's3TenantId', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $region,
            'region', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);

        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveObjectStoragesStats
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ObjectStoragesStatsResponse
     */
    public function retrieveObjectStoragesStats($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        list($response) = $this->retrieveObjectStoragesStatsWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id);
        return $response;
    }

    /**
     * Operation retrieveObjectStoragesStatsWithHttpInfo
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ObjectStoragesStatsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveObjectStoragesStatsWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $request = $this->retrieveObjectStoragesStatsRequest($x_request_id, $object_storage_id, $x_trace_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ObjectStoragesStatsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ObjectStoragesStatsResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ObjectStoragesStatsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ObjectStoragesStatsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ObjectStoragesStatsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveObjectStoragesStatsAsync
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStoragesStatsAsync($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        return $this->retrieveObjectStoragesStatsAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveObjectStoragesStatsAsyncWithHttpInfo
     *
     * List usage statistics about the specified object storage
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveObjectStoragesStatsAsyncWithHttpInfo($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        $returnType = '\OpenAPI\Client\Model\ObjectStoragesStatsResponse';
        $request = $this->retrieveObjectStoragesStatsRequest($x_request_id, $object_storage_id, $x_trace_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'retrieveObjectStoragesStats'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveObjectStoragesStatsRequest($x_request_id, $object_storage_id, $x_trace_id = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveObjectStoragesStats'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.retrieveObjectStoragesStats, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        // verify the required parameter 'object_storage_id' is set
        if ($object_storage_id === null || (is_array($object_storage_id) && count($object_storage_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $object_storage_id when calling retrieveObjectStoragesStats'
            );
        }

        $resourcePath = '/v1/object-storages/{objectStorageId}/stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }

        // path params
        if ($object_storage_id !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($object_storage_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation upgradeObjectStorage
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  \OpenAPI\Client\Model\UpgradeObjectStorageRequest $upgrade_object_storage_request upgrade_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\UpdateObjectStorageResponse
     */
    public function upgradeObjectStorage($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id = null)
    {
        list($response) = $this->upgradeObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id);
        return $response;
    }

    /**
     * Operation upgradeObjectStorageWithHttpInfo
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  \OpenAPI\Client\Model\UpgradeObjectStorageRequest $upgrade_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\UpdateObjectStorageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function upgradeObjectStorageWithHttpInfo($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id = null)
    {
        $request = $this->upgradeObjectStorageRequest($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\UpdateObjectStorageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\UpdateObjectStorageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UpdateObjectStorageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\UpdateObjectStorageResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UpdateObjectStorageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation upgradeObjectStorageAsync
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  \OpenAPI\Client\Model\UpgradeObjectStorageRequest $upgrade_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function upgradeObjectStorageAsync($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id = null)
    {
        return $this->upgradeObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation upgradeObjectStorageAsyncWithHttpInfo
     *
     * Upgrade object storage size resp. update autoscaling settings.
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  \OpenAPI\Client\Model\UpgradeObjectStorageRequest $upgrade_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function upgradeObjectStorageAsyncWithHttpInfo($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id = null)
    {
        $returnType = '\OpenAPI\Client\Model\UpdateObjectStorageResponse';
        $request = $this->upgradeObjectStorageRequest($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'upgradeObjectStorage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $object_storage_id The identifier of the object storage (required)
     * @param  \OpenAPI\Client\Model\UpgradeObjectStorageRequest $upgrade_object_storage_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function upgradeObjectStorageRequest($x_request_id, $object_storage_id, $upgrade_object_storage_request, $x_trace_id = null)
    {
        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling upgradeObjectStorage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ObjectStoragesApi.upgradeObjectStorage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }

        // verify the required parameter 'object_storage_id' is set
        if ($object_storage_id === null || (is_array($object_storage_id) && count($object_storage_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $object_storage_id when calling upgradeObjectStorage'
            );
        }
        // verify the required parameter 'upgrade_object_storage_request' is set
        if ($upgrade_object_storage_request === null || (is_array($upgrade_object_storage_request) && count($upgrade_object_storage_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $upgrade_object_storage_request when calling upgradeObjectStorage'
            );
        }

        $resourcePath = '/v1/object-storages/{objectStorageId}/resize';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['x-request-id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }
        // header params
        if ($x_trace_id !== null) {
            $headerParams['x-trace-id'] = ObjectSerializer::toHeaderValue($x_trace_id);
        }

        // path params
        if ($object_storage_id !== null) {
            $resourcePath = str_replace(
                '{' . 'objectStorageId' . '}',
                ObjectSerializer::toPathValue($object_storage_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($upgrade_object_storage_request)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($upgrade_object_storage_request));
            } else {
                $httpBody = $upgrade_object_storage_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
