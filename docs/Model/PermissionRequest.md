# # PermissionRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**api_name** | **string** | The name of the role. There is a limit of 255 characters per role. |
**actions** | **string[]** | Action allowed for the API endpoint. Basically &#x60;CREATE&#x60; corresponds to POST endpoints, &#x60;READ&#x60; to GET endpoints, &#x60;UPDATE&#x60; to PATCH / PUT endpoints and &#x60;DELETE&#x60; to DELETE endpoints. |
**resources** | **int[]** | The IDs of tags. Only if those tags are assgined to a resource the user with that role will be able to access the resource. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
