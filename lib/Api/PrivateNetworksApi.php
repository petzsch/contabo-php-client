<?php
/**
 * PrivateNetworksApi
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
 * # Introduction  Contabo API allows you to manage your resources using HTTP requests. This documentation includes a set of HTTP endpoints that are designed to RESTful principles. Each endpoint includes descriptions, request syntax, and examples.  Contabo provides also a CLI tool which enables you to manage your resources easily from the command line. [CLI Download and  Installation instructions.](https://github.com/contabo/cntb)  ## Product documentation  If you are looking for description about the products themselves and their usage in general or for specific purposes, please check the [Contabo Product Documentation](https://docs.contabo.com/).  ## Getting Started  In order to use the Contabo API you will need the following credentials which are available from the [Customer Control Panel](https://my.contabo.com/api/details): 1. ClientId 2. ClientSecret 3. API User (your email address to login to the [Customer Control Panel](https://my.contabo.com/api/details)) 4. API Password (this is a new password which you'll set or change in the [Customer Control Panel](https://my.contabo.com/api/details))  You can either use the API directly or by using the `cntb` CLI (Command Line Interface) tool.  ### Using the API directly  #### Via `curl` for Linux/Unix like systems  This requires `curl` and `jq` in your shell (e.g. `bash`, `zsh`). Please replace the first four placeholders with actual values.  ```sh CLIENT_ID=<ClientId from Customer Control Panel> CLIENT_SECRET=<ClientSecret from Customer Control Panel> API_USER=<API User from Customer Control Panel> API_PASSWORD='<API Password from Customer Control Panel>' ACCESS_TOKEN=$(curl -d \"client_id=$CLIENT_ID\" -d \"client_secret=$CLIENT_SECRET\" --data-urlencode \"username=$API_USER\" --data-urlencode \"password=$API_PASSWORD\" -d 'grant_type=password' 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' | jq -r '.access_token') # get list of your instances curl -X GET -H \"Authorization: Bearer $ACCESS_TOKEN\" -H \"x-request-id: 51A87ECD-754E-4104-9C54-D01AD0F83406\" \"https://api.contabo.com/v1/compute/instances\" | jq ```  #### Via `PowerShell` for Windows  Please open `PowerShell` and execute the following code after replacing the first four placeholders with actual values.  ```powershell $client_id='<ClientId from Customer Control Panel>' $client_secret='<ClientSecret from Customer Control Panel>' $api_user='<API User from Customer Control Panel>' $api_password='<API Password from Customer Control Panel>' $body = @{grant_type='password' client_id=$client_id client_secret=$client_secret username=$api_user password=$api_password} $response = Invoke-WebRequest -Uri 'https://auth.contabo.com/auth/realms/contabo/protocol/openid-connect/token' -Method 'POST' -Body $body $access_token = (ConvertFrom-Json $([String]::new($response.Content))).access_token # get list of your instances $headers = @{} $headers.Add(\"Authorization\",\"Bearer $access_token\") $headers.Add(\"x-request-id\",\"51A87ECD-754E-4104-9C54-D01AD0F83406\") Invoke-WebRequest -Uri 'https://api.contabo.com/v1/compute/instances' -Method 'GET' -Headers $headers ```  ### Using the Contabo API via the `cntb` CLI tool  1. Download `cntb` for your operating system (MacOS, Windows and Linux supported) [here](https://github.com/contabo/cntb) 2. Unzip the downloaded file 3. You might move the executable to any location on your disk. You may update your `PATH` environment variable for easier invocation. 4. Configure it once to use your credentials              ```sh    cntb config set-credentials --oauth2-clientid=<ClientId from Customer Control Panel> --oauth2-client-secret=<ClientSecret from Customer Control Panel> --oauth2-user=<API User from Customer Control Panel> --oauth2-password='<API Password from Customer Control Panel>'    ```  5. Use the CLI              ```sh    # get list of your instances    cntb get instances    # help    cntb help    ```  ## API Overview  ### [Compute Management](#tag/Instances)  The Compute Management API allows you to manage compute resources (e.g. creation, deletion, starting, stopping) of VPS and VDS (please note that Storage VPS are not supported via API or CLI) as well as managing snapshots and custom images. It also offers you to take advantage of [cloud-init](https://cloud-init.io/) at least on our default / standard images (for custom images you'll need to provide cloud-init support packages). The API offers provisioning of cloud-init scripts via the `user_data` field.  Custom images must be provided in `.qcow2` or `.iso` format. This gives you even more flexibility for setting up your environment.  ### [Object Storage](#tag/Object-Storages)  The Object Storage API allows you to order, upgrade, cancel and control the auto-scaling feature for [S3](https://en.wikipedia.org/wiki/Amazon_S3) compatible object storage. You may also get some usage statistics. You can only buy one object storage per location. In case you need more storage space in a location you can purchase more space or enable the auto-scaling feature to purchase automatically more storage space up to the specified monthly limit.  Please note that this is not the S3 compatible API. It is not documented here. The S3 compatible API needs to be used with the corresponding credentials, namely an `access_key` and `secret_key`. Those can be retrieved by invoking the User Management API. All purchased object storages in different locations share the same credentials. You are free to use S3 compatible tools like [`aws`](https://aws.amazon.com/cli/) cli or similar.  ### [Private Networking](#tag/Private-Networks)  The Private Networking API allows you to manage private networks / Virtual Private Clouds (VPC) for your Cloud VPS and VDS (please note that Storage VPS are not supported via API or CLI). Having a private network allows the associated instances to have a private and direct network connection. The traffic won't leave the data center and cannot be accessed by any other instance.  With this feature you can create multi layer systems, e.g. having a database server being only accessible from your application servers in one private network and keep the database replication in a second, separate network. This increases the speed as the traffic is NOT routed to the internet and also security as the traffic is within it's own secured VLAN.  Adding a Cloud VPS or VDS to a private network requires a reinstallation to make sure that all relevant parts for private networking are in place. When adding the same instance to another private network it will require a restart in order to make additional virtual network interface cards (NICs) available.  Please note that for each instance being part of one or several private networks a payed add-on is required. You can automatically purchase it via the Compute Management API.  ### [Secrets Management](#tag/Secrets)  You can optionally save your passwords or public ssh keys using the Secrets Management API. You are not required to use it there will be no functional disadvantages.  By using that API you can easily reuse you public ssh keys when setting up different servers without the need to look them up every time. It can also be used to allow Contabo Supporters to access your machine without sending the passwords via potentially unsecure emails.  ### [User Management](#tag/Users)  If you need to allow other persons or automation scripts to access specific API endpoints resp. resources the User Management API comes into play. With that API you are able to manage users having possibly restricted access. You are free to define those restrictions to fit your needs. So beside an arbitrary number of users you basically define any number of so called `roles`. Roles allows access and must be one of the following types:  * `apiPermission`             This allows you to specify a restriction to certain functions of an API by allowing control over POST (=Create), GET (=Read), PUT/PATCH (=Update) and DELETE (=Delete) methods for each API endpoint (URL) individually. * `resourcePermission`             In order to restrict access to specific resources create a role with `resourcePermission` type by specifying any number of [tags](#tag-management). These tags need to be assigned to resources for them to take effect. E.g. a tag could be assigned to several compute resources. So that a user with that role (and of course access to the API endpoints via `apiPermission` role type) could only access those compute resources.  The `roles` are then assigned to a `user`. You can assign one or several roles regardless of the role's type. Of course you could also assign a user `admin` privileges without specifying any roles.  ### [Tag Management](#tag/Tags)  The Tag Management API allows you to manage your tags in order to organize your resources in a more convenient way. Simply assign a tag to resources like a compute resource to manage them.The assignments of tags to resources will also enable you to control access to these specific resources to users via the [User Management API](#user-management). For convenience reasons you might choose a color for tag. The Customer Control Panel will use that color to display the tags.  ## Requests  The Contabo API supports HTTP requests like mentioned below. Not every endpoint supports all methods. The allowed methods are listed within this documentation.  Method | Description ---    | --- GET    | To retrieve information about a resource, use the GET method.<br>The data is returned as a JSON object. GET methods are read-only and do not affect any resources. POST   | Issue a POST method to create a new object. Include all needed attributes in the request body encoded as JSON. PATCH  | Some resources support partial modification with PATCH,<br>which modifies specific attributes without updating the entire object representation. PUT    | Use the PUT method to update information about a resource.<br>PUT will set new values on the item without regard to their current values. DELETE | Use the DELETE method to destroy a resource in your account.<br>If it is not found, the operation will return a 4xx error and an appropriate message.  ## Responses  Usually the Contabo API should respond to your requests. The data returned is in [JSON](https://www.json.org/) format allowing easy processing in any programming language or tools.  As common for HTTP requests you will get back a so called HTTP status code. This gives you overall information about success or error. The following table lists common HTTP status codes.  Please note that the description of the endpoints and methods are not listing all possibly status codes in detail as they are generic. Only special return codes with their resp. response data are explicitly listed.  Response Code | Description --- | --- 200 | The response contains your requested information. 201 | Your request was accepted. The resource was created. 204 | Your request succeeded, there is no additional information returned. 400 | Your request was malformed. 401 | You did not supply valid authentication credentials. 402 | Request refused as it requires additional payed service. 403 | You are not allowed to perform the request. 404 | No results were found for your request or resource does not exist. 409 | Conflict with resources. For example violation of unique data constraints detected when trying to create or change resources. 429 | Rate-limit reached. Please wait for some time before doing more requests. 500 | We were unable to perform the request due to server-side problems. In such cases please retry or contact the support.  Not every endpoint returns data. For example DELETE requests usually don't return any data. All others do return data. For easy handling the return values consists of metadata denoted with and underscore (\"_\") like `_links` or `_pagination`. The actual data is returned in a field called `data`. For convenience reasons this `data` field is always returned as an array even if it consists of only one single element.  Some general details about Contabo API from [Contabo](https://contabo.com).
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@contabo.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.6.0
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
 * PrivateNetworksApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PrivateNetworksApi
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
        'assignInstancePrivateNetwork' => [
            'application/json',
        ],
        'createPrivateNetwork' => [
            'application/json',
        ],
        'deletePrivateNetwork' => [
            'application/json',
        ],
        'patchPrivateNetwork' => [
            'application/json',
        ],
        'retrievePrivateNetwork' => [
            'application/json',
        ],
        'retrievePrivateNetworkList' => [
            'application/json',
        ],
        'unassignInstancePrivateNetwork' => [
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
     * Operation assignInstancePrivateNetwork
     *
     * Add instance to a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse
     */
    public function assignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['assignInstancePrivateNetwork'][0])
    {
        list($response) = $this->assignInstancePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation assignInstancePrivateNetworkWithHttpInfo
     *
     * Add instance to a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function assignInstancePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['assignInstancePrivateNetwork'][0])
    {
        $request = $this->assignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation assignInstancePrivateNetworkAsync
     *
     * Add instance to a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function assignInstancePrivateNetworkAsync($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['assignInstancePrivateNetwork'][0])
    {
        return $this->assignInstancePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation assignInstancePrivateNetworkAsyncWithHttpInfo
     *
     * Add instance to a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function assignInstancePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['assignInstancePrivateNetwork'][0])
    {
        $returnType = '\OpenAPI\Client\Model\AssignInstancePrivateNetworkResponse';
        $request = $this->assignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);

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
     * Create request for operation 'assignInstancePrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['assignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function assignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['assignInstancePrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling assignInstancePrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.assignInstancePrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'private_network_id' is set
        if ($private_network_id === null || (is_array($private_network_id) && count($private_network_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $private_network_id when calling assignInstancePrivateNetwork'
            );
        }

        // verify the required parameter 'instance_id' is set
        if ($instance_id === null || (is_array($instance_id) && count($instance_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instance_id when calling assignInstancePrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks/{privateNetworkId}/instances/{instanceId}';
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
        if ($private_network_id !== null) {
            $resourcePath = str_replace(
                '{' . 'privateNetworkId' . '}',
                ObjectSerializer::toPathValue($private_network_id),
                $resourcePath
            );
        }
        // path params
        if ($instance_id !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceId' . '}',
                ObjectSerializer::toPathValue($instance_id),
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation createPrivateNetwork
     *
     * Create a new Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreatePrivateNetworkRequest $create_private_network_request create_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\CreatePrivateNetworkResponse
     */
    public function createPrivateNetwork($x_request_id, $create_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['createPrivateNetwork'][0])
    {
        list($response) = $this->createPrivateNetworkWithHttpInfo($x_request_id, $create_private_network_request, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation createPrivateNetworkWithHttpInfo
     *
     * Create a new Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreatePrivateNetworkRequest $create_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\CreatePrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createPrivateNetworkWithHttpInfo($x_request_id, $create_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['createPrivateNetwork'][0])
    {
        $request = $this->createPrivateNetworkRequest($x_request_id, $create_private_network_request, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\CreatePrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\CreatePrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\CreatePrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\CreatePrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\CreatePrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createPrivateNetworkAsync
     *
     * Create a new Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreatePrivateNetworkRequest $create_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPrivateNetworkAsync($x_request_id, $create_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['createPrivateNetwork'][0])
    {
        return $this->createPrivateNetworkAsyncWithHttpInfo($x_request_id, $create_private_network_request, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createPrivateNetworkAsyncWithHttpInfo
     *
     * Create a new Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreatePrivateNetworkRequest $create_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPrivateNetworkAsyncWithHttpInfo($x_request_id, $create_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['createPrivateNetwork'][0])
    {
        $returnType = '\OpenAPI\Client\Model\CreatePrivateNetworkResponse';
        $request = $this->createPrivateNetworkRequest($x_request_id, $create_private_network_request, $x_trace_id, $contentType);

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
     * Create request for operation 'createPrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  \OpenAPI\Client\Model\CreatePrivateNetworkRequest $create_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createPrivateNetworkRequest($x_request_id, $create_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['createPrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling createPrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.createPrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'create_private_network_request' is set
        if ($create_private_network_request === null || (is_array($create_private_network_request) && count($create_private_network_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_private_network_request when calling createPrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks';
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
        if (isset($create_private_network_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_private_network_request));
            } else {
                $httpBody = $create_private_network_request;
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation deletePrivateNetwork
     *
     * Delete existing Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deletePrivateNetwork($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['deletePrivateNetwork'][0])
    {
        $this->deletePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $x_trace_id, $contentType);
    }

    /**
     * Operation deletePrivateNetworkWithHttpInfo
     *
     * Delete existing Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deletePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['deletePrivateNetwork'][0])
    {
        $request = $this->deletePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id, $contentType);

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
     * Operation deletePrivateNetworkAsync
     *
     * Delete existing Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePrivateNetworkAsync($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['deletePrivateNetwork'][0])
    {
        return $this->deletePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deletePrivateNetworkAsyncWithHttpInfo
     *
     * Delete existing Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['deletePrivateNetwork'][0])
    {
        $returnType = '';
        $request = $this->deletePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id, $contentType);

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
     * Create request for operation 'deletePrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deletePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['deletePrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling deletePrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.deletePrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'private_network_id' is set
        if ($private_network_id === null || (is_array($private_network_id) && count($private_network_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $private_network_id when calling deletePrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks/{privateNetworkId}';
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
        if ($private_network_id !== null) {
            $resourcePath = str_replace(
                '{' . 'privateNetworkId' . '}',
                ObjectSerializer::toPathValue($private_network_id),
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation patchPrivateNetwork
     *
     * Update a Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  \OpenAPI\Client\Model\PatchPrivateNetworkRequest $patch_private_network_request patch_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\PatchPrivateNetworkResponse
     */
    public function patchPrivateNetwork($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['patchPrivateNetwork'][0])
    {
        list($response) = $this->patchPrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation patchPrivateNetworkWithHttpInfo
     *
     * Update a Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  \OpenAPI\Client\Model\PatchPrivateNetworkRequest $patch_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\PatchPrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchPrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['patchPrivateNetwork'][0])
    {
        $request = $this->patchPrivateNetworkRequest($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\PatchPrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\PatchPrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\PatchPrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\PatchPrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\PatchPrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation patchPrivateNetworkAsync
     *
     * Update a Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  \OpenAPI\Client\Model\PatchPrivateNetworkRequest $patch_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchPrivateNetworkAsync($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['patchPrivateNetwork'][0])
    {
        return $this->patchPrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchPrivateNetworkAsyncWithHttpInfo
     *
     * Update a Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  \OpenAPI\Client\Model\PatchPrivateNetworkRequest $patch_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchPrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['patchPrivateNetwork'][0])
    {
        $returnType = '\OpenAPI\Client\Model\PatchPrivateNetworkResponse';
        $request = $this->patchPrivateNetworkRequest($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id, $contentType);

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
     * Create request for operation 'patchPrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  \OpenAPI\Client\Model\PatchPrivateNetworkRequest $patch_private_network_request (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchPrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function patchPrivateNetworkRequest($x_request_id, $private_network_id, $patch_private_network_request, $x_trace_id = null, string $contentType = self::contentTypes['patchPrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling patchPrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.patchPrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'private_network_id' is set
        if ($private_network_id === null || (is_array($private_network_id) && count($private_network_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $private_network_id when calling patchPrivateNetwork'
            );
        }

        // verify the required parameter 'patch_private_network_request' is set
        if ($patch_private_network_request === null || (is_array($patch_private_network_request) && count($patch_private_network_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $patch_private_network_request when calling patchPrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks/{privateNetworkId}';
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
        if ($private_network_id !== null) {
            $resourcePath = str_replace(
                '{' . 'privateNetworkId' . '}',
                ObjectSerializer::toPathValue($private_network_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($patch_private_network_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($patch_private_network_request));
            } else {
                $httpBody = $patch_private_network_request;
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation retrievePrivateNetwork
     *
     * Get specific Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\FindPrivateNetworkResponse
     */
    public function retrievePrivateNetwork($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['retrievePrivateNetwork'][0])
    {
        list($response) = $this->retrievePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation retrievePrivateNetworkWithHttpInfo
     *
     * Get specific Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\FindPrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrievePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['retrievePrivateNetwork'][0])
    {
        $request = $this->retrievePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\FindPrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\FindPrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\FindPrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\FindPrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\FindPrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrievePrivateNetworkAsync
     *
     * Get specific Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePrivateNetworkAsync($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['retrievePrivateNetwork'][0])
    {
        return $this->retrievePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrievePrivateNetworkAsyncWithHttpInfo
     *
     * Get specific Private Network by id
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['retrievePrivateNetwork'][0])
    {
        $returnType = '\OpenAPI\Client\Model\FindPrivateNetworkResponse';
        $request = $this->retrievePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id, $contentType);

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
     * Create request for operation 'retrievePrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrievePrivateNetworkRequest($x_request_id, $private_network_id, $x_trace_id = null, string $contentType = self::contentTypes['retrievePrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrievePrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.retrievePrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'private_network_id' is set
        if ($private_network_id === null || (is_array($private_network_id) && count($private_network_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $private_network_id when calling retrievePrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks/{privateNetworkId}';
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
        if ($private_network_id !== null) {
            $resourcePath = str_replace(
                '{' . 'privateNetworkId' . '}',
                ObjectSerializer::toPathValue($private_network_id),
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation retrievePrivateNetworkList
     *
     * List Private Networks
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the Private Network (optional)
     * @param  string $instance_ids Comma separated instances identifiers (optional)
     * @param  string $region The slug of the region where your Private Network is located (optional)
     * @param  string $data_center The data center where your Private Network is located (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetworkList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ListPrivateNetworkResponse
     */
    public function retrievePrivateNetworkList($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $instance_ids = null, $region = null, $data_center = null, string $contentType = self::contentTypes['retrievePrivateNetworkList'][0])
    {
        list($response) = $this->retrievePrivateNetworkListWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids, $region, $data_center, $contentType);
        return $response;
    }

    /**
     * Operation retrievePrivateNetworkListWithHttpInfo
     *
     * List Private Networks
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the Private Network (optional)
     * @param  string $instance_ids Comma separated instances identifiers (optional)
     * @param  string $region The slug of the region where your Private Network is located (optional)
     * @param  string $data_center The data center where your Private Network is located (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetworkList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ListPrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function retrievePrivateNetworkListWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $instance_ids = null, $region = null, $data_center = null, string $contentType = self::contentTypes['retrievePrivateNetworkList'][0])
    {
        $request = $this->retrievePrivateNetworkListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids, $region, $data_center, $contentType);

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
                    if ('\OpenAPI\Client\Model\ListPrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ListPrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ListPrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ListPrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\ListPrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation retrievePrivateNetworkListAsync
     *
     * List Private Networks
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the Private Network (optional)
     * @param  string $instance_ids Comma separated instances identifiers (optional)
     * @param  string $region The slug of the region where your Private Network is located (optional)
     * @param  string $data_center The data center where your Private Network is located (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetworkList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePrivateNetworkListAsync($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $instance_ids = null, $region = null, $data_center = null, string $contentType = self::contentTypes['retrievePrivateNetworkList'][0])
    {
        return $this->retrievePrivateNetworkListAsyncWithHttpInfo($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids, $region, $data_center, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation retrievePrivateNetworkListAsyncWithHttpInfo
     *
     * List Private Networks
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the Private Network (optional)
     * @param  string $instance_ids Comma separated instances identifiers (optional)
     * @param  string $region The slug of the region where your Private Network is located (optional)
     * @param  string $data_center The data center where your Private Network is located (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetworkList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function retrievePrivateNetworkListAsyncWithHttpInfo($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $instance_ids = null, $region = null, $data_center = null, string $contentType = self::contentTypes['retrievePrivateNetworkList'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ListPrivateNetworkResponse';
        $request = $this->retrievePrivateNetworkListRequest($x_request_id, $x_trace_id, $page, $size, $order_by, $name, $instance_ids, $region, $data_center, $contentType);

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
     * Create request for operation 'retrievePrivateNetworkList'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  int $page Number of page to be fetched. (optional)
     * @param  int $size Number of elements per page. (optional)
     * @param  string[] $order_by Specify fields and ordering (ASC for ascending, DESC for descending) in following format &#x60;field:ASC|DESC&#x60;. (optional)
     * @param  string $name The name of the Private Network (optional)
     * @param  string $instance_ids Comma separated instances identifiers (optional)
     * @param  string $region The slug of the region where your Private Network is located (optional)
     * @param  string $data_center The data center where your Private Network is located (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['retrievePrivateNetworkList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function retrievePrivateNetworkListRequest($x_request_id, $x_trace_id = null, $page = null, $size = null, $order_by = null, $name = null, $instance_ids = null, $region = null, $data_center = null, string $contentType = self::contentTypes['retrievePrivateNetworkList'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling retrievePrivateNetworkList'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.retrievePrivateNetworkList, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        









        $resourcePath = '/v1/private-networks';
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
            $instance_ids,
            'instanceIds', // param base name
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
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $data_center,
            'dataCenter', // param base name
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation unassignInstancePrivateNetwork
     *
     * Remove instance from a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse
     */
    public function unassignInstancePrivateNetwork($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['unassignInstancePrivateNetwork'][0])
    {
        list($response) = $this->unassignInstancePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);
        return $response;
    }

    /**
     * Operation unassignInstancePrivateNetworkWithHttpInfo
     *
     * Remove instance from a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function unassignInstancePrivateNetworkWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['unassignInstancePrivateNetwork'][0])
    {
        $request = $this->unassignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse';
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
                        '\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation unassignInstancePrivateNetworkAsync
     *
     * Remove instance from a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unassignInstancePrivateNetworkAsync($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['unassignInstancePrivateNetwork'][0])
    {
        return $this->unassignInstancePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation unassignInstancePrivateNetworkAsyncWithHttpInfo
     *
     * Remove instance from a Private Network
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unassignInstancePrivateNetworkAsyncWithHttpInfo($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['unassignInstancePrivateNetwork'][0])
    {
        $returnType = '\OpenAPI\Client\Model\UnassignInstancePrivateNetworkResponse';
        $request = $this->unassignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id, $contentType);

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
     * Create request for operation 'unassignInstancePrivateNetwork'
     *
     * @param  string $x_request_id [Uuid4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) to identify individual requests for support cases. You can use [uuidgenerator](https://www.uuidgenerator.net/version4) to generate them manually. (required)
     * @param  int $private_network_id The identifier of the Private Network (required)
     * @param  int $instance_id The identifier of the instance (required)
     * @param  string $x_trace_id Identifier to trace group of requests. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unassignInstancePrivateNetwork'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function unassignInstancePrivateNetworkRequest($x_request_id, $private_network_id, $instance_id, $x_trace_id = null, string $contentType = self::contentTypes['unassignInstancePrivateNetwork'][0])
    {

        // verify the required parameter 'x_request_id' is set
        if ($x_request_id === null || (is_array($x_request_id) && count($x_request_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $x_request_id when calling unassignInstancePrivateNetwork'
            );
        }
        if (!preg_match("/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/", $x_request_id)) {
            throw new \InvalidArgumentException("invalid value for \"x_request_id\" when calling PrivateNetworksApi.unassignInstancePrivateNetwork, must conform to the pattern /^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-5][0-9A-Fa-f]{3}-[089abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/.");
        }
        
        // verify the required parameter 'private_network_id' is set
        if ($private_network_id === null || (is_array($private_network_id) && count($private_network_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $private_network_id when calling unassignInstancePrivateNetwork'
            );
        }

        // verify the required parameter 'instance_id' is set
        if ($instance_id === null || (is_array($instance_id) && count($instance_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instance_id when calling unassignInstancePrivateNetwork'
            );
        }



        $resourcePath = '/v1/private-networks/{privateNetworkId}/instances/{instanceId}';
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
        if ($private_network_id !== null) {
            $resourcePath = str_replace(
                '{' . 'privateNetworkId' . '}',
                ObjectSerializer::toPathValue($private_network_id),
                $resourcePath
            );
        }
        // path params
        if ($instance_id !== null) {
            $resourcePath = str_replace(
                '{' . 'instanceId' . '}',
                ObjectSerializer::toPathValue($instance_id),
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
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
