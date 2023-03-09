<?php
/**
 * LedgerEntryResponse
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
 * LedgerEntryResponse Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class LedgerEntryResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'LedgerEntryResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'tenant_id' => 'string',
        'customer_id' => 'string',
        'ledger_entry_id' => 'float',
        'subscription_id' => 'float',
        'transaction_date' => '\DateTime',
        'billing_start_date' => '\DateTime',
        'billing_end_date' => '\DateTime',
        'gross_monthly_price' => 'float',
        'subject' => 'string',
        'balance_after' => 'float',
        'description' => 'string',
        'currency' => 'string',
        'gross_amount' => 'float',
        'type' => 'string'
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
        'ledger_entry_id' => null,
        'subscription_id' => null,
        'transaction_date' => 'date-time',
        'billing_start_date' => 'date-time',
        'billing_end_date' => 'date-time',
        'gross_monthly_price' => null,
        'subject' => null,
        'balance_after' => null,
        'description' => null,
        'currency' => null,
        'gross_amount' => null,
        'type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'tenant_id' => false,
		'customer_id' => false,
		'ledger_entry_id' => false,
		'subscription_id' => false,
		'transaction_date' => false,
		'billing_start_date' => false,
		'billing_end_date' => false,
		'gross_monthly_price' => false,
		'subject' => false,
		'balance_after' => false,
		'description' => false,
		'currency' => false,
		'gross_amount' => false,
		'type' => false
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
        'ledger_entry_id' => 'ledgerEntryId',
        'subscription_id' => 'subscriptionId',
        'transaction_date' => 'transactionDate',
        'billing_start_date' => 'billingStartDate',
        'billing_end_date' => 'billingEndDate',
        'gross_monthly_price' => 'grossMonthlyPrice',
        'subject' => 'subject',
        'balance_after' => 'balanceAfter',
        'description' => 'description',
        'currency' => 'currency',
        'gross_amount' => 'grossAmount',
        'type' => 'type'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'tenant_id' => 'setTenantId',
        'customer_id' => 'setCustomerId',
        'ledger_entry_id' => 'setLedgerEntryId',
        'subscription_id' => 'setSubscriptionId',
        'transaction_date' => 'setTransactionDate',
        'billing_start_date' => 'setBillingStartDate',
        'billing_end_date' => 'setBillingEndDate',
        'gross_monthly_price' => 'setGrossMonthlyPrice',
        'subject' => 'setSubject',
        'balance_after' => 'setBalanceAfter',
        'description' => 'setDescription',
        'currency' => 'setCurrency',
        'gross_amount' => 'setGrossAmount',
        'type' => 'setType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'tenant_id' => 'getTenantId',
        'customer_id' => 'getCustomerId',
        'ledger_entry_id' => 'getLedgerEntryId',
        'subscription_id' => 'getSubscriptionId',
        'transaction_date' => 'getTransactionDate',
        'billing_start_date' => 'getBillingStartDate',
        'billing_end_date' => 'getBillingEndDate',
        'gross_monthly_price' => 'getGrossMonthlyPrice',
        'subject' => 'getSubject',
        'balance_after' => 'getBalanceAfter',
        'description' => 'getDescription',
        'currency' => 'getCurrency',
        'gross_amount' => 'getGrossAmount',
        'type' => 'getType'
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

    public const CURRENCY_USD = 'USD';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_GBP = 'GBP';
    public const TYPE_FIXED = 'fixed';
    public const TYPE_RECURRING = 'recurring';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCurrencyAllowableValues()
    {
        return [
            self::CURRENCY_USD,
            self::CURRENCY_EUR,
            self::CURRENCY_GBP,
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
            self::TYPE_FIXED,
            self::TYPE_RECURRING,
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
        $this->setIfExists('ledger_entry_id', $data ?? [], null);
        $this->setIfExists('subscription_id', $data ?? [], null);
        $this->setIfExists('transaction_date', $data ?? [], null);
        $this->setIfExists('billing_start_date', $data ?? [], null);
        $this->setIfExists('billing_end_date', $data ?? [], null);
        $this->setIfExists('gross_monthly_price', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('balance_after', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('gross_amount', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
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

        if ($this->container['ledger_entry_id'] === null) {
            $invalidProperties[] = "'ledger_entry_id' can't be null";
        }
        if ($this->container['subscription_id'] === null) {
            $invalidProperties[] = "'subscription_id' can't be null";
        }
        if ($this->container['transaction_date'] === null) {
            $invalidProperties[] = "'transaction_date' can't be null";
        }
        if ($this->container['billing_start_date'] === null) {
            $invalidProperties[] = "'billing_start_date' can't be null";
        }
        if ($this->container['billing_end_date'] === null) {
            $invalidProperties[] = "'billing_end_date' can't be null";
        }
        if ($this->container['gross_monthly_price'] === null) {
            $invalidProperties[] = "'gross_monthly_price' can't be null";
        }
        if ($this->container['subject'] === null) {
            $invalidProperties[] = "'subject' can't be null";
        }
        if ((mb_strlen($this->container['subject']) < 1)) {
            $invalidProperties[] = "invalid value for 'subject', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['balance_after'] === null) {
            $invalidProperties[] = "'balance_after' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ((mb_strlen($this->container['description']) < 1)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be bigger than or equal to 1.";
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

        if ($this->container['gross_amount'] === null) {
            $invalidProperties[] = "'gross_amount' can't be null";
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
            throw new \InvalidArgumentException('invalid length for $tenant_id when calling LedgerEntryResponse., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid length for $customer_id when calling LedgerEntryResponse., must be bigger than or equal to 1.');
        }


        if (is_null($customer_id)) {
            throw new \InvalidArgumentException('non-nullable customer_id cannot be null');
        }

        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets ledger_entry_id
     *
     * @return float
     */
    public function getLedgerEntryId()
    {
        return $this->container['ledger_entry_id'];
    }

    /**
     * Sets ledger_entry_id
     *
     * @param float $ledger_entry_id Ledger entry id
     *
     * @return self
     */
    public function setLedgerEntryId($ledger_entry_id)
    {



        if (is_null($ledger_entry_id)) {
            throw new \InvalidArgumentException('non-nullable ledger_entry_id cannot be null');
        }

        $this->container['ledger_entry_id'] = $ledger_entry_id;

        return $this;
    }

    /**
     * Gets subscription_id
     *
     * @return float
     */
    public function getSubscriptionId()
    {
        return $this->container['subscription_id'];
    }

    /**
     * Sets subscription_id
     *
     * @param float $subscription_id Ledger entry subscription id
     *
     * @return self
     */
    public function setSubscriptionId($subscription_id)
    {



        if (is_null($subscription_id)) {
            throw new \InvalidArgumentException('non-nullable subscription_id cannot be null');
        }

        $this->container['subscription_id'] = $subscription_id;

        return $this;
    }

    /**
     * Gets transaction_date
     *
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->container['transaction_date'];
    }

    /**
     * Sets transaction_date
     *
     * @param \DateTime $transaction_date The transaction date
     *
     * @return self
     */
    public function setTransactionDate($transaction_date)
    {

        if (is_null($transaction_date)) {
            throw new \InvalidArgumentException('non-nullable transaction_date cannot be null');
        }

        $this->container['transaction_date'] = $transaction_date;

        return $this;
    }

    /**
     * Gets billing_start_date
     *
     * @return \DateTime
     */
    public function getBillingStartDate()
    {
        return $this->container['billing_start_date'];
    }

    /**
     * Sets billing_start_date
     *
     * @param \DateTime $billing_start_date The billing start the for the service
     *
     * @return self
     */
    public function setBillingStartDate($billing_start_date)
    {

        if (is_null($billing_start_date)) {
            throw new \InvalidArgumentException('non-nullable billing_start_date cannot be null');
        }

        $this->container['billing_start_date'] = $billing_start_date;

        return $this;
    }

    /**
     * Gets billing_end_date
     *
     * @return \DateTime
     */
    public function getBillingEndDate()
    {
        return $this->container['billing_end_date'];
    }

    /**
     * Sets billing_end_date
     *
     * @param \DateTime $billing_end_date The billing end date for the service
     *
     * @return self
     */
    public function setBillingEndDate($billing_end_date)
    {

        if (is_null($billing_end_date)) {
            throw new \InvalidArgumentException('non-nullable billing_end_date cannot be null');
        }

        $this->container['billing_end_date'] = $billing_end_date;

        return $this;
    }

    /**
     * Gets gross_monthly_price
     *
     * @return float
     */
    public function getGrossMonthlyPrice()
    {
        return $this->container['gross_monthly_price'];
    }

    /**
     * Sets gross_monthly_price
     *
     * @param float $gross_monthly_price The monthly price of the service
     *
     * @return self
     */
    public function setGrossMonthlyPrice($gross_monthly_price)
    {



        if (is_null($gross_monthly_price)) {
            throw new \InvalidArgumentException('non-nullable gross_monthly_price cannot be null');
        }

        $this->container['gross_monthly_price'] = $gross_monthly_price;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string $subject The subject of the transaction
     *
     * @return self
     */
    public function setSubject($subject)
    {

        if ((mb_strlen($subject) < 1)) {
            throw new \InvalidArgumentException('invalid length for $subject when calling LedgerEntryResponse., must be bigger than or equal to 1.');
        }


        if (is_null($subject)) {
            throw new \InvalidArgumentException('non-nullable subject cannot be null');
        }

        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets balance_after
     *
     * @return float
     */
    public function getBalanceAfter()
    {
        return $this->container['balance_after'];
    }

    /**
     * Sets balance_after
     *
     * @param float $balance_after Your balance after you paid for the service
     *
     * @return self
     */
    public function setBalanceAfter($balance_after)
    {



        if (is_null($balance_after)) {
            throw new \InvalidArgumentException('non-nullable balance_after cannot be null');
        }

        $this->container['balance_after'] = $balance_after;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description The description of the transaction
     *
     * @return self
     */
    public function setDescription($description)
    {

        if ((mb_strlen($description) < 1)) {
            throw new \InvalidArgumentException('invalid length for $description when calling LedgerEntryResponse., must be bigger than or equal to 1.');
        }


        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }

        $this->container['description'] = $description;

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
     * @param string $currency currency
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
     * Gets gross_amount
     *
     * @return float
     */
    public function getGrossAmount()
    {
        return $this->container['gross_amount'];
    }

    /**
     * Sets gross_amount
     *
     * @param float $gross_amount The price of the service from the moment you have purchased it
     *
     * @return self
     */
    public function setGrossAmount($gross_amount)
    {



        if (is_null($gross_amount)) {
            throw new \InvalidArgumentException('non-nullable gross_amount cannot be null');
        }

        $this->container['gross_amount'] = $gross_amount;

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
     * @param string $type type
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


