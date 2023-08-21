# # InstancesActionsRescueRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**root_password** | **int** | &#x60;secretId&#x60; of the password to login into rescue system for the &#x60;root&#x60; user. | [optional]
**ssh_keys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into rescue system as &#x60;root&#x60; user. | [optional]
**user_data** | **string** | [Cloud-Init](https://cloud-init.io/) Config in order to customize during start of compute instance. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
