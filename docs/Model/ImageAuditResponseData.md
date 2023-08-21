# # ImageAuditResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | The ID of the audit entry. |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**tenant_id** | **string** | Customer tenant id |
**customer_id** | **string** | Customer ID |
**changed_by** | **string** | Id of user who performed the change |
**username** | **string** | Name of the user which led to the change. |
**request_id** | **string** | The requestId of the API call which led to the change. |
**trace_id** | **string** | The traceId of the API call which led to the change. |
**image_id** | **string** | The identifier of the image |
**changes** | **object** | List of actual changes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
