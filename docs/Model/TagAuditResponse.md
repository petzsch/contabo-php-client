# # TagAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**id** | **float** | The identifier of the audit entry. |
**tag_id** | **float** | The identifier of the audit entry. |
**action** | **string** | Type of the action. |
**timestamp** | **\DateTime** | When the change took place. |
**changed_by** | **string** | User ID |
**username** | **string** | Name of the user which led to the change. |
**request_id** | **string** | The requestId of the API call which led to the change. |
**trace_id** | **string** | The traceId of the API call which led to the change. |
**changes** | **object** | List of actual changes. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
