<?php
/**
 * ImagesApi
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
 * # Introduction  Contabo API allows you to manage your resources using HTTP requests. This documentation includes a set of HTTP endpoints that are designed to RESTful principles. Each endpoint includes descriptions, request syntax, and examples.  Contabo provides also a CLI tool which enables you to manage your resources easily from the command line. [CLI Download and  Installation instructions.](https://github.com/contabo/cntb)  ## Product documentation  If you are looking for description about the products themselves and their usage in general or for specific purposes, please check the [Contabo Product Documentation](https://docs.contabo.com/).  ## Getting Started  In order to use the Contabo API you will need the following credentials which are available from the [Customer Control Panel](https://my.contabo.com/api/details): 1. ClientId 2. ClientSecret 3. API User (your email address to login to the [Customer Control Panel](https://my.contabo.com/api/details)) 4. API Password (this is a new password which you'll set or change in the [Customer Control Panel](https://my.contabo.com/api/details))  You can either use the API directly or by using the `cntb` CLI (Command Line Interface) tool.  ### Using the API directly  #### Via `curl` for Linux/Unix like systems  This requires `curl` and `jq` in your shell (e.g. `bash`, `zsh`). Please replace the first four placeholders with actual values.  ```sh CLIENT_ID=<ClientId from Customer Control Panel> CLIENT_SECRET=<ClientSecret from Customer Control Panel> API_USER=<API User from Customer Control Panel> API_PASSWORD='<API Password from Customer Control Panel>' ACCESS_TOKEN=$(curl -d \"client_id=$CLIENT_ID\" -d \"client_secret=$CLIENT_SECRET\" --data-urlencode \"username=$API_USER\" --data-urlencode \"password=$API_PASSWORD\" -d 'grant_type=password' 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' | jq -r '.access_token') # get list of your instances curl -X GET -H \"Authorization: Bearer $ACCESS_TOKEN\" -H \"x-request-id: 51A87ECD-754E-4104-9C54-D01AD0F83406\" \"https://api.contabo.com/v1/compute/instances\" | jq ```  #### Via `PowerShell` for Windows  Please open `PowerShell` and execute the following code after replacing the first four placeholders with actual values.  ```powershell $client_id='<ClientId from Customer Control Panel>' $client_secret='<ClientSecret from Customer Control Panel>' $api_user='<API User from Customer Control Panel>' $api_password='<API Password from Customer Control Panel>' $body = @{grant_type='password' client_id=$client_id client_secret=$client_secret username=$api_user password=$api_password} $response = Invoke-WebRequest -Uri 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' -Method 'POST' -Body $body $access_token = (ConvertFrom-Json $([String]::new($response.Content))).access_token # get list of your instances $headers = @{} $headers.Add(\"Authorization\",\"Bearer $access_token\") $headers.Add(\"x-request-id\",\"51A87ECD-754E-4104-9C54-D01AD0F83406\") Invoke-WebRequest -Uri 'https://api.contabo.com/v1/compute/instances' -Method 'GET' -Headers $headers ```  ### Using the Contabo API via the `cntb` CLI tool  1. Download `cntb` for your operating system (MacOS, Windows and Linux supported) [here](https://github.com/contabo/cntb) 2. Unzip the downloaded file 3. You might move the executable to any location on your disk. You may update your `PATH` environment variable for easier invocation. 4. Configure it once to use your credentials                        ```sh    cntb config set-credentials --oauth2-clientid=<ClientId from Customer Control Panel> --oauth2-client-secret=<ClientSecret from Customer Control Panel> --oauth2-user=<API User from Customer Control Panel> --oauth2-password='<API Password from Customer Control Panel>'    ```  5. Use the CLI                        ```sh    # get list of your instances    cntb get instances    # help    cntb help    ```  ## API Overview  ### [Compute Management](#tag/Instances)  The Compute Management API allows you to manage compute resources (e.g. creation, deletion, starting, stopping) of VPS and VDS (please note that Storage VPS are not supported via API or CLI) as well as managing snapshots and custom images. It also offers you to take advantage of [cloud-init](https://cloud-init.io/) at least on our default / standard images (for custom images you'll need to provide cloud-init support packages). The API offers provisioning of cloud-init scripts via the `user_data` field.  Custom images must be provided in `.qcow2` or `.iso` format. This gives you even more flexibility for setting up your environment.  ### [Object Storage](#tag/Object-Storages)  The Object Storage API allows you to order, upgrade, cancel and control the auto-scaling feature for [S3](https://en.wikipedia.org/wiki/Amazon_S3) compatible object storage. You may also get some usage statistics. You can only buy one object storage per location. In case you need more storage space in a location you can purchase more space or enable the auto-scaling feature to purchase automatically more storage space up to the specified monthly limit.  Please note that this is not the S3 compatible API. It is not documented here. The S3 compatible API needs to be used with the corresponding credentials, namely an `access_key` and `secret_key`. Those can be retrieved by invoking the User Management API. All purchased object storages in different locations share the same credentials. You are free to use S3 compatible tools like [`aws`](https://aws.amazon.com/cli/) cli or similar.  ### [Private Networking](#tag/Private-Networks)  The Private Networking API allows you to manage private networks / Virtual Private Clouds (VPC) for your Cloud VPS and VDS (please note that Storage VPS are not supported via API or CLI). Having a private network allows the associated instances to have a private and direct network connection. The traffic won't leave the data center and cannot be accessed by any other instance.  With this feature you can create multi layer systems, e.g. having a database server being only accessible from your application servers in one private network and keep the database replication in a second, separate network. This increases the speed as the traffic is NOT routed to the internet and also security as the traffic is within it's own secured VLAN.  Adding a Cloud VPS or VDS to a private network requires a reinstallation to make sure that all relevant parts for private networking are in place. When adding the same instance to another private network it will require a restart in order to make additional virtual network interface cards (NICs) available.  Please note that for each instance being part of one or several private networks a payed add-on is required. You can automatically purchase it via the Compute Management API.  ### [Secrets Management](#tag/Secrets)  You can optionally save your passwords or public ssh keys using the Secrets Management API. You are not required to use it there will be no functional disadvantages.  By using that API you can easily reuse you public ssh keys when setting up different servers without the need to look them up every time. It can also be used to allow Contabo Supporters to access your machine without sending the passwords via potentially unsecure emails.  ### [User Management](#tag/Users)  If you need to allow other persons or automation scripts to access specific API endpoints resp. resources the User Management API comes into play. With that API you are able to manage users having possibly restricted access. You are free to define those restrictions to fit your needs. So beside an arbitrary number of users you basically define any number of so called `roles`. Roles allows access and must be one of the following types:  * `apiPermission`                       This allows you to specify a restriction to certain functions of an API by allowing control over POST (=Create), GET (=Read), PUT/PATCH (=Update) and DELETE (=Delete) methods for each API endpoint (URL) individually. * `resourcePermission`                       In order to restrict access to specific resources create a role with `resourcePermission` type by specifying any number of [tags](#tag-management). These tags need to be assigned to resources for them to take effect. E.g. a tag could be assigned to several compute resources. So that a user with that role (and of course access to the API endpoints via `apiPermission` role type) could only access those compute resources.  The `roles` are then assigned to a `user`. You can assign one or several roles regardless of the role's type. Of course you could also assign a user `admin` privileges without specifying any roles.  ### [Tag Management](#tag/Tags)  The Tag Management API allows you to manage your tags in order to organize your resources in a more convenient way. Simply assign a tag to resources like a compute resource to manage them.The assignments of tags to resources will also enable you to control access to these specific resources to users via the [User Management API](#user-management). For convenience reasons you might choose a color for tag. The Customer Control Panel will use that color to display the tags.  ## Requests  The Contabo API supports HTTP requests like mentioned below. Not every endpoint supports all methods. The allowed methods are listed within this documentation.  Method | Description ---    | --- GET    | To retrieve information about a resource, use the GET method.<br>The data is returned as a JSON object. GET methods are read-only and do not affect any resources. POST   | Issue a POST method to create a new object. Include all needed attributes in the request body encoded as JSON. PATCH  | Some resources support partial modification with PATCH,<br>which modifies specific attributes without updating the entire object representation. PUT    | Use the PUT method to update information about a resource.<br>PUT will set new values on the item without regard to their current values. DELETE | Use the DELETE method to destroy a resource in your account.<br>If it is not found, the operation will return a 4xx error and an appropriate message.  ## Responses  Usually the Contabo API should respond to your requests. The data returned is in [JSON](https://www.json.org/) format allowing easy processing in any programming language or tools.  As common for HTTP requests you will get back a so called HTTP status code. This gives you overall information about success or error. The following table lists common HTTP status codes.  Please note that the description of the endpoints and methods are not listing all possibly status codes in detail as they are generic. Only special return codes with their resp. response data are explicitly listed.  Response Code | Description --- | --- 200 | The response contains your requested information. 201 | Your request was accepted. The resource was created. 204 | Your request succeeded, there is no additional information returned. 400 | Your request was malformed. 401 | You did not supply valid authentication credentials. 402 | Request refused as it requires additional payed service. 403 | You are not allowed to perform the request. 404 | No results were found for your request or resource does not exist. 409 | Conflict with resources. For example violation of unique data constraints detected when trying to create or change resources. 429 | Rate-limit reached. Please wait for some time before doing more requests. 500 | We were unable to perform the request due to server-side problems. In such cases please retry or contact the support.  Not every endpoint returns data. For example DELETE requests usually don't return any data. All others do return data. For easy handling the return values consists of metadata denoted with and underscore (\"_\") like `_links` or `_pagination`. The actual data is returned in a field called `data`. For convenience reasons this `data` field is always returned as an array even if it consists of only one single element.  Some general details about Contabo API from [Contabo](https://contabo.com).  # Authentication  <!-- ReDoc-Inject: <security-definitions> -->
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@contabo.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.2.1
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
 * ImagesApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ImagesApi
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

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'createCustomImage' => [
            'application/json',
        ],
        'deleteImage' => [
            'application/json',
        ],
        'retrieveCustomImagesStats' => [
            'application/json',
        ],
        'retrieveImage' => [
            'application/json',
        ],
        'retrieveImageList' => [
            'application/json',
        ],
        'updateImage' => [
            'application/json',
        ],
    ];

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
     * Operation createCustomImage
     *
     * Provide a custom image
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateCustomImageRequest $create_custom_image_request create_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createCustomImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CreateCustomImageResponse|\OpenAPI\Client\Model\CreateCustomImageFailResponse
     */
    public function createCustomImage($x_request_id, $create_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['createCustomImage'][0])
    {
        list($response) = $this->createCustomImageWithHttpInfo($x_request_id, $create_custom_image_request, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation createCustomImageWithHttpInfo
     *
     * Provide a custom image
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateCustomImageRequest $create_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createCustomImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CreateCustomImageResponse|\OpenAPI\Client\Model\CreateCustomImageFailResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCustomImageWithHttpInfo($x_request_id, $create_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['createCustomImage'][0])
    {
        $request = $this->createCustomImageRequest($x_request_id, $create_custom_image_request, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\CreateCustomImageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CreateCustomImageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CreateCustomImageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 415:
                    if ('\OpenAPI\Client\Model\CreateCustomImageFailResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CreateCustomImageFailResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CreateCustomImageFailResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\CreateCustomImageResponse';
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
                        '\OpenAPI\Client\Model\CreateCustomImageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 415:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\CreateCustomImageFailResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createCustomImageAsync
     *
     * Provide a custom image
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateCustomImageRequest $create_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createCustomImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createCustomImageAsync($x_request_id, $create_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['createCustomImage'][0])
    {
        return $this->createCustomImageAsyncWithHttpInfo($x_request_id, $create_custom_image_request, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createCustomImageAsyncWithHttpInfo
     *
     * Provide a custom image
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateCustomImageRequest $create_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createCustomImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createCustomImageAsyncWithHttpInfo($x_request_id, $create_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['createCustomImage'][0])
    {
        $returnType = '\OpenAPI\Client\Model\CreateCustomImageResponse';
        $request = $this->createCustomImageRequest($x_request_id, $create_custom_image_request, $x_trace_id, $contentType);

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
     * Create request for operation 'createCustomImage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreateCustomImageRequest $create_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createCustomImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createCustomImageRequest($x_request_id, $create_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['createCustomImage'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling createCustomImage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.createCustomImage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'create_custom_image_request' is set
        if ($create_custom_image_request === null || (is_array($create_custom_image_request) && count($create_custom_image_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_custom_image_request when calling createCustomImage'
            );
        }



        $resourcePath = '/v1/compute/images';
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



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_custom_image_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($create_custom_image_request));
            } else {
                $httpBody = $create_custom_image_request;
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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteImage
     *
     * Delete an uploaded custom image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteImage($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['deleteImage'][0])
    {
        $this->deleteImageWithHttpInfo($x_request_id, $image_id, $x_trace_id, $contentType);
    }

    /**
     * Operation deleteImageWithHttpInfo
     *
     * Delete an uploaded custom image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteImageWithHttpInfo($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['deleteImage'][0])
    {
        $request = $this->deleteImageRequest($x_request_id, $image_id, $x_trace_id, $contentType);

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

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteImageAsync
     *
     * Delete an uploaded custom image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteImageAsync($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['deleteImage'][0])
    {
        return $this->deleteImageAsyncWithHttpInfo($x_request_id, $image_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteImageAsyncWithHttpInfo
     *
     * Delete an uploaded custom image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteImageAsyncWithHttpInfo($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['deleteImage'][0])
    {
        $returnType = '';
        $request = $this->deleteImageRequest($x_request_id, $image_id, $x_trace_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'deleteImage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteImageRequest($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['deleteImage'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling deleteImage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.deleteImage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling deleteImage'
            );
        }



        $resourcePath = '/v1/compute/images/{imageId}';
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
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'imageId' . '}',
                ObjectSerializer::toPathValue($image_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveCustomImagesStats
     *
     * List statistics regarding the customer&#39;s custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveCustomImagesStats'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CustomImagesStatsResponse
     */
    public function retrieveCustomImagesStats($x_request_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveCustomImagesStats'][0])
    {
        list($response) = $this->retrieveCustomImagesStatsWithHttpInfo($x_request_id, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation retrieveCustomImagesStatsWithHttpInfo
     *
     * List statistics regarding the customer&#39;s custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveCustomImagesStats'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CustomImagesStatsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveCustomImagesStatsWithHttpInfo($x_request_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveCustomImagesStats'][0])
    {
        $request = $this->retrieveCustomImagesStatsRequest($x_request_id, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\CustomImagesStatsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CustomImagesStatsResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CustomImagesStatsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\CustomImagesStatsResponse';
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
                        '\OpenAPI\Client\Model\CustomImagesStatsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveCustomImagesStatsAsync
     *
     * List statistics regarding the customer&#39;s custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveCustomImagesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveCustomImagesStatsAsync($x_request_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveCustomImagesStats'][0])
    {
        return $this->retrieveCustomImagesStatsAsyncWithHttpInfo($x_request_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveCustomImagesStatsAsyncWithHttpInfo
     *
     * List statistics regarding the customer&#39;s custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveCustomImagesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveCustomImagesStatsAsyncWithHttpInfo($x_request_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveCustomImagesStats'][0])
    {
        $returnType = '\OpenAPI\Client\Model\CustomImagesStatsResponse';
        $request = $this->retrieveCustomImagesStatsRequest($x_request_id, $x_trace_id, $contentType);

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
     * Create request for operation 'retrieveCustomImagesStats'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveCustomImagesStats'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveCustomImagesStatsRequest($x_request_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveCustomImagesStats'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveCustomImagesStats'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.retrieveCustomImagesStats, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        


        $resourcePath = '/v1/compute/images/stats';
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



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveImage
     *
     * Get details about a specific image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\FindImageResponse
     */
    public function retrieveImage($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveImage'][0])
    {
        list($response) = $this->retrieveImageWithHttpInfo($x_request_id, $image_id, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation retrieveImageWithHttpInfo
     *
     * Get details about a specific image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\FindImageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveImageWithHttpInfo($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveImage'][0])
    {
        $request = $this->retrieveImageRequest($x_request_id, $image_id, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\FindImageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\FindImageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\FindImageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\FindImageResponse';
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
                        '\OpenAPI\Client\Model\FindImageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveImageAsync
     *
     * Get details about a specific image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveImageAsync($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveImage'][0])
    {
        return $this->retrieveImageAsyncWithHttpInfo($x_request_id, $image_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveImageAsyncWithHttpInfo
     *
     * Get details about a specific image by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveImageAsyncWithHttpInfo($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveImage'][0])
    {
        $returnType = '\OpenAPI\Client\Model\FindImageResponse';
        $request = $this->retrieveImageRequest($x_request_id, $image_id, $x_trace_id, $contentType);

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
     * Create request for operation 'retrieveImage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveImageRequest($x_request_id, $image_id, $x_trace_id = null, string $contentType = self::contentTypes['retrieveImage'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveImage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.retrieveImage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling retrieveImage'
            );
        }



        $resourcePath = '/v1/compute/images/{imageId}';
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
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'imageId' . '}',
                ObjectSerializer::toPathValue($image_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation retrieveImageList
     *
     * List available standard and custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the image (optional)
     * @param  bool $standard_image Flag indicating that image is either a standard (true) or a custom image (false) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImageList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListImageResponse
     */
    public function retrieveImageList($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $standard_image = null, string $contentType = self::contentTypes['retrieveImageList'][0])
    {
        list($response) = $this->retrieveImageListWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image, $contentType);
        return $response;
    }

    /**
     * Operation retrieveImageListWithHttpInfo
     *
     * List available standard and custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the image (optional)
     * @param  bool $standard_image Flag indicating that image is either a standard (true) or a custom image (false) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImageList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListImageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrieveImageListWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $standard_image = null, string $contentType = self::contentTypes['retrieveImageList'][0])
    {
        $request = $this->retrieveImageListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image, $contentType);

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
                    if ('\OpenAPI\Client\Model\ListImageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ListImageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ListImageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ListImageResponse';
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
                        '\OpenAPI\Client\Model\ListImageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrieveImageListAsync
     *
     * List available standard and custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the image (optional)
     * @param  bool $standard_image Flag indicating that image is either a standard (true) or a custom image (false) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveImageListAsync($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $standard_image = null, string $contentType = self::contentTypes['retrieveImageList'][0])
    {
        return $this->retrieveImageListAsyncWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrieveImageListAsyncWithHttpInfo
     *
     * List available standard and custom images
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the image (optional)
     * @param  bool $standard_image Flag indicating that image is either a standard (true) or a custom image (false) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrieveImageListAsyncWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $standard_image = null, string $contentType = self::contentTypes['retrieveImageList'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ListImageResponse';
        $request = $this->retrieveImageListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $standard_image, $contentType);

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
     * Create request for operation 'retrieveImageList'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the image (optional)
     * @param  bool $standard_image Flag indicating that image is either a standard (true) or a custom image (false) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrieveImageList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrieveImageListRequest($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $standard_image = null, string $contentType = self::contentTypes['retrieveImageList'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrieveImageList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.retrieveImageList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        







        $resourcePath = '/v1/compute/images';
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
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $standard_image,
            'standardImage', // param base name
            'boolean', // openApiType
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



        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateImage
     *
     * Update custom image name by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  \OpenAPI\Client\Model\UpdateCustomImageRequest $update_custom_image_request update_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\UpdateCustomImageResponse
     */
    public function updateImage($x_request_id, $image_id, $update_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['updateImage'][0])
    {
        list($response) = $this->updateImageWithHttpInfo($x_request_id, $image_id, $update_custom_image_request, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation updateImageWithHttpInfo
     *
     * Update custom image name by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  \OpenAPI\Client\Model\UpdateCustomImageRequest $update_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateImage'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\UpdateCustomImageResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateImageWithHttpInfo($x_request_id, $image_id, $update_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['updateImage'][0])
    {
        $request = $this->updateImageRequest($x_request_id, $image_id, $update_custom_image_request, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\UpdateCustomImageResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\UpdateCustomImageResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UpdateCustomImageResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\UpdateCustomImageResponse';
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
                        '\OpenAPI\Client\Model\UpdateCustomImageResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateImageAsync
     *
     * Update custom image name by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  \OpenAPI\Client\Model\UpdateCustomImageRequest $update_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateImageAsync($x_request_id, $image_id, $update_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['updateImage'][0])
    {
        return $this->updateImageAsyncWithHttpInfo($x_request_id, $image_id, $update_custom_image_request, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateImageAsyncWithHttpInfo
     *
     * Update custom image name by its id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  \OpenAPI\Client\Model\UpdateCustomImageRequest $update_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateImageAsyncWithHttpInfo($x_request_id, $image_id, $update_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['updateImage'][0])
    {
        $returnType = '\OpenAPI\Client\Model\UpdateCustomImageResponse';
        $request = $this->updateImageRequest($x_request_id, $image_id, $update_custom_image_request, $x_trace_id, $contentType);

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
     * Create request for operation 'updateImage'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $image_id The identifier of the image (required)
     * @param  \OpenAPI\Client\Model\UpdateCustomImageRequest $update_custom_image_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateImageRequest($x_request_id, $image_id, $update_custom_image_request, $x_trace_id = null, string $contentType = self::contentTypes['updateImage'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling updateImage'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling ImagesApi.updateImage, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling updateImage'
            );
        }

        // verify the required parameter 'update_custom_image_request' is set
        if ($update_custom_image_request === null || (is_array($update_custom_image_request) && count($update_custom_image_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_custom_image_request when calling updateImage'
            );
        }



        $resourcePath = '/v1/compute/images/{imageId}';
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
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'imageId' . '}',
                ObjectSerializer::toPathValue($image_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_custom_image_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($update_custom_image_request));
            } else {
                $httpBody = $update_custom_image_request;
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

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
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

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
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
