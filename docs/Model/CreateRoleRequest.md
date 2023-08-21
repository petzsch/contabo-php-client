# # CreateRoleRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of the role. There is a limit of 255 characters per role. |
**admin** | **bool** | If user is admin he will have permissions to all API endpoints and resources. Enabling this will superseed all role definitions and &#x60;accessAllResources&#x60;. |
**access_all_resources** | **bool** | Allow access to all resources. This will superseed all assigned resources in a role. |
**permissions** | [**\OpenAPI\Client\Model\PermissionRequest[]**](PermissionRequest.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
