<?php
/**
 * AffectedPersons
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
 * AffectedPersons Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AffectedPersons implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AffectedPersons';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'subscribers' => 'bool',
        'relatives' => 'bool',
        'trainees' => 'bool',
        'applicants' => 'bool',
        'consultants' => 'bool',
        'service_providers' => 'bool',
        'former_employees' => 'bool',
        'aggrieved_parties' => 'bool',
        'business_partners' => 'bool',
        'shareholders' => 'bool',
        'commercial_agents' => 'bool',
        'interested_parties' => 'bool',
        'customers' => 'bool',
        'suppliers' => 'bool',
        'brokers_or_intermediaries' => 'bool',
        'tenants' => 'bool',
        'employees' => 'bool',
        'members' => 'bool',
        'users' => 'bool',
        'interns' => 'bool',
        'dependents' => 'bool',
        'press' => 'bool',
        'witnesses' => 'bool',
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
        'subscribers' => null,
        'relatives' => null,
        'trainees' => null,
        'applicants' => null,
        'consultants' => null,
        'service_providers' => null,
        'former_employees' => null,
        'aggrieved_parties' => null,
        'business_partners' => null,
        'shareholders' => null,
        'commercial_agents' => null,
        'interested_parties' => null,
        'customers' => null,
        'suppliers' => null,
        'brokers_or_intermediaries' => null,
        'tenants' => null,
        'employees' => null,
        'members' => null,
        'users' => null,
        'interns' => null,
        'dependents' => null,
        'press' => null,
        'witnesses' => null,
        'other' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'subscribers' => false,
		'relatives' => false,
		'trainees' => false,
		'applicants' => false,
		'consultants' => false,
		'service_providers' => false,
		'former_employees' => false,
		'aggrieved_parties' => false,
		'business_partners' => false,
		'shareholders' => false,
		'commercial_agents' => false,
		'interested_parties' => false,
		'customers' => false,
		'suppliers' => false,
		'brokers_or_intermediaries' => false,
		'tenants' => false,
		'employees' => false,
		'members' => false,
		'users' => false,
		'interns' => false,
		'dependents' => false,
		'press' => false,
		'witnesses' => false,
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
        'subscribers' => 'subscribers',
        'relatives' => 'relatives',
        'trainees' => 'trainees',
        'applicants' => 'applicants',
        'consultants' => 'consultants',
        'service_providers' => 'serviceProviders',
        'former_employees' => 'formerEmployees',
        'aggrieved_parties' => 'aggrievedParties',
        'business_partners' => 'businessPartners',
        'shareholders' => 'shareholders',
        'commercial_agents' => 'commercialAgents',
        'interested_parties' => 'interestedParties',
        'customers' => 'customers',
        'suppliers' => 'suppliers',
        'brokers_or_intermediaries' => 'brokersOrIntermediaries',
        'tenants' => 'tenants',
        'employees' => 'employees',
        'members' => 'members',
        'users' => 'users',
        'interns' => 'interns',
        'dependents' => 'dependents',
        'press' => 'press',
        'witnesses' => 'witnesses',
        'other' => 'other'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'subscribers' => 'setSubscribers',
        'relatives' => 'setRelatives',
        'trainees' => 'setTrainees',
        'applicants' => 'setApplicants',
        'consultants' => 'setConsultants',
        'service_providers' => 'setServiceProviders',
        'former_employees' => 'setFormerEmployees',
        'aggrieved_parties' => 'setAggrievedParties',
        'business_partners' => 'setBusinessPartners',
        'shareholders' => 'setShareholders',
        'commercial_agents' => 'setCommercialAgents',
        'interested_parties' => 'setInterestedParties',
        'customers' => 'setCustomers',
        'suppliers' => 'setSuppliers',
        'brokers_or_intermediaries' => 'setBrokersOrIntermediaries',
        'tenants' => 'setTenants',
        'employees' => 'setEmployees',
        'members' => 'setMembers',
        'users' => 'setUsers',
        'interns' => 'setInterns',
        'dependents' => 'setDependents',
        'press' => 'setPress',
        'witnesses' => 'setWitnesses',
        'other' => 'setOther'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'subscribers' => 'getSubscribers',
        'relatives' => 'getRelatives',
        'trainees' => 'getTrainees',
        'applicants' => 'getApplicants',
        'consultants' => 'getConsultants',
        'service_providers' => 'getServiceProviders',
        'former_employees' => 'getFormerEmployees',
        'aggrieved_parties' => 'getAggrievedParties',
        'business_partners' => 'getBusinessPartners',
        'shareholders' => 'getShareholders',
        'commercial_agents' => 'getCommercialAgents',
        'interested_parties' => 'getInterestedParties',
        'customers' => 'getCustomers',
        'suppliers' => 'getSuppliers',
        'brokers_or_intermediaries' => 'getBrokersOrIntermediaries',
        'tenants' => 'getTenants',
        'employees' => 'getEmployees',
        'members' => 'getMembers',
        'users' => 'getUsers',
        'interns' => 'getInterns',
        'dependents' => 'getDependents',
        'press' => 'getPress',
        'witnesses' => 'getWitnesses',
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
        $this->setIfExists('subscribers', $data ?? [], null);
        $this->setIfExists('relatives', $data ?? [], null);
        $this->setIfExists('trainees', $data ?? [], null);
        $this->setIfExists('applicants', $data ?? [], null);
        $this->setIfExists('consultants', $data ?? [], null);
        $this->setIfExists('service_providers', $data ?? [], null);
        $this->setIfExists('former_employees', $data ?? [], null);
        $this->setIfExists('aggrieved_parties', $data ?? [], null);
        $this->setIfExists('business_partners', $data ?? [], null);
        $this->setIfExists('shareholders', $data ?? [], null);
        $this->setIfExists('commercial_agents', $data ?? [], null);
        $this->setIfExists('interested_parties', $data ?? [], null);
        $this->setIfExists('customers', $data ?? [], null);
        $this->setIfExists('suppliers', $data ?? [], null);
        $this->setIfExists('brokers_or_intermediaries', $data ?? [], null);
        $this->setIfExists('tenants', $data ?? [], null);
        $this->setIfExists('employees', $data ?? [], null);
        $this->setIfExists('members', $data ?? [], null);
        $this->setIfExists('users', $data ?? [], null);
        $this->setIfExists('interns', $data ?? [], null);
        $this->setIfExists('dependents', $data ?? [], null);
        $this->setIfExists('press', $data ?? [], null);
        $this->setIfExists('witnesses', $data ?? [], null);
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

        if ($this->container['subscribers'] === null) {
            $invalidProperties[] = "'subscribers' can't be null";
        }
        if ($this->container['relatives'] === null) {
            $invalidProperties[] = "'relatives' can't be null";
        }
        if ($this->container['trainees'] === null) {
            $invalidProperties[] = "'trainees' can't be null";
        }
        if ($this->container['applicants'] === null) {
            $invalidProperties[] = "'applicants' can't be null";
        }
        if ($this->container['consultants'] === null) {
            $invalidProperties[] = "'consultants' can't be null";
        }
        if ($this->container['service_providers'] === null) {
            $invalidProperties[] = "'service_providers' can't be null";
        }
        if ($this->container['former_employees'] === null) {
            $invalidProperties[] = "'former_employees' can't be null";
        }
        if ($this->container['aggrieved_parties'] === null) {
            $invalidProperties[] = "'aggrieved_parties' can't be null";
        }
        if ($this->container['business_partners'] === null) {
            $invalidProperties[] = "'business_partners' can't be null";
        }
        if ($this->container['shareholders'] === null) {
            $invalidProperties[] = "'shareholders' can't be null";
        }
        if ($this->container['commercial_agents'] === null) {
            $invalidProperties[] = "'commercial_agents' can't be null";
        }
        if ($this->container['interested_parties'] === null) {
            $invalidProperties[] = "'interested_parties' can't be null";
        }
        if ($this->container['customers'] === null) {
            $invalidProperties[] = "'customers' can't be null";
        }
        if ($this->container['suppliers'] === null) {
            $invalidProperties[] = "'suppliers' can't be null";
        }
        if ($this->container['brokers_or_intermediaries'] === null) {
            $invalidProperties[] = "'brokers_or_intermediaries' can't be null";
        }
        if ($this->container['tenants'] === null) {
            $invalidProperties[] = "'tenants' can't be null";
        }
        if ($this->container['employees'] === null) {
            $invalidProperties[] = "'employees' can't be null";
        }
        if ($this->container['members'] === null) {
            $invalidProperties[] = "'members' can't be null";
        }
        if ($this->container['users'] === null) {
            $invalidProperties[] = "'users' can't be null";
        }
        if ($this->container['interns'] === null) {
            $invalidProperties[] = "'interns' can't be null";
        }
        if ($this->container['dependents'] === null) {
            $invalidProperties[] = "'dependents' can't be null";
        }
        if ($this->container['press'] === null) {
            $invalidProperties[] = "'press' can't be null";
        }
        if ($this->container['witnesses'] === null) {
            $invalidProperties[] = "'witnesses' can't be null";
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
     * Gets subscribers
     *
     * @return bool
     */
    public function getSubscribers()
    {
        return $this->container['subscribers'];
    }

    /**
     * Sets subscribers
     *
     * @param bool $subscribers Subscribers
     *
     * @return self
     */
    public function setSubscribers($subscribers)
    {

        if (is_null($subscribers)) {
            throw new \InvalidArgumentException('non-nullable subscribers cannot be null');
        }

        $this->container['subscribers'] = $subscribers;

        return $this;
    }

    /**
     * Gets relatives
     *
     * @return bool
     */
    public function getRelatives()
    {
        return $this->container['relatives'];
    }

    /**
     * Sets relatives
     *
     * @param bool $relatives Relatives
     *
     * @return self
     */
    public function setRelatives($relatives)
    {

        if (is_null($relatives)) {
            throw new \InvalidArgumentException('non-nullable relatives cannot be null');
        }

        $this->container['relatives'] = $relatives;

        return $this;
    }

    /**
     * Gets trainees
     *
     * @return bool
     */
    public function getTrainees()
    {
        return $this->container['trainees'];
    }

    /**
     * Sets trainees
     *
     * @param bool $trainees Trainees
     *
     * @return self
     */
    public function setTrainees($trainees)
    {

        if (is_null($trainees)) {
            throw new \InvalidArgumentException('non-nullable trainees cannot be null');
        }

        $this->container['trainees'] = $trainees;

        return $this;
    }

    /**
     * Gets applicants
     *
     * @return bool
     */
    public function getApplicants()
    {
        return $this->container['applicants'];
    }

    /**
     * Sets applicants
     *
     * @param bool $applicants Applicants
     *
     * @return self
     */
    public function setApplicants($applicants)
    {

        if (is_null($applicants)) {
            throw new \InvalidArgumentException('non-nullable applicants cannot be null');
        }

        $this->container['applicants'] = $applicants;

        return $this;
    }

    /**
     * Gets consultants
     *
     * @return bool
     */
    public function getConsultants()
    {
        return $this->container['consultants'];
    }

    /**
     * Sets consultants
     *
     * @param bool $consultants Consultants
     *
     * @return self
     */
    public function setConsultants($consultants)
    {

        if (is_null($consultants)) {
            throw new \InvalidArgumentException('non-nullable consultants cannot be null');
        }

        $this->container['consultants'] = $consultants;

        return $this;
    }

    /**
     * Gets service_providers
     *
     * @return bool
     */
    public function getServiceProviders()
    {
        return $this->container['service_providers'];
    }

    /**
     * Sets service_providers
     *
     * @param bool $service_providers Service Providers
     *
     * @return self
     */
    public function setServiceProviders($service_providers)
    {

        if (is_null($service_providers)) {
            throw new \InvalidArgumentException('non-nullable service_providers cannot be null');
        }

        $this->container['service_providers'] = $service_providers;

        return $this;
    }

    /**
     * Gets former_employees
     *
     * @return bool
     */
    public function getFormerEmployees()
    {
        return $this->container['former_employees'];
    }

    /**
     * Sets former_employees
     *
     * @param bool $former_employees Former Employees
     *
     * @return self
     */
    public function setFormerEmployees($former_employees)
    {

        if (is_null($former_employees)) {
            throw new \InvalidArgumentException('non-nullable former_employees cannot be null');
        }

        $this->container['former_employees'] = $former_employees;

        return $this;
    }

    /**
     * Gets aggrieved_parties
     *
     * @return bool
     */
    public function getAggrievedParties()
    {
        return $this->container['aggrieved_parties'];
    }

    /**
     * Sets aggrieved_parties
     *
     * @param bool $aggrieved_parties Aggrieved Parties
     *
     * @return self
     */
    public function setAggrievedParties($aggrieved_parties)
    {

        if (is_null($aggrieved_parties)) {
            throw new \InvalidArgumentException('non-nullable aggrieved_parties cannot be null');
        }

        $this->container['aggrieved_parties'] = $aggrieved_parties;

        return $this;
    }

    /**
     * Gets business_partners
     *
     * @return bool
     */
    public function getBusinessPartners()
    {
        return $this->container['business_partners'];
    }

    /**
     * Sets business_partners
     *
     * @param bool $business_partners Business Partners
     *
     * @return self
     */
    public function setBusinessPartners($business_partners)
    {

        if (is_null($business_partners)) {
            throw new \InvalidArgumentException('non-nullable business_partners cannot be null');
        }

        $this->container['business_partners'] = $business_partners;

        return $this;
    }

    /**
     * Gets shareholders
     *
     * @return bool
     */
    public function getShareholders()
    {
        return $this->container['shareholders'];
    }

    /**
     * Sets shareholders
     *
     * @param bool $shareholders Shareholders
     *
     * @return self
     */
    public function setShareholders($shareholders)
    {

        if (is_null($shareholders)) {
            throw new \InvalidArgumentException('non-nullable shareholders cannot be null');
        }

        $this->container['shareholders'] = $shareholders;

        return $this;
    }

    /**
     * Gets commercial_agents
     *
     * @return bool
     */
    public function getCommercialAgents()
    {
        return $this->container['commercial_agents'];
    }

    /**
     * Sets commercial_agents
     *
     * @param bool $commercial_agents Commercial Agents
     *
     * @return self
     */
    public function setCommercialAgents($commercial_agents)
    {

        if (is_null($commercial_agents)) {
            throw new \InvalidArgumentException('non-nullable commercial_agents cannot be null');
        }

        $this->container['commercial_agents'] = $commercial_agents;

        return $this;
    }

    /**
     * Gets interested_parties
     *
     * @return bool
     */
    public function getInterestedParties()
    {
        return $this->container['interested_parties'];
    }

    /**
     * Sets interested_parties
     *
     * @param bool $interested_parties Interested Parties
     *
     * @return self
     */
    public function setInterestedParties($interested_parties)
    {

        if (is_null($interested_parties)) {
            throw new \InvalidArgumentException('non-nullable interested_parties cannot be null');
        }

        $this->container['interested_parties'] = $interested_parties;

        return $this;
    }

    /**
     * Gets customers
     *
     * @return bool
     */
    public function getCustomers()
    {
        return $this->container['customers'];
    }

    /**
     * Sets customers
     *
     * @param bool $customers Customers
     *
     * @return self
     */
    public function setCustomers($customers)
    {

        if (is_null($customers)) {
            throw new \InvalidArgumentException('non-nullable customers cannot be null');
        }

        $this->container['customers'] = $customers;

        return $this;
    }

    /**
     * Gets suppliers
     *
     * @return bool
     */
    public function getSuppliers()
    {
        return $this->container['suppliers'];
    }

    /**
     * Sets suppliers
     *
     * @param bool $suppliers Suppliers
     *
     * @return self
     */
    public function setSuppliers($suppliers)
    {

        if (is_null($suppliers)) {
            throw new \InvalidArgumentException('non-nullable suppliers cannot be null');
        }

        $this->container['suppliers'] = $suppliers;

        return $this;
    }

    /**
     * Gets brokers_or_intermediaries
     *
     * @return bool
     */
    public function getBrokersOrIntermediaries()
    {
        return $this->container['brokers_or_intermediaries'];
    }

    /**
     * Sets brokers_or_intermediaries
     *
     * @param bool $brokers_or_intermediaries Brokers/Intermediaries
     *
     * @return self
     */
    public function setBrokersOrIntermediaries($brokers_or_intermediaries)
    {

        if (is_null($brokers_or_intermediaries)) {
            throw new \InvalidArgumentException('non-nullable brokers_or_intermediaries cannot be null');
        }

        $this->container['brokers_or_intermediaries'] = $brokers_or_intermediaries;

        return $this;
    }

    /**
     * Gets tenants
     *
     * @return bool
     */
    public function getTenants()
    {
        return $this->container['tenants'];
    }

    /**
     * Sets tenants
     *
     * @param bool $tenants Tenants
     *
     * @return self
     */
    public function setTenants($tenants)
    {

        if (is_null($tenants)) {
            throw new \InvalidArgumentException('non-nullable tenants cannot be null');
        }

        $this->container['tenants'] = $tenants;

        return $this;
    }

    /**
     * Gets employees
     *
     * @return bool
     */
    public function getEmployees()
    {
        return $this->container['employees'];
    }

    /**
     * Sets employees
     *
     * @param bool $employees Employees
     *
     * @return self
     */
    public function setEmployees($employees)
    {

        if (is_null($employees)) {
            throw new \InvalidArgumentException('non-nullable employees cannot be null');
        }

        $this->container['employees'] = $employees;

        return $this;
    }

    /**
     * Gets members
     *
     * @return bool
     */
    public function getMembers()
    {
        return $this->container['members'];
    }

    /**
     * Sets members
     *
     * @param bool $members Members
     *
     * @return self
     */
    public function setMembers($members)
    {

        if (is_null($members)) {
            throw new \InvalidArgumentException('non-nullable members cannot be null');
        }

        $this->container['members'] = $members;

        return $this;
    }

    /**
     * Gets users
     *
     * @return bool
     */
    public function getUsers()
    {
        return $this->container['users'];
    }

    /**
     * Sets users
     *
     * @param bool $users Users
     *
     * @return self
     */
    public function setUsers($users)
    {

        if (is_null($users)) {
            throw new \InvalidArgumentException('non-nullable users cannot be null');
        }

        $this->container['users'] = $users;

        return $this;
    }

    /**
     * Gets interns
     *
     * @return bool
     */
    public function getInterns()
    {
        return $this->container['interns'];
    }

    /**
     * Sets interns
     *
     * @param bool $interns Interns
     *
     * @return self
     */
    public function setInterns($interns)
    {

        if (is_null($interns)) {
            throw new \InvalidArgumentException('non-nullable interns cannot be null');
        }

        $this->container['interns'] = $interns;

        return $this;
    }

    /**
     * Gets dependents
     *
     * @return bool
     */
    public function getDependents()
    {
        return $this->container['dependents'];
    }

    /**
     * Sets dependents
     *
     * @param bool $dependents Dependents
     *
     * @return self
     */
    public function setDependents($dependents)
    {

        if (is_null($dependents)) {
            throw new \InvalidArgumentException('non-nullable dependents cannot be null');
        }

        $this->container['dependents'] = $dependents;

        return $this;
    }

    /**
     * Gets press
     *
     * @return bool
     */
    public function getPress()
    {
        return $this->container['press'];
    }

    /**
     * Sets press
     *
     * @param bool $press Press
     *
     * @return self
     */
    public function setPress($press)
    {

        if (is_null($press)) {
            throw new \InvalidArgumentException('non-nullable press cannot be null');
        }

        $this->container['press'] = $press;

        return $this;
    }

    /**
     * Gets witnesses
     *
     * @return bool
     */
    public function getWitnesses()
    {
        return $this->container['witnesses'];
    }

    /**
     * Sets witnesses
     *
     * @param bool $witnesses Witnesses
     *
     * @return self
     */
    public function setWitnesses($witnesses)
    {

        if (is_null($witnesses)) {
            throw new \InvalidArgumentException('non-nullable witnesses cannot be null');
        }

        $this->container['witnesses'] = $witnesses;

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


