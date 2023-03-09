<?php
/**
 * ProcessedDataType
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
 * ProcessedDataType Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProcessedDataType implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProcessedDataType';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'billing_data' => 'bool',
        'address_data' => 'bool',
        'offer_data' => 'bool',
        'authentication_data' => 'bool',
        'bank_details' => 'bool',
        'order_data' => 'bool',
        'image_files' => 'bool',
        'emails' => 'bool',
        'financial_data' => 'bool',
        'communication_data' => 'bool',
        'employee_data' => 'bool',
        'usage_data' => 'bool',
        'password_data' => 'bool',
        'personnel_data' => 'bool',
        'personnel_master_data' => 'bool',
        'program_code' => 'bool',
        'profile_data' => 'bool',
        'transaction_data' => 'bool',
        'contract_data' => 'bool',
        'contract_billing_data' => 'bool',
        'video_files' => 'bool',
        'payment_data' => 'bool',
        'ip_addresses' => 'bool',
        'other' => '\OpenAPI\Client\Model\OtherData'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'billing_data' => null,
        'address_data' => null,
        'offer_data' => null,
        'authentication_data' => null,
        'bank_details' => null,
        'order_data' => null,
        'image_files' => null,
        'emails' => null,
        'financial_data' => null,
        'communication_data' => null,
        'employee_data' => null,
        'usage_data' => null,
        'password_data' => null,
        'personnel_data' => null,
        'personnel_master_data' => null,
        'program_code' => null,
        'profile_data' => null,
        'transaction_data' => null,
        'contract_data' => null,
        'contract_billing_data' => null,
        'video_files' => null,
        'payment_data' => null,
        'ip_addresses' => null,
        'other' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'billing_data' => false,
		'address_data' => false,
		'offer_data' => false,
		'authentication_data' => false,
		'bank_details' => false,
		'order_data' => false,
		'image_files' => false,
		'emails' => false,
		'financial_data' => false,
		'communication_data' => false,
		'employee_data' => false,
		'usage_data' => false,
		'password_data' => false,
		'personnel_data' => false,
		'personnel_master_data' => false,
		'program_code' => false,
		'profile_data' => false,
		'transaction_data' => false,
		'contract_data' => false,
		'contract_billing_data' => false,
		'video_files' => false,
		'payment_data' => false,
		'ip_addresses' => false,
		'other' => false
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
        'billing_data' => 'billingData',
        'address_data' => 'addressData',
        'offer_data' => 'offerData',
        'authentication_data' => 'authenticationData',
        'bank_details' => 'bankDetails',
        'order_data' => 'orderData',
        'image_files' => 'imageFiles',
        'emails' => 'emails',
        'financial_data' => 'financialData',
        'communication_data' => 'communicationData',
        'employee_data' => 'employeeData',
        'usage_data' => 'usageData',
        'password_data' => 'passwordData',
        'personnel_data' => 'personnelData',
        'personnel_master_data' => 'personnelMasterData',
        'program_code' => 'programCode',
        'profile_data' => 'profileData',
        'transaction_data' => 'transactionData',
        'contract_data' => 'contractData',
        'contract_billing_data' => 'contractBillingData',
        'video_files' => 'videoFiles',
        'payment_data' => 'paymentData',
        'ip_addresses' => 'ipAddresses',
        'other' => 'other'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'billing_data' => 'setBillingData',
        'address_data' => 'setAddressData',
        'offer_data' => 'setOfferData',
        'authentication_data' => 'setAuthenticationData',
        'bank_details' => 'setBankDetails',
        'order_data' => 'setOrderData',
        'image_files' => 'setImageFiles',
        'emails' => 'setEmails',
        'financial_data' => 'setFinancialData',
        'communication_data' => 'setCommunicationData',
        'employee_data' => 'setEmployeeData',
        'usage_data' => 'setUsageData',
        'password_data' => 'setPasswordData',
        'personnel_data' => 'setPersonnelData',
        'personnel_master_data' => 'setPersonnelMasterData',
        'program_code' => 'setProgramCode',
        'profile_data' => 'setProfileData',
        'transaction_data' => 'setTransactionData',
        'contract_data' => 'setContractData',
        'contract_billing_data' => 'setContractBillingData',
        'video_files' => 'setVideoFiles',
        'payment_data' => 'setPaymentData',
        'ip_addresses' => 'setIpAddresses',
        'other' => 'setOther'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'billing_data' => 'getBillingData',
        'address_data' => 'getAddressData',
        'offer_data' => 'getOfferData',
        'authentication_data' => 'getAuthenticationData',
        'bank_details' => 'getBankDetails',
        'order_data' => 'getOrderData',
        'image_files' => 'getImageFiles',
        'emails' => 'getEmails',
        'financial_data' => 'getFinancialData',
        'communication_data' => 'getCommunicationData',
        'employee_data' => 'getEmployeeData',
        'usage_data' => 'getUsageData',
        'password_data' => 'getPasswordData',
        'personnel_data' => 'getPersonnelData',
        'personnel_master_data' => 'getPersonnelMasterData',
        'program_code' => 'getProgramCode',
        'profile_data' => 'getProfileData',
        'transaction_data' => 'getTransactionData',
        'contract_data' => 'getContractData',
        'contract_billing_data' => 'getContractBillingData',
        'video_files' => 'getVideoFiles',
        'payment_data' => 'getPaymentData',
        'ip_addresses' => 'getIpAddresses',
        'other' => 'getOther'
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
        $this->setIfExists('billing_data', $data ?? [], null);
        $this->setIfExists('address_data', $data ?? [], null);
        $this->setIfExists('offer_data', $data ?? [], null);
        $this->setIfExists('authentication_data', $data ?? [], null);
        $this->setIfExists('bank_details', $data ?? [], null);
        $this->setIfExists('order_data', $data ?? [], null);
        $this->setIfExists('image_files', $data ?? [], null);
        $this->setIfExists('emails', $data ?? [], null);
        $this->setIfExists('financial_data', $data ?? [], null);
        $this->setIfExists('communication_data', $data ?? [], null);
        $this->setIfExists('employee_data', $data ?? [], null);
        $this->setIfExists('usage_data', $data ?? [], null);
        $this->setIfExists('password_data', $data ?? [], null);
        $this->setIfExists('personnel_data', $data ?? [], null);
        $this->setIfExists('personnel_master_data', $data ?? [], null);
        $this->setIfExists('program_code', $data ?? [], null);
        $this->setIfExists('profile_data', $data ?? [], null);
        $this->setIfExists('transaction_data', $data ?? [], null);
        $this->setIfExists('contract_data', $data ?? [], null);
        $this->setIfExists('contract_billing_data', $data ?? [], null);
        $this->setIfExists('video_files', $data ?? [], null);
        $this->setIfExists('payment_data', $data ?? [], null);
        $this->setIfExists('ip_addresses', $data ?? [], null);
        $this->setIfExists('other', $data ?? [], null);
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

        if ($this->container['billing_data'] === null) {
            $invalidProperties[] = "'billing_data' can't be null";
        }
        if ($this->container['address_data'] === null) {
            $invalidProperties[] = "'address_data' can't be null";
        }
        if ($this->container['offer_data'] === null) {
            $invalidProperties[] = "'offer_data' can't be null";
        }
        if ($this->container['authentication_data'] === null) {
            $invalidProperties[] = "'authentication_data' can't be null";
        }
        if ($this->container['bank_details'] === null) {
            $invalidProperties[] = "'bank_details' can't be null";
        }
        if ($this->container['order_data'] === null) {
            $invalidProperties[] = "'order_data' can't be null";
        }
        if ($this->container['image_files'] === null) {
            $invalidProperties[] = "'image_files' can't be null";
        }
        if ($this->container['emails'] === null) {
            $invalidProperties[] = "'emails' can't be null";
        }
        if ($this->container['financial_data'] === null) {
            $invalidProperties[] = "'financial_data' can't be null";
        }
        if ($this->container['communication_data'] === null) {
            $invalidProperties[] = "'communication_data' can't be null";
        }
        if ($this->container['employee_data'] === null) {
            $invalidProperties[] = "'employee_data' can't be null";
        }
        if ($this->container['usage_data'] === null) {
            $invalidProperties[] = "'usage_data' can't be null";
        }
        if ($this->container['password_data'] === null) {
            $invalidProperties[] = "'password_data' can't be null";
        }
        if ($this->container['personnel_data'] === null) {
            $invalidProperties[] = "'personnel_data' can't be null";
        }
        if ($this->container['personnel_master_data'] === null) {
            $invalidProperties[] = "'personnel_master_data' can't be null";
        }
        if ($this->container['program_code'] === null) {
            $invalidProperties[] = "'program_code' can't be null";
        }
        if ($this->container['profile_data'] === null) {
            $invalidProperties[] = "'profile_data' can't be null";
        }
        if ($this->container['transaction_data'] === null) {
            $invalidProperties[] = "'transaction_data' can't be null";
        }
        if ($this->container['contract_data'] === null) {
            $invalidProperties[] = "'contract_data' can't be null";
        }
        if ($this->container['contract_billing_data'] === null) {
            $invalidProperties[] = "'contract_billing_data' can't be null";
        }
        if ($this->container['video_files'] === null) {
            $invalidProperties[] = "'video_files' can't be null";
        }
        if ($this->container['payment_data'] === null) {
            $invalidProperties[] = "'payment_data' can't be null";
        }
        if ($this->container['ip_addresses'] === null) {
            $invalidProperties[] = "'ip_addresses' can't be null";
        }
        if ($this->container['other'] === null) {
            $invalidProperties[] = "'other' can't be null";
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
     * Gets billing_data
     *
     * @return bool
     */
    public function getBillingData()
    {
        return $this->container['billing_data'];
    }

    /**
     * Sets billing_data
     *
     * @param bool $billing_data Billing Data
     *
     * @return self
     */
    public function setBillingData($billing_data)
    {

        if (is_null($billing_data)) {
            throw new \InvalidArgumentException('non-nullable billing_data cannot be null');
        }

        $this->container['billing_data'] = $billing_data;

        return $this;
    }

    /**
     * Gets address_data
     *
     * @return bool
     */
    public function getAddressData()
    {
        return $this->container['address_data'];
    }

    /**
     * Sets address_data
     *
     * @param bool $address_data Address Data
     *
     * @return self
     */
    public function setAddressData($address_data)
    {

        if (is_null($address_data)) {
            throw new \InvalidArgumentException('non-nullable address_data cannot be null');
        }

        $this->container['address_data'] = $address_data;

        return $this;
    }

    /**
     * Gets offer_data
     *
     * @return bool
     */
    public function getOfferData()
    {
        return $this->container['offer_data'];
    }

    /**
     * Sets offer_data
     *
     * @param bool $offer_data Offer Data
     *
     * @return self
     */
    public function setOfferData($offer_data)
    {

        if (is_null($offer_data)) {
            throw new \InvalidArgumentException('non-nullable offer_data cannot be null');
        }

        $this->container['offer_data'] = $offer_data;

        return $this;
    }

    /**
     * Gets authentication_data
     *
     * @return bool
     */
    public function getAuthenticationData()
    {
        return $this->container['authentication_data'];
    }

    /**
     * Sets authentication_data
     *
     * @param bool $authentication_data Authentication Data
     *
     * @return self
     */
    public function setAuthenticationData($authentication_data)
    {

        if (is_null($authentication_data)) {
            throw new \InvalidArgumentException('non-nullable authentication_data cannot be null');
        }

        $this->container['authentication_data'] = $authentication_data;

        return $this;
    }

    /**
     * Gets bank_details
     *
     * @return bool
     */
    public function getBankDetails()
    {
        return $this->container['bank_details'];
    }

    /**
     * Sets bank_details
     *
     * @param bool $bank_details Bank Details
     *
     * @return self
     */
    public function setBankDetails($bank_details)
    {

        if (is_null($bank_details)) {
            throw new \InvalidArgumentException('non-nullable bank_details cannot be null');
        }

        $this->container['bank_details'] = $bank_details;

        return $this;
    }

    /**
     * Gets order_data
     *
     * @return bool
     */
    public function getOrderData()
    {
        return $this->container['order_data'];
    }

    /**
     * Sets order_data
     *
     * @param bool $order_data Order Data
     *
     * @return self
     */
    public function setOrderData($order_data)
    {

        if (is_null($order_data)) {
            throw new \InvalidArgumentException('non-nullable order_data cannot be null');
        }

        $this->container['order_data'] = $order_data;

        return $this;
    }

    /**
     * Gets image_files
     *
     * @return bool
     */
    public function getImageFiles()
    {
        return $this->container['image_files'];
    }

    /**
     * Sets image_files
     *
     * @param bool $image_files Image Files
     *
     * @return self
     */
    public function setImageFiles($image_files)
    {

        if (is_null($image_files)) {
            throw new \InvalidArgumentException('non-nullable image_files cannot be null');
        }

        $this->container['image_files'] = $image_files;

        return $this;
    }

    /**
     * Gets emails
     *
     * @return bool
     */
    public function getEmails()
    {
        return $this->container['emails'];
    }

    /**
     * Sets emails
     *
     * @param bool $emails Emails
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
     * Gets financial_data
     *
     * @return bool
     */
    public function getFinancialData()
    {
        return $this->container['financial_data'];
    }

    /**
     * Sets financial_data
     *
     * @param bool $financial_data Financial Data
     *
     * @return self
     */
    public function setFinancialData($financial_data)
    {

        if (is_null($financial_data)) {
            throw new \InvalidArgumentException('non-nullable financial_data cannot be null');
        }

        $this->container['financial_data'] = $financial_data;

        return $this;
    }

    /**
     * Gets communication_data
     *
     * @return bool
     */
    public function getCommunicationData()
    {
        return $this->container['communication_data'];
    }

    /**
     * Sets communication_data
     *
     * @param bool $communication_data Communication Data
     *
     * @return self
     */
    public function setCommunicationData($communication_data)
    {

        if (is_null($communication_data)) {
            throw new \InvalidArgumentException('non-nullable communication_data cannot be null');
        }

        $this->container['communication_data'] = $communication_data;

        return $this;
    }

    /**
     * Gets employee_data
     *
     * @return bool
     */
    public function getEmployeeData()
    {
        return $this->container['employee_data'];
    }

    /**
     * Sets employee_data
     *
     * @param bool $employee_data Employee Data
     *
     * @return self
     */
    public function setEmployeeData($employee_data)
    {

        if (is_null($employee_data)) {
            throw new \InvalidArgumentException('non-nullable employee_data cannot be null');
        }

        $this->container['employee_data'] = $employee_data;

        return $this;
    }

    /**
     * Gets usage_data
     *
     * @return bool
     */
    public function getUsageData()
    {
        return $this->container['usage_data'];
    }

    /**
     * Sets usage_data
     *
     * @param bool $usage_data Usage Data
     *
     * @return self
     */
    public function setUsageData($usage_data)
    {

        if (is_null($usage_data)) {
            throw new \InvalidArgumentException('non-nullable usage_data cannot be null');
        }

        $this->container['usage_data'] = $usage_data;

        return $this;
    }

    /**
     * Gets password_data
     *
     * @return bool
     */
    public function getPasswordData()
    {
        return $this->container['password_data'];
    }

    /**
     * Sets password_data
     *
     * @param bool $password_data Password Data
     *
     * @return self
     */
    public function setPasswordData($password_data)
    {

        if (is_null($password_data)) {
            throw new \InvalidArgumentException('non-nullable password_data cannot be null');
        }

        $this->container['password_data'] = $password_data;

        return $this;
    }

    /**
     * Gets personnel_data
     *
     * @return bool
     */
    public function getPersonnelData()
    {
        return $this->container['personnel_data'];
    }

    /**
     * Sets personnel_data
     *
     * @param bool $personnel_data Personnel Data
     *
     * @return self
     */
    public function setPersonnelData($personnel_data)
    {

        if (is_null($personnel_data)) {
            throw new \InvalidArgumentException('non-nullable personnel_data cannot be null');
        }

        $this->container['personnel_data'] = $personnel_data;

        return $this;
    }

    /**
     * Gets personnel_master_data
     *
     * @return bool
     */
    public function getPersonnelMasterData()
    {
        return $this->container['personnel_master_data'];
    }

    /**
     * Sets personnel_master_data
     *
     * @param bool $personnel_master_data Personnel Master Data
     *
     * @return self
     */
    public function setPersonnelMasterData($personnel_master_data)
    {

        if (is_null($personnel_master_data)) {
            throw new \InvalidArgumentException('non-nullable personnel_master_data cannot be null');
        }

        $this->container['personnel_master_data'] = $personnel_master_data;

        return $this;
    }

    /**
     * Gets program_code
     *
     * @return bool
     */
    public function getProgramCode()
    {
        return $this->container['program_code'];
    }

    /**
     * Sets program_code
     *
     * @param bool $program_code Program Code
     *
     * @return self
     */
    public function setProgramCode($program_code)
    {

        if (is_null($program_code)) {
            throw new \InvalidArgumentException('non-nullable program_code cannot be null');
        }

        $this->container['program_code'] = $program_code;

        return $this;
    }

    /**
     * Gets profile_data
     *
     * @return bool
     */
    public function getProfileData()
    {
        return $this->container['profile_data'];
    }

    /**
     * Sets profile_data
     *
     * @param bool $profile_data Profile Data
     *
     * @return self
     */
    public function setProfileData($profile_data)
    {

        if (is_null($profile_data)) {
            throw new \InvalidArgumentException('non-nullable profile_data cannot be null');
        }

        $this->container['profile_data'] = $profile_data;

        return $this;
    }

    /**
     * Gets transaction_data
     *
     * @return bool
     */
    public function getTransactionData()
    {
        return $this->container['transaction_data'];
    }

    /**
     * Sets transaction_data
     *
     * @param bool $transaction_data Transaction Data
     *
     * @return self
     */
    public function setTransactionData($transaction_data)
    {

        if (is_null($transaction_data)) {
            throw new \InvalidArgumentException('non-nullable transaction_data cannot be null');
        }

        $this->container['transaction_data'] = $transaction_data;

        return $this;
    }

    /**
     * Gets contract_data
     *
     * @return bool
     */
    public function getContractData()
    {
        return $this->container['contract_data'];
    }

    /**
     * Sets contract_data
     *
     * @param bool $contract_data Contract Data
     *
     * @return self
     */
    public function setContractData($contract_data)
    {

        if (is_null($contract_data)) {
            throw new \InvalidArgumentException('non-nullable contract_data cannot be null');
        }

        $this->container['contract_data'] = $contract_data;

        return $this;
    }

    /**
     * Gets contract_billing_data
     *
     * @return bool
     */
    public function getContractBillingData()
    {
        return $this->container['contract_billing_data'];
    }

    /**
     * Sets contract_billing_data
     *
     * @param bool $contract_billing_data Contract Billing Data
     *
     * @return self
     */
    public function setContractBillingData($contract_billing_data)
    {

        if (is_null($contract_billing_data)) {
            throw new \InvalidArgumentException('non-nullable contract_billing_data cannot be null');
        }

        $this->container['contract_billing_data'] = $contract_billing_data;

        return $this;
    }

    /**
     * Gets video_files
     *
     * @return bool
     */
    public function getVideoFiles()
    {
        return $this->container['video_files'];
    }

    /**
     * Sets video_files
     *
     * @param bool $video_files Video Files
     *
     * @return self
     */
    public function setVideoFiles($video_files)
    {

        if (is_null($video_files)) {
            throw new \InvalidArgumentException('non-nullable video_files cannot be null');
        }

        $this->container['video_files'] = $video_files;

        return $this;
    }

    /**
     * Gets payment_data
     *
     * @return bool
     */
    public function getPaymentData()
    {
        return $this->container['payment_data'];
    }

    /**
     * Sets payment_data
     *
     * @param bool $payment_data Payment Data
     *
     * @return self
     */
    public function setPaymentData($payment_data)
    {

        if (is_null($payment_data)) {
            throw new \InvalidArgumentException('non-nullable payment_data cannot be null');
        }

        $this->container['payment_data'] = $payment_data;

        return $this;
    }

    /**
     * Gets ip_addresses
     *
     * @return bool
     */
    public function getIpAddresses()
    {
        return $this->container['ip_addresses'];
    }

    /**
     * Sets ip_addresses
     *
     * @param bool $ip_addresses Ip Addresses
     *
     * @return self
     */
    public function setIpAddresses($ip_addresses)
    {

        if (is_null($ip_addresses)) {
            throw new \InvalidArgumentException('non-nullable ip_addresses cannot be null');
        }

        $this->container['ip_addresses'] = $ip_addresses;

        return $this;
    }

    /**
     * Gets other
     *
     * @return \OpenAPI\Client\Model\OtherData
     */
    public function getOther()
    {
        return $this->container['other'];
    }

    /**
     * Sets other
     *
     * @param \OpenAPI\Client\Model\OtherData $other other
     *
     * @return self
     */
    public function setOther($other)
    {

        if (is_null($other)) {
            throw new \InvalidArgumentException('non-nullable other cannot be null');
        }

        $this->container['other'] = $other;

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


