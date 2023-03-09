# # CreateObjectStorageRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**region** | **string** | Region where the object storage should be located. Default is EU. Available regions: EU, US-central, SIN | [default to 'EU']
**auto_scaling** | [**\OpenAPI\Client\Model\CreateObjectStorageRequestAutoScaling**](CreateObjectStorageRequestAutoScaling.md) |  | [optional]
**total_purchased_space_tb** | **float** | Amount of purchased / requested object storage in TB. |
**display_name** | **string** | Display name helps to differentiate between object storages, especially if they are in the same region. If display name is not provided, it will be generated. Display name can be changed any time. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
