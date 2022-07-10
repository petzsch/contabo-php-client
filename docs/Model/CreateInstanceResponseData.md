# # CreateInstanceResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**instance_id** | **int** | Instance&#39;s id |
**created_date** | **\DateTime** | Creation date for instance |
**image_id** | **string** | Image&#39;s id |
**product_id** | **string** | Product ID |
**region** | **string** | Instance Region where the compute instance should be located. |
**add_ons** | [**\OpenAPI\Client\Model\AddOnResponse[]**](AddOnResponse.md) |  |
**os_type** | **string** | Type of operating system (OS) |
**status** | [**\OpenAPI\Client\Model\InstanceStatus**](InstanceStatus.md) |  |
**ssh_keys** | **int[]** | Array of &#x60;secretId&#x60;s of public SSH keys for logging into as &#x60;defaultUser&#x60; with administrator/root privileges. Applies to Linux/BSD systems. Please refer to Secrets Management API. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
