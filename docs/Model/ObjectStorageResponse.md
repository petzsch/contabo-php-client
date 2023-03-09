# # ObjectStorageResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**object_storage_id** | **string** | Your object storage id |
**created_date** | **\DateTime** | Creation date for object storage. |
**cancel_date** | **\DateTime** | Cancellation date for object storage. |
**auto_scaling** | [**\OpenAPI\Client\Model\ObjectStorageResponseAutoScaling**](ObjectStorageResponseAutoScaling.md) |  |
**data_center** | **string** | Data center your object storage is located |
**total_purchased_space_tb** | **float** | Amount of purchased / requested object storage in TB. |
**s3_url** | **string** | S3 URL to connect to your S3 compatible object storage |
**s3_tenant_id** | **string** | Your S3 tenantId. Only required for public sharing. |
**status** | **string** | The object storage status |
**region** | **string** | The region where your object storage is located |
**display_name** | **string** | Display name for object storage. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
