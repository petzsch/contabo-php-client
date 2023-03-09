<?php
/**
 * CustomerResponse
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

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * CustomerResponse Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CustomerResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CustomerResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tenant_id' => 'string',
        'customer_id' => 'string',
        'salutation' => 'string',
        'type' => 'string',
        'private' => '\OpenAPI\Client\Model\CustomerTypePrivate',
        'business' => '\OpenAPI\Client\Model\CustomerTypeBusiness',
        'tax_percentage' => 'float',
        'currency' => 'string',
        'balance' => 'float',
        'locale' => 'string',
        'addresses' => '\OpenAPI\Client\Model\CustomerAddress[]',
        'emails' => '\OpenAPI\Client\Model\CustomerEmail[]',
        'phones' => '\OpenAPI\Client\Model\CustomerPhone[]',
        'status' => 'string',
        'created_date' => '\DateTime',
        'monthly_recurring_revenue' => 'float'
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
        'salutation' => null,
        'type' => null,
        'private' => null,
        'business' => null,
        'tax_percentage' => 'double',
        'currency' => null,
        'balance' => 'double',
        'locale' => null,
        'addresses' => null,
        'emails' => null,
        'phones' => null,
        'status' => null,
        'created_date' => 'date-time',
        'monthly_recurring_revenue' => 'float'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'tenant_id' => false,
		'customer_id' => false,
		'salutation' => false,
		'type' => false,
		'private' => false,
		'business' => false,
		'tax_percentage' => false,
		'currency' => false,
		'balance' => false,
		'locale' => false,
		'addresses' => false,
		'emails' => false,
		'phones' => false,
		'status' => false,
		'created_date' => false,
		'monthly_recurring_revenue' => false
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
        'salutation' => 'salutation',
        'type' => 'type',
        'private' => 'private',
        'business' => 'business',
        'tax_percentage' => 'taxPercentage',
        'currency' => 'currency',
        'balance' => 'balance',
        'locale' => 'locale',
        'addresses' => 'addresses',
        'emails' => 'emails',
        'phones' => 'phones',
        'status' => 'status',
        'created_date' => 'createdDate',
        'monthly_recurring_revenue' => 'monthlyRecurringRevenue'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tenant_id' => 'setTenantId',
        'customer_id' => 'setCustomerId',
        'salutation' => 'setSalutation',
        'type' => 'setType',
        'private' => 'setPrivate',
        'business' => 'setBusiness',
        'tax_percentage' => 'setTaxPercentage',
        'currency' => 'setCurrency',
        'balance' => 'setBalance',
        'locale' => 'setLocale',
        'addresses' => 'setAddresses',
        'emails' => 'setEmails',
        'phones' => 'setPhones',
        'status' => 'setStatus',
        'created_date' => 'setCreatedDate',
        'monthly_recurring_revenue' => 'setMonthlyRecurringRevenue'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tenant_id' => 'getTenantId',
        'customer_id' => 'getCustomerId',
        'salutation' => 'getSalutation',
        'type' => 'getType',
        'private' => 'getPrivate',
        'business' => 'getBusiness',
        'tax_percentage' => 'getTaxPercentage',
        'currency' => 'getCurrency',
        'balance' => 'getBalance',
        'locale' => 'getLocale',
        'addresses' => 'getAddresses',
        'emails' => 'getEmails',
        'phones' => 'getPhones',
        'status' => 'getStatus',
        'created_date' => 'getCreatedDate',
        'monthly_recurring_revenue' => 'getMonthlyRecurringRevenue'
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

    public const SALUTATION_MR = 'Mr';
    public const SALUTATION_MS = 'Ms';
    public const SALUTATION_OTHER = 'Other';
    public const TYPE_BUSINESS = 'business';
    public const TYPE__PRIVATE = 'private';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_GBP = 'GBP';
    public const CURRENCY_USD = 'USD';
    public const LOCALE_EN = 'en';
    public const LOCALE_DE = 'de';
    public const STATUS_CREATED = 'created';
    public const STATUS_REGISTERED = 'registered';
    public const STATUS_ACTIVE = 'active';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSalutationAllowableValues()
    {
        return [
            self::SALUTATION_MR,
            self::SALUTATION_MS,
            self::SALUTATION_OTHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_BUSINESS,
            self::TYPE__PRIVATE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCurrencyAllowableValues()
    {
        return [
            self::CURRENCY_EUR,
            self::CURRENCY_GBP,
            self::CURRENCY_USD,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLocaleAllowableValues()
    {
        return [
            self::LOCALE_EN,
            self::LOCALE_DE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_CREATED,
            self::STATUS_REGISTERED,
            self::STATUS_ACTIVE,
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
        $this->setIfExists('salutation', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('private', $data ?? [], null);
        $this->setIfExists('business', $data ?? [], null);
        $this->setIfExists('tax_percentage', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('balance', $data ?? [], null);
        $this->setIfExists('locale', $data ?? [], null);
        $this->setIfExists('addresses', $data ?? [], null);
        $this->setIfExists('emails', $data ?? [], null);
        $this->setIfExists('phones', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('created_date', $data ?? [], null);
        $this->setIfExists('monthly_recurring_revenue', $data ?? [], null);
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
        if ((mb_strlen($this->container['tenant_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'tenant_id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['customer_id'] === null) {
            $invalidProperties[] = "'customer_id' can't be null";
        }
        if ((mb_strlen($this->container['customer_id']) < 1)) {
            $invalidProperties[] = "invalid value for 'customer_id', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['salutation'] === null) {
            $invalidProperties[] = "'salutation' can't be null";
        }
        $allowedValues = $this->getSalutationAllowableValues();
        if (!is_null($this->container['salutation']) && !in_array($this->container['salutation'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'salutation', must be one of '%s'",
                $this->container['salutation'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['private'] === null) {
            $invalidProperties[] = "'private' can't be null";
        }
        if ($this->container['business'] === null) {
            $invalidProperties[] = "'business' can't be null";
        }
        if ($this->container['tax_percentage'] === null) {
            $invalidProperties[] = "'tax_percentage' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalidProperties[] = "'currency' can't be null";
        }
        $allowedValues = $this->getCurrencyAllowableValues();
        if (!is_null($this->container['currency']) && !in_array($this->container['currency'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'currency', must be one of '%s'",
                $this->container['currency'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['balance'] === null) {
            $invalidProperties[] = "'balance' can't be null";
        }
        if ($this->container['locale'] === null) {
            $invalidProperties[] = "'locale' can't be null";
        }
        $allowedValues = $this->getLocaleAllowableValues();
        if (!is_null($this->container['locale']) && !in_array($this->container['locale'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'locale', must be one of '%s'",
                $this->container['locale'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['addresses'] === null) {
            $invalidProperties[] = "'addresses' can't be null";
        }
        if ($this->container['emails'] === null) {
            $invalidProperties[] = "'emails' can't be null";
        }
        if ($this->container['phones'] === null) {
            $invalidProperties[] = "'phones' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['created_date'] === null) {
            $invalidProperties[] = "'created_date' can't be null";
        }
        if ($this->container['monthly_recurring_revenue'] === null) {
            $invalidProperties[] = "'monthly_recurring_revenue' can't be null";
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

        if ((mb_strlen($tenant_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $tenant_id when calling CustomerResponse., must be bigger than or equal to 1.');
        }


        if (is_null($tenant_id)) {
            throw new \InvalidArgumentException('non-nullable tenant_id cannot be null');
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
     * @param string $customer_id Your customer number
     *
     * @return self
     */
    public function setCustomerId($customer_id)
    {

        if ((mb_strlen($customer_id) < 1)) {
            throw new \InvalidArgumentException('invalid length for $customer_id when calling CustomerResponse., must be bigger than or equal to 1.');
        }


        if (is_null($customer_id)) {
            throw new \InvalidArgumentException('non-nullable customer_id cannot be null');
        }

        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets salutation
     *
     * @return string
     */
    public function getSalutation()
    {
        return $this->container['salutation'];
    }

    /**
     * Sets salutation
     *
     * @param string $salutation Customer salutation
     *
     * @return self
     */
    public function setSalutation($salutation)
    {
        $allowedValues = $this->getSalutationAllowableValues();
        if (!in_array($salutation, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'salutation', must be one of '%s'",
                    $salutation,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($salutation)) {
            throw new \InvalidArgumentException('non-nullable salutation cannot be null');
        }

        $this->container['salutation'] = $salutation;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Customer type
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }

        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets private
     *
     * @return \OpenAPI\Client\Model\CustomerTypePrivate
     */
    public function getPrivate()
    {
        return $this->container['private'];
    }

    /**
     * Sets private
     *
     * @param \OpenAPI\Client\Model\CustomerTypePrivate $private private
     *
     * @return self
     */
    public function setPrivate($private)
    {

        if (is_null($private)) {
            throw new \InvalidArgumentException('non-nullable private cannot be null');
        }

        $this->container['private'] = $private;

        return $this;
    }

    /**
     * Gets business
     *
     * @return \OpenAPI\Client\Model\CustomerTypeBusiness
     */
    public function getBusiness()
    {
        return $this->container['business'];
    }

    /**
     * Sets business
     *
     * @param \OpenAPI\Client\Model\CustomerTypeBusiness $business business
     *
     * @return self
     */
    public function setBusiness($business)
    {

        if (is_null($business)) {
            throw new \InvalidArgumentException('non-nullable business cannot be null');
        }

        $this->container['business'] = $business;

        return $this;
    }

    /**
     * Gets tax_percentage
     *
     * @return float
     */
    public function getTaxPercentage()
    {
        return $this->container['tax_percentage'];
    }

    /**
     * Sets tax_percentage
     *
     * @param float $tax_percentage Customer tax percentage
     *
     * @return self
     */
    public function setTaxPercentage($tax_percentage)
    {

        if (is_null($tax_percentage)) {
            throw new \InvalidArgumentException('non-nullable tax_percentage cannot be null');
        }

        $this->container['tax_percentage'] = $tax_percentage;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency Customer currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $allowedValues = $this->getCurrencyAllowableValues();
        if (!in_array($currency, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'currency', must be one of '%s'",
                    $currency,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }

        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->container['balance'];
    }

    /**
     * Sets balance
     *
     * @param float $balance Customer balance
     *
     * @return self
     */
    public function setBalance($balance)
    {

        if (is_null($balance)) {
            throw new \InvalidArgumentException('non-nullable balance cannot be null');
        }

        $this->container['balance'] = $balance;

        return $this;
    }

    /**
     * Gets locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->container['locale'];
    }

    /**
     * Sets locale
     *
     * @param string $locale Customer locale
     *
     * @return self
     */
    public function setLocale($locale)
    {
        $allowedValues = $this->getLocaleAllowableValues();
        if (!in_array($locale, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'locale', must be one of '%s'",
                    $locale,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($locale)) {
            throw new \InvalidArgumentException('non-nullable locale cannot be null');
        }

        $this->container['locale'] = $locale;

        return $this;
    }

    /**
     * Gets addresses
     *
     * @return \OpenAPI\Client\Model\CustomerAddress[]
     */
    public function getAddresses()
    {
        return $this->container['addresses'];
    }

    /**
     * Sets addresses
     *
     * @param \OpenAPI\Client\Model\CustomerAddress[] $addresses addresses
     *
     * @return self
     */
    public function setAddresses($addresses)
    {

        if (is_null($addresses)) {
            throw new \InvalidArgumentException('non-nullable addresses cannot be null');
        }

        $this->container['addresses'] = $addresses;

        return $this;
    }

    /**
     * Gets emails
     *
     * @return \OpenAPI\Client\Model\CustomerEmail[]
     */
    public function getEmails()
    {
        return $this->container['emails'];
    }

    /**
     * Sets emails
     *
     * @param \OpenAPI\Client\Model\CustomerEmail[] $emails emails
     *
     * @return self
     */
    public function setEmails($emails)
    {

        if (is_null($emails)) {
            throw new \InvalidArgumentException('non-nullable emails cannot be null');
        }

        $this->container['emails'] = $emails;

        return $this;
    }

    /**
     * Gets phones
     *
     * @return \OpenAPI\Client\Model\CustomerPhone[]
     */
    public function getPhones()
    {
        return $this->container['phones'];
    }

    /**
     * Sets phones
     *
     * @param \OpenAPI\Client\Model\CustomerPhone[] $phones phones
     *
     * @return self
     */
    public function setPhones($phones)
    {

        if (is_null($phones)) {
            throw new \InvalidArgumentException('non-nullable phones cannot be null');
        }

        $this->container['phones'] = $phones;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Customer status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }

        $this->container['status'] = $status;

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
     * @param \DateTime $created_date The creation date of the customer
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
     * Gets monthly_recurring_revenue
     *
     * @return float
     */
    public function getMonthlyRecurringRevenue()
    {
        return $this->container['monthly_recurring_revenue'];
    }

    /**
     * Sets monthly_recurring_revenue
     *
     * @param float $monthly_recurring_revenue The monthly revenue of the customer (How much the customer has to pay recurring each month)
     *
     * @return self
     */
    public function setMonthlyRecurringRevenue($monthly_recurring_revenue)
    {

        if (is_null($monthly_recurring_revenue)) {
            throw new \InvalidArgumentException('non-nullable monthly_recurring_revenue cannot be null');
        }

        $this->container['monthly_recurring_revenue'] = $monthly_recurring_revenue;

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


