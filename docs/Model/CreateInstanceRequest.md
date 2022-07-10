# # CreateInstanceRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**image_id** | **string** | ImageId to be used to setup the compute instance. Default is Ubuntu 20.04 | [default to 'db1409d2-ed92-4f2f-978e-7b2fa4a1ec90']
**product_id** | **string** | Default is V1 | [default to 'V1']
**region** | **string** | Instance Region where the compute instance should be located. Default is EU | [default to 'EU']
**ssh_keys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. | [optional]
**root_password** | **int** | &#x60;secretId&#x60; of the password for the &#x60;defaultUser&#x60; with administrator/root privileges. For Linux/BSD please use SSH, for Windows RDP. Please refer to Secrets Management API. | [optional]
**user_data** | **string** | [Cloud-Init](https://cloud-init.io/) Config in order to customize during start of compute instance. | [optional]
**license** | **string** | Additional licence in order to enhance your chosen product, mainly needed for software licenses on your product (not needed for windows). | [optional]
**period** | **int** | Initial contract period in months. Available periods are: 1, 3, 6 and 12 months. Default to 1 month | [default to 1]
**display_name** | **string** | The display name of the instance | [optional]
**default_user** | **string** | Default user name created for login during (re-)installation with administrative privileges. Allowed values for Linux/BSD are &#x60;admin&#x60; (use sudo to apply administrative privileges like root) or &#x60;root&#x60;. Allowed values for Windows are &#x60;admin&#x60; (has administrative privileges like administrator) or &#x60;administrator&#x60;. | [optional] [default to 'admin']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
