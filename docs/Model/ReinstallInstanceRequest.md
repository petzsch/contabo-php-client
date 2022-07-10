# # ReinstallInstanceRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**image_id** | **string** | ImageId to be used to setup the compute instance. |
**ssh_keys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. | [optional]
**root_password** | **int** | &#x60;secretId&#x60; of the password for the &#x60;defaultUser&#x60; with administrator/root privileges. For Linux/BSD please use SSH, for Windows RDP. Please refer to Secrets Management API. | [optional]
**user_data** | **string** | [Cloud-Init](https://cloud-init.io/) Config in order to customize during start of compute instance. | [optional]
**default_user** | **string** | Default user name created for login during (re-)installation with administrative privileges. Allowed values for Linux/BSD are &#x60;admin&#x60; (use sudo to apply administrative privileges like root) or &#x60;root&#x60;. Allowed values for Windows are &#x60;admin&#x60; (has administrative privileges like administrator) or &#x60;administrator&#x60;. | [optional] [default to 'admin']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
