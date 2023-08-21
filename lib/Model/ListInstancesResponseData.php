<?php
/**
 * ListInstancesResponseData
 *
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

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * ListInstancesResponseData Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ListInstancesResponseData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ListInstancesResponseData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tenant_id' => 'string',
        'customer_id' => 'string',
        'additional_ips' => '\OpenAPI\Client\Model\AdditionalIp[]',
        'name' => 'string',
        'display_name' => 'string',
        'instance_id' => 'int',
        'data_center' => 'string',
        'region' => 'string',
        'region_name' => 'string',
        'product_id' => 'string',
        'image_id' => 'string',
        'ip_config' => '\OpenAPI\Client\Model\IpConfig',
        'mac_address' => 'string',
        'ram_mb' => 'float',
        'cpu_cores' => 'int',
        'os_type' => 'string',
        'disk_mb' => 'float',
        'ssh_keys' => 'int[]',
        'created_date' => '\DateTime',
        'cancel_date' => '\DateTime',
        'status' => '\OpenAPI\Client\Model\InstanceStatus',
        'v_host_id' => 'int',
        'add_ons' => '\OpenAPI\Client\Model\AddOnResponse[]',
        'error_message' => 'string',
        'product_type' => 'string',
        'default_user' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'tenant_id' => null,
        'customer_id' => null,
        'additional_ips' => null,
        'name' => null,
        'display_name' => null,
        'instance_id' => 'int64',
        'data_center' => null,
        'region' => null,
        'region_name' => null,
        'product_id' => null,
        'image_id' => null,
        'ip_config' => null,
        'mac_address' => null,
        'ram_mb' => null,
        'cpu_cores' => 'int64',
        'os_type' => null,
        'disk_mb' => null,
        'ssh_keys' => 'int64',
        'created_date' => 'date-time',
        'cancel_date' => 'date',
        'status' => null,
        'v_host_id' => 'int64',
        'add_ons' => null,
        'error_message' => null,
        'product_type' => null,
        'default_user' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'tenant_id' => false,
		'customer_id' => false,
		'additional_ips' => false,
		'name' => false,
		'display_name' => false,
		'instance_id' => false,
		'data_center' => false,
		'region' => false,
		'region_name' => false,
		'product_id' => false,
		'image_id' => false,
		'ip_config' => false,
		'mac_address' => false,
		'ram_mb' => false,
		'cpu_cores' => false,
		'os_type' => false,
		'disk_mb' => false,
		'ssh_keys' => false,
		'created_date' => false,
		'cancel_date' => false,
		'status' => false,
		'v_host_id' => false,
		'add_ons' => false,
		'error_message' => false,
		'product_type' => false,
		'default_user' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'tenant_id' => 'tenantId',
        'customer_id' => 'customerId',
        'additional_ips' => 'additionalIps',
        'name' => 'name',
        'display_name' => 'displayName',
        'instance_id' => 'instanceId',
        'data_center' => 'dataCenter',
        'region' => 'region',
        'region_name' => 'regionName',
        'product_id' => 'productId',
        'image_id' => 'imageId',
        'ip_config' => 'ipConfig',
        'mac_address' => 'macAddress',
        'ram_mb' => 'ramMb',
        'cpu_cores' => 'cpuCores',
        'os_type' => 'osType',
        'disk_mb' => 'diskMb',
        'ssh_keys' => 'sshKeys',
        'created_date' => 'createdDate',
        'cancel_date' => 'cancelDate',
        'status' => 'status',
        'v_host_id' => 'vHostId',
        'add_ons' => 'addOns',
        'error_message' => 'errorMessage',
        'product_type' => 'productType',
        'default_user' => 'defaultUser'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tenant_id' => 'setTenantId',
        'customer_id' => 'setCustomerId',
        'additional_ips' => 'setAdditionalIps',
        'name' => 'setName',
        'display_name' => 'setDisplayName',
        'instance_id' => 'setInstanceId',
        'data_center' => 'setDataCenter',
        'region' => 'setRegion',
        'region_name' => 'setRegionName',
        'product_id' => 'setProductId',
        'image_id' => 'setImageId',
        'ip_config' => 'setIpConfig',
        'mac_address' => 'setMacAddress',
        'ram_mb' => 'setRamMb',
        'cpu_cores' => 'setCpuCores',
        'os_type' => 'setOsType',
        'disk_mb' => 'setDiskMb',
        'ssh_keys' => 'setSshKeys',
        'created_date' => 'setCreatedDate',
        'cancel_date' => 'setCancelDate',
        'status' => 'setStatus',
        'v_host_id' => 'setVHostId',
        'add_ons' => 'setAddOns',
        'error_message' => 'setErrorMessage',
        'product_type' => 'setProductType',
        'default_user' => 'setDefaultUser'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tenant_id' => 'getTenantId',
        'customer_id' => 'getCustomerId',
        'additional_ips' => 'getAdditionalIps',
        'name' => 'getName',
        'display_name' => 'getDisplayName',
        'instance_id' => 'getInstanceId',
        'data_center' => 'getDataCenter',
        'region' => 'getRegion',
        'region_name' => 'getRegionName',
        'product_id' => 'getProductId',
        'image_id' => 'getImageId',
        'ip_config' => 'getIpConfig',
        'mac_address' => 'getMacAddress',
        'ram_mb' => 'getRamMb',
        'cpu_cores' => 'getCpuCores',
        'os_type' => 'getOsType',
        'disk_mb' => 'getDiskMb',
        'ssh_keys' => 'getSshKeys',
        'created_date' => 'getCreatedDate',
        'cancel_date' => 'getCancelDate',
        'status' => 'getStatus',
        'v_host_id' => 'getVHostId',
        'add_ons' => 'getAddOns',
        'error_message' => 'getErrorMessage',
        'product_type' => 'getProductType',
        'default_user' => 'getDefaultUser'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const TENANT_ID_DE = 'DE';
    public const TENANT_ID_INT = 'INT';
    public const PRODUCT_TYPE_HDD = 'hdd';
    public const PRODUCT_TYPE_SSD = 'ssd';
    public const PRODUCT_TYPE_VDS = 'vds';
    public const PRODUCT_TYPE_NVME = 'nvme';
    public const DEFAULT_USER_ROOT = 'root';
    public const DEFAULT_USER_ADMIN = 'admin';
    public const DEFAULT_USER_ADMINISTRATOR = 'administrator';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTenantIdAllowableValues()
    {
        return [
            self::TENANT_ID_DE,
            self::TENANT_ID_INT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProductTypeAllowableValues()
    {
        return [
            self::PRODUCT_TYPE_HDD,
            self::PRODUCT_TYPE_SSD,
            self::PRODUCT_TYPE_VDS,
            self::PRODUCT_TYPE_NVME,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDefaultUserAllowableValues()
    {
        return [
            self::DEFAULT_USER_ROOT,
            self::DEFAULT_USER_ADMIN,
            self::DEFAULT_USER_ADMINISTRATOR,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('tenant_id', $data ?? [], null);
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('additional_ips', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('instance_id', $data ?? [], null);
        $this->setIfExists('data_center', $data ?? [], null);
        $this->setIfExists('region', $data ?? [], null);
        $this->setIfExists('region_name', $data ?? [], null);
        $this->setIfExists('product_id', $data ?? [], null);
        $this->setIfExists('image_id', $data ?? [], null);
        $this->setIfExists('ip_config', $data ?? [], null);
        $this->setIfExists('mac_address', $data ?? [], null);
        $this->setIfExists('ram_mb', $data ?? [], null);
        $this->setIfExists('cpu_cores', $data ?? [], null);
        $this->setIfExists('os_type', $data ?? [], null);
        $this->setIfExists('disk_mb', $data ?? [], null);
        $this->setIfExists('ssh_keys', $data ?? [], null);
        $this->setIfExists('created_date', $data ?? [], null);
        $this->setIfExists('cancel_date', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('v_host_id', $data ?? [], null);
        $this->setIfExists('add_ons', $data ?? [], null);
        $this->setIfExists('error_message', $data ?? [], null);
        $this->setIfExists('product_type', $data ?? [], null);
        $this->setIfExists('default_user', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['tenant_id'] === null) {
            $invalidProperties[] = "'tenant_id' can't be null";
        }
        $allowedValues = $this->getTenantIdAllowableValues();
        if (!is_null($this->container['tenant_id']) && !in_array($this->container['tenant_id'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'tenant_id', must be one of '%s'",
                $this->container['tenant_id'],
                implode("', '", $allowedValues)
            );
        }

        if ((mb_strlen($this->container['tenant_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'tenant_id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['customer_id'] === null) {
            $invalidProperties[] = "'customer_id' can't be null";
        }
        if ((mb_strlen($this->container['customer_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'customer_id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['additional_ips'] === null) {
            $invalidProperties[] = "'additional_ips' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['display_name'] === null) {
            $invalidProperties[] = "'display_name' can't be null";
        }
        if ($this->container['instance_id'] === null) {
            $invalidProperties[] = "'instance_id' can't be null";
        }
        if ($this->container['data_center'] === null) {
            $invalidProperties[] = "'data_center' can't be null";
        }
        if ($this->container['region'] === null) {
            $invalidProperties[] = "'region' can't be null";
        }
        if ($this->container['region_name'] === null) {
            $invalidProperties[] = "'region_name' can't be null";
        }
        if ($this->container['product_id'] === null) {
            $invalidProperties[] = "'product_id' can't be null";
        }
        if ($this->container['image_id'] === null) {
            $invalidProperties[] = "'image_id' can't be null";
        }
        if ($this->container['ip_config'] === null) {
            $invalidProperties[] = "'ip_config' can't be null";
        }
        if ($this->container['mac_address'] === null) {
            $invalidProperties[] = "'mac_address' can't be null";
        }
        if ($this->container['ram_mb'] === null) {
            $invalidProperties[] = "'ram_mb' can't be null";
        }
        if ($this->container['cpu_cores'] === null) {
            $invalidProperties[] = "'cpu_cores' can't be null";
        }
        if ($this->container['os_type'] === null) {
            $invalidProperties[] = "'os_type' can't be null";
        }
        if ($this->container['disk_mb'] === null) {
            $invalidProperties[] = "'disk_mb' can't be null";
        }
        if ($this->container['ssh_keys'] === null) {
            $invalidProperties[] = "'ssh_keys' can't be null";
        }
        if ($this->container['created_date'] === null) {
            $invalidProperties[] = "'created_date' can't be null";
        }
        if ($this->container['cancel_date'] === null) {
            $invalidProperties[] = "'cancel_date' can't be null";
        }
        if ((mb_strlen($this->container['cancel_date']) > 10)) {
            $invalidProperties[] = "invalid value for 'cancel_date', the character length must be smaller than or equal to 10.";
        }

        if ((mb_strlen($this->container['cancel_date']) < 0)) {
            $invalidProperties[] = "invalid value for 'cancel_date', the character length must be bigger than or equal to 0.";
        }

        if (!preg_match("/yyyy-mm-dd/", $this->container['cancel_date'])) {
            $invalidProperties[] = "invalid value for 'cancel_date', must be conform to the pattern /yyyy-mm-dd/.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['v_host_id'] === null) {
            $invalidProperties[] = "'v_host_id' can't be null";
        }
        if ($this->container['add_ons'] === null) {
            $invalidProperties[] = "'add_ons' can't be null";
        }
        if ($this->container['product_type'] === null) {
            $invalidProperties[] = "'product_type' can't be null";
        }
        $allowedValues = $this->getProductTypeAllowableValues();
        if (!is_null($this->container['product_type']) && !in_array($this->container['product_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'product_type', must be one of '%s'",
                $this->container['product_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDefaultUserAllowableValues();
        if (!is_null($this->container['default_user']) && !in_array($this->container['default_user'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'default_user', must be one of '%s'",
                $this->container['default_user'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets tenant_id
     *
     * @return string
     */
    public function getTenantId()
    {
        return $this->container['tenant_id'];
    }

    /**
     * Sets tenant_id
     *
     * @param string $tenant_id Your customer tenant id
     *
     * @return self
     */
    public function setTenantId($tenant_id)
    {
        if (is_null($tenant_id)) {
            throw new \InvalidArgumentException('non-nullable tenant_id cannot be null');
        }
        $allowedValues = $this->getTenantIdAllowableValues();
        if (!in_array($tenant_id, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'tenant_id', must be one of '%s'",
                    $tenant_id,
                    implode("', '", $allowedValues)
                )
            );
        }

        if ((mb_strlen($tenant_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $tenant_id when calling ListInstancesResponseData., must be bigger than or equal to 1.');
        }

        $this->container['tenant_id'] = $tenant_id;

        return $this;
    }

    /**
     * Gets customer_id
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     *
     * @param string $customer_id Customer ID
     *
     * @return self
     */
    public function setCustomerId($customer_id)
    {
        if (is_null($customer_id)) {
            throw new \InvalidArgumentException('non-nullable customer_id cannot be null');
        }

        if ((mb_strlen($customer_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $customer_id when calling ListInstancesResponseData., must be bigger than or equal to 1.');
        }

        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets additional_ips
     *
     * @return \OpenAPI\Client\Model\AdditionalIp[]
     */
    public function getAdditionalIps()
    {
        return $this->container['additional_ips'];
    }

    /**
     * Sets additional_ips
     *
     * @param \OpenAPI\Client\Model\AdditionalIp[] $additional_ips additional_ips
     *
     * @return self
     */
    public function setAdditionalIps($additional_ips)
    {
        if (is_null($additional_ips)) {
            throw new \InvalidArgumentException('non-nullable additional_ips cannot be null');
        }
        $this->container['additional_ips'] = $additional_ips;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Instance Name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name Instance display name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets instance_id
     *
     * @return int
     */
    public function getInstanceId()
    {
        return $this->container['instance_id'];
    }

    /**
     * Sets instance_id
     *
     * @param int $instance_id Instance ID
     *
     * @return self
     */
    public function setInstanceId($instance_id)
    {
        if (is_null($instance_id)) {
            throw new \InvalidArgumentException('non-nullable instance_id cannot be null');
        }
        $this->container['instance_id'] = $instance_id;

        return $this;
    }

    /**
     * Gets data_center
     *
     * @return string
     */
    public function getDataCenter()
    {
        return $this->container['data_center'];
    }

    /**
     * Sets data_center
     *
     * @param string $data_center The data center where your Private Network is located
     *
     * @return self
     */
    public function setDataCenter($data_center)
    {
        if (is_null($data_center)) {
            throw new \InvalidArgumentException('non-nullable data_center cannot be null');
        }
        $this->container['data_center'] = $data_center;

        return $this;
    }

    /**
     * Gets region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->container['region'];
    }

    /**
     * Sets region
     *
     * @param string $region Instance region where the compute instance should be located.
     *
     * @return self
     */
    public function setRegion($region)
    {
        if (is_null($region)) {
            throw new \InvalidArgumentException('non-nullable region cannot be null');
        }
        $this->container['region'] = $region;

        return $this;
    }

    /**
     * Gets region_name
     *
     * @return string
     */
    public function getRegionName()
    {
        return $this->container['region_name'];
    }

    /**
     * Sets region_name
     *
     * @param string $region_name The name of the region where the instance is located.
     *
     * @return self
     */
    public function setRegionName($region_name)
    {
        if (is_null($region_name)) {
            throw new \InvalidArgumentException('non-nullable region_name cannot be null');
        }
        $this->container['region_name'] = $region_name;

        return $this;
    }

    /**
     * Gets product_id
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->container['product_id'];
    }

    /**
     * Sets product_id
     *
     * @param string $product_id Product ID
     *
     * @return self
     */
    public function setProductId($product_id)
    {
        if (is_null($product_id)) {
            throw new \InvalidArgumentException('non-nullable product_id cannot be null');
        }
        $this->container['product_id'] = $product_id;

        return $this;
    }

    /**
     * Gets image_id
     *
     * @return string
     */
    public function getImageId()
    {
        return $this->container['image_id'];
    }

    /**
     * Sets image_id
     *
     * @param string $image_id Image's id
     *
     * @return self
     */
    public function setImageId($image_id)
    {
        if (is_null($image_id)) {
            throw new \InvalidArgumentException('non-nullable image_id cannot be null');
        }
        $this->container['image_id'] = $image_id;

        return $this;
    }

    /**
     * Gets ip_config
     *
     * @return \OpenAPI\Client\Model\IpConfig
     */
    public function getIpConfig()
    {
        return $this->container['ip_config'];
    }

    /**
     * Sets ip_config
     *
     * @param \OpenAPI\Client\Model\IpConfig $ip_config ip_config
     *
     * @return self
     */
    public function setIpConfig($ip_config)
    {
        if (is_null($ip_config)) {
            throw new \InvalidArgumentException('non-nullable ip_config cannot be null');
        }
        $this->container['ip_config'] = $ip_config;

        return $this;
    }

    /**
     * Gets mac_address
     *
     * @return string
     */
    public function getMacAddress()
    {
        return $this->container['mac_address'];
    }

    /**
     * Sets mac_address
     *
     * @param string $mac_address MAC Address
     *
     * @return self
     */
    public function setMacAddress($mac_address)
    {
        if (is_null($mac_address)) {
            throw new \InvalidArgumentException('non-nullable mac_address cannot be null');
        }
        $this->container['mac_address'] = $mac_address;

        return $this;
    }

    /**
     * Gets ram_mb
     *
     * @return float
     */
    public function getRamMb()
    {
        return $this->container['ram_mb'];
    }

    /**
     * Sets ram_mb
     *
     * @param float $ram_mb Image RAM size in MB
     *
     * @return self
     */
    public function setRamMb($ram_mb)
    {
        if (is_null($ram_mb)) {
            throw new \InvalidArgumentException('non-nullable ram_mb cannot be null');
        }
        $this->container['ram_mb'] = $ram_mb;

        return $this;
    }

    /**
     * Gets cpu_cores
     *
     * @return int
     */
    public function getCpuCores()
    {
        return $this->container['cpu_cores'];
    }

    /**
     * Sets cpu_cores
     *
     * @param int $cpu_cores CPU core count
     *
     * @return self
     */
    public function setCpuCores($cpu_cores)
    {
        if (is_null($cpu_cores)) {
            throw new \InvalidArgumentException('non-nullable cpu_cores cannot be null');
        }
        $this->container['cpu_cores'] = $cpu_cores;

        return $this;
    }

    /**
     * Gets os_type
     *
     * @return string
     */
    public function getOsType()
    {
        return $this->container['os_type'];
    }

    /**
     * Sets os_type
     *
     * @param string $os_type Type of operating system (OS)
     *
     * @return self
     */
    public function setOsType($os_type)
    {
        if (is_null($os_type)) {
            throw new \InvalidArgumentException('non-nullable os_type cannot be null');
        }
        $this->container['os_type'] = $os_type;

        return $this;
    }

    /**
     * Gets disk_mb
     *
     * @return float
     */
    public function getDiskMb()
    {
        return $this->container['disk_mb'];
    }

    /**
     * Sets disk_mb
     *
     * @param float $disk_mb Image Disk size in MB
     *
     * @return self
     */
    public function setDiskMb($disk_mb)
    {
        if (is_null($disk_mb)) {
            throw new \InvalidArgumentException('non-nullable disk_mb cannot be null');
        }
        $this->container['disk_mb'] = $disk_mb;

        return $this;
    }

    /**
     * Gets ssh_keys
     *
     * @return int[]
     */
    public function getSshKeys()
    {
        return $this->container['ssh_keys'];
    }

    /**
     * Sets ssh_keys
     *
     * @param int[] $ssh_keys Array of `secretId`s of public SSH keys for logging into as `defaultUser` with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API.
     *
     * @return self
     */
    public function setSshKeys($ssh_keys)
    {
        if (is_null($ssh_keys)) {
            throw new \InvalidArgumentException('non-nullable ssh_keys cannot be null');
        }
        $this->container['ssh_keys'] = $ssh_keys;

        return $this;
    }

    /**
     * Gets created_date
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->container['created_date'];
    }

    /**
     * Sets created_date
     *
     * @param \DateTime $created_date The creation date for the instance
     *
     * @return self
     */
    public function setCreatedDate($created_date)
    {
        if (is_null($created_date)) {
            throw new \InvalidArgumentException('non-nullable created_date cannot be null');
        }
        $this->container['created_date'] = $created_date;

        return $this;
    }

    /**
     * Gets cancel_date
     *
     * @return \DateTime
     */
    public function getCancelDate()
    {
        return $this->container['cancel_date'];
    }

    /**
     * Sets cancel_date
     *
     * @param \DateTime $cancel_date The date on which the instance will be cancelled
     *
     * @return self
     */
    public function setCancelDate($cancel_date)
    {
        if (is_null($cancel_date)) {
            throw new \InvalidArgumentException('non-nullable cancel_date cannot be null');
        }
        if ((mb_strlen($cancel_date) > 10)) {
            throw new \InvalidArgumentException('invalid length for $cancel_date when calling ListInstancesResponseData., must be smaller than or equal to 10.');
        }
        if ((mb_strlen($cancel_date) < 0)) {
            throw new \InvalidArgumentException('invalid length for $cancel_date when calling ListInstancesResponseData., must be bigger than or equal to 0.');
        }
        if ((!preg_match("/yyyy-mm-dd/", $cancel_date))) {
            throw new \InvalidArgumentException("invalid value for \$cancel_date when calling ListInstancesResponseData., must conform to the pattern /yyyy-mm-dd/.");
        }

        $this->container['cancel_date'] = $cancel_date;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \OpenAPI\Client\Model\InstanceStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \OpenAPI\Client\Model\InstanceStatus $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets v_host_id
     *
     * @return int
     */
    public function getVHostId()
    {
        return $this->container['v_host_id'];
    }

    /**
     * Sets v_host_id
     *
     * @param int $v_host_id ID of host system
     *
     * @return self
     */
    public function setVHostId($v_host_id)
    {
        if (is_null($v_host_id)) {
            throw new \InvalidArgumentException('non-nullable v_host_id cannot be null');
        }
        $this->container['v_host_id'] = $v_host_id;

        return $this;
    }

    /**
     * Gets add_ons
     *
     * @return \OpenAPI\Client\Model\AddOnResponse[]
     */
    public function getAddOns()
    {
        return $this->container['add_ons'];
    }

    /**
     * Sets add_ons
     *
     * @param \OpenAPI\Client\Model\AddOnResponse[] $add_ons add_ons
     *
     * @return self
     */
    public function setAddOns($add_ons)
    {
        if (is_null($add_ons)) {
            throw new \InvalidArgumentException('non-nullable add_ons cannot be null');
        }
        $this->container['add_ons'] = $add_ons;

        return $this;
    }

    /**
     * Gets error_message
     *
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->container['error_message'];
    }

    /**
     * Sets error_message
     *
     * @param string|null $error_message Message in case of an error.
     *
     * @return self
     */
    public function setErrorMessage($error_message)
    {
        if (is_null($error_message)) {
            throw new \InvalidArgumentException('non-nullable error_message cannot be null');
        }
        $this->container['error_message'] = $error_message;

        return $this;
    }

    /**
     * Gets product_type
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->container['product_type'];
    }

    /**
     * Sets product_type
     *
     * @param string $product_type Instance's category depending on Product Id
     *
     * @return self
     */
    public function setProductType($product_type)
    {
        if (is_null($product_type)) {
            throw new \InvalidArgumentException('non-nullable product_type cannot be null');
        }
        $allowedValues = $this->getProductTypeAllowableValues();
        if (!in_array($product_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'product_type', must be one of '%s'",
                    $product_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['product_type'] = $product_type;

        return $this;
    }

    /**
     * Gets default_user
     *
     * @return string|null
     */
    public function getDefaultUser()
    {
        return $this->container['default_user'];
    }

    /**
     * Sets default_user
     *
     * @param string|null $default_user Default user name created for login during (re-)installation with administrative privileges. Allowed values for Linux/BSD are `admin` (use sudo to apply administrative privileges like root) or `root`. Allowed values for Windows are `admin` (has administrative privileges like administrator) or `administrator`.
     *
     * @return self
     */
    public function setDefaultUser($default_user)
    {
        if (is_null($default_user)) {
            throw new \InvalidArgumentException('non-nullable default_user cannot be null');
        }
        $allowedValues = $this->getDefaultUserAllowableValues();
        if (!in_array($default_user, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'default_user', must be one of '%s'",
                    $default_user,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['default_user'] = $default_user;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


