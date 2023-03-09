<?php
/**
 * PersonalData
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
 * PersonalData Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PersonalData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PersonalData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'biometric_data' => 'bool',
        'genetic_data' => 'bool',
        'health_data' => 'bool',
        'political_opinion_data' => 'bool',
        'racial_and_ethnic_origin_data' => 'bool',
        'religious_and_philosophical_beliefs_data' => 'bool',
        'labor_organization_membership_data' => 'bool',
        'sexual_life_data' => 'bool',
        'personality_data' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'biometric_data' => null,
        'genetic_data' => null,
        'health_data' => null,
        'political_opinion_data' => null,
        'racial_and_ethnic_origin_data' => null,
        'religious_and_philosophical_beliefs_data' => null,
        'labor_organization_membership_data' => null,
        'sexual_life_data' => null,
        'personality_data' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'biometric_data' => false,
		'genetic_data' => false,
		'health_data' => false,
		'political_opinion_data' => false,
		'racial_and_ethnic_origin_data' => false,
		'religious_and_philosophical_beliefs_data' => false,
		'labor_organization_membership_data' => false,
		'sexual_life_data' => false,
		'personality_data' => false
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
        'biometric_data' => 'biometricData',
        'genetic_data' => 'geneticData',
        'health_data' => 'healthData',
        'political_opinion_data' => 'politicalOpinionData',
        'racial_and_ethnic_origin_data' => 'racialAndEthnicOriginData',
        'religious_and_philosophical_beliefs_data' => 'religiousAndPhilosophicalBeliefsData',
        'labor_organization_membership_data' => 'laborOrganizationMembershipData',
        'sexual_life_data' => 'sexualLifeData',
        'personality_data' => 'personalityData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'biometric_data' => 'setBiometricData',
        'genetic_data' => 'setGeneticData',
        'health_data' => 'setHealthData',
        'political_opinion_data' => 'setPoliticalOpinionData',
        'racial_and_ethnic_origin_data' => 'setRacialAndEthnicOriginData',
        'religious_and_philosophical_beliefs_data' => 'setReligiousAndPhilosophicalBeliefsData',
        'labor_organization_membership_data' => 'setLaborOrganizationMembershipData',
        'sexual_life_data' => 'setSexualLifeData',
        'personality_data' => 'setPersonalityData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'biometric_data' => 'getBiometricData',
        'genetic_data' => 'getGeneticData',
        'health_data' => 'getHealthData',
        'political_opinion_data' => 'getPoliticalOpinionData',
        'racial_and_ethnic_origin_data' => 'getRacialAndEthnicOriginData',
        'religious_and_philosophical_beliefs_data' => 'getReligiousAndPhilosophicalBeliefsData',
        'labor_organization_membership_data' => 'getLaborOrganizationMembershipData',
        'sexual_life_data' => 'getSexualLifeData',
        'personality_data' => 'getPersonalityData'
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
        $this->setIfExists('biometric_data', $data ?? [], null);
        $this->setIfExists('genetic_data', $data ?? [], null);
        $this->setIfExists('health_data', $data ?? [], null);
        $this->setIfExists('political_opinion_data', $data ?? [], null);
        $this->setIfExists('racial_and_ethnic_origin_data', $data ?? [], null);
        $this->setIfExists('religious_and_philosophical_beliefs_data', $data ?? [], null);
        $this->setIfExists('labor_organization_membership_data', $data ?? [], null);
        $this->setIfExists('sexual_life_data', $data ?? [], null);
        $this->setIfExists('personality_data', $data ?? [], null);
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

        if ($this->container['biometric_data'] === null) {
            $invalidProperties[] = "'biometric_data' can't be null";
        }
        if ($this->container['genetic_data'] === null) {
            $invalidProperties[] = "'genetic_data' can't be null";
        }
        if ($this->container['health_data'] === null) {
            $invalidProperties[] = "'health_data' can't be null";
        }
        if ($this->container['political_opinion_data'] === null) {
            $invalidProperties[] = "'political_opinion_data' can't be null";
        }
        if ($this->container['racial_and_ethnic_origin_data'] === null) {
            $invalidProperties[] = "'racial_and_ethnic_origin_data' can't be null";
        }
        if ($this->container['religious_and_philosophical_beliefs_data'] === null) {
            $invalidProperties[] = "'religious_and_philosophical_beliefs_data' can't be null";
        }
        if ($this->container['labor_organization_membership_data'] === null) {
            $invalidProperties[] = "'labor_organization_membership_data' can't be null";
        }
        if ($this->container['sexual_life_data'] === null) {
            $invalidProperties[] = "'sexual_life_data' can't be null";
        }
        if ($this->container['personality_data'] === null) {
            $invalidProperties[] = "'personality_data' can't be null";
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
     * Gets biometric_data
     *
     * @return bool
     */
    public function getBiometricData()
    {
        return $this->container['biometric_data'];
    }

    /**
     * Sets biometric_data
     *
     * @param bool $biometric_data Biometric Data
     *
     * @return self
     */
    public function setBiometricData($biometric_data)
    {

        if (is_null($biometric_data)) {
            throw new \InvalidArgumentException('non-nullable biometric_data cannot be null');
        }

        $this->container['biometric_data'] = $biometric_data;

        return $this;
    }

    /**
     * Gets genetic_data
     *
     * @return bool
     */
    public function getGeneticData()
    {
        return $this->container['genetic_data'];
    }

    /**
     * Sets genetic_data
     *
     * @param bool $genetic_data Genetic Data
     *
     * @return self
     */
    public function setGeneticData($genetic_data)
    {

        if (is_null($genetic_data)) {
            throw new \InvalidArgumentException('non-nullable genetic_data cannot be null');
        }

        $this->container['genetic_data'] = $genetic_data;

        return $this;
    }

    /**
     * Gets health_data
     *
     * @return bool
     */
    public function getHealthData()
    {
        return $this->container['health_data'];
    }

    /**
     * Sets health_data
     *
     * @param bool $health_data Health Data
     *
     * @return self
     */
    public function setHealthData($health_data)
    {

        if (is_null($health_data)) {
            throw new \InvalidArgumentException('non-nullable health_data cannot be null');
        }

        $this->container['health_data'] = $health_data;

        return $this;
    }

    /**
     * Gets political_opinion_data
     *
     * @return bool
     */
    public function getPoliticalOpinionData()
    {
        return $this->container['political_opinion_data'];
    }

    /**
     * Sets political_opinion_data
     *
     * @param bool $political_opinion_data Political Opinion Data
     *
     * @return self
     */
    public function setPoliticalOpinionData($political_opinion_data)
    {

        if (is_null($political_opinion_data)) {
            throw new \InvalidArgumentException('non-nullable political_opinion_data cannot be null');
        }

        $this->container['political_opinion_data'] = $political_opinion_data;

        return $this;
    }

    /**
     * Gets racial_and_ethnic_origin_data
     *
     * @return bool
     */
    public function getRacialAndEthnicOriginData()
    {
        return $this->container['racial_and_ethnic_origin_data'];
    }

    /**
     * Sets racial_and_ethnic_origin_data
     *
     * @param bool $racial_and_ethnic_origin_data Racial and Ethnic Origin Data
     *
     * @return self
     */
    public function setRacialAndEthnicOriginData($racial_and_ethnic_origin_data)
    {

        if (is_null($racial_and_ethnic_origin_data)) {
            throw new \InvalidArgumentException('non-nullable racial_and_ethnic_origin_data cannot be null');
        }

        $this->container['racial_and_ethnic_origin_data'] = $racial_and_ethnic_origin_data;

        return $this;
    }

    /**
     * Gets religious_and_philosophical_beliefs_data
     *
     * @return bool
     */
    public function getReligiousAndPhilosophicalBeliefsData()
    {
        return $this->container['religious_and_philosophical_beliefs_data'];
    }

    /**
     * Sets religious_and_philosophical_beliefs_data
     *
     * @param bool $religious_and_philosophical_beliefs_data Data on Religious and Philosophical Beliefs
     *
     * @return self
     */
    public function setReligiousAndPhilosophicalBeliefsData($religious_and_philosophical_beliefs_data)
    {

        if (is_null($religious_and_philosophical_beliefs_data)) {
            throw new \InvalidArgumentException('non-nullable religious_and_philosophical_beliefs_data cannot be null');
        }

        $this->container['religious_and_philosophical_beliefs_data'] = $religious_and_philosophical_beliefs_data;

        return $this;
    }

    /**
     * Gets labor_organization_membership_data
     *
     * @return bool
     */
    public function getLaborOrganizationMembershipData()
    {
        return $this->container['labor_organization_membership_data'];
    }

    /**
     * Sets labor_organization_membership_data
     *
     * @param bool $labor_organization_membership_data Data on Labor Organization Memberships
     *
     * @return self
     */
    public function setLaborOrganizationMembershipData($labor_organization_membership_data)
    {

        if (is_null($labor_organization_membership_data)) {
            throw new \InvalidArgumentException('non-nullable labor_organization_membership_data cannot be null');
        }

        $this->container['labor_organization_membership_data'] = $labor_organization_membership_data;

        return $this;
    }

    /**
     * Gets sexual_life_data
     *
     * @return bool
     */
    public function getSexualLifeData()
    {
        return $this->container['sexual_life_data'];
    }

    /**
     * Sets sexual_life_data
     *
     * @param bool $sexual_life_data Data on Sexual Life or Sexual Orientation
     *
     * @return self
     */
    public function setSexualLifeData($sexual_life_data)
    {

        if (is_null($sexual_life_data)) {
            throw new \InvalidArgumentException('non-nullable sexual_life_data cannot be null');
        }

        $this->container['sexual_life_data'] = $sexual_life_data;

        return $this;
    }

    /**
     * Gets personality_data
     *
     * @return bool
     */
    public function getPersonalityData()
    {
        return $this->container['personality_data'];
    }

    /**
     * Sets personality_data
     *
     * @param bool $personality_data Data on the Assessment of Personality, Abilities, Performance and Behavior
     *
     * @return self
     */
    public function setPersonalityData($personality_data)
    {

        if (is_null($personality_data)) {
            throw new \InvalidArgumentException('non-nullable personality_data cannot be null');
        }

        $this->container['personality_data'] = $personality_data;

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


