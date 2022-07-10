# # AssignmentAuditResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**id** | **float** | The identifier of the audit entry. |
**resource_id** | **string** | Resource&#39;s id |
**resource_type** | **string** | Resource type. Resource type is one of &#x60;instance|image|object-storage&#x60;. |
**tag_id** | **float** | Tag&#39;s id |
**action** | **string** | Audit Action |
**timestamp** | **\DateTime** | Audit creation date |
**changed_by** | **string** | User ID |
**username** | **string** | User Full Name |
**request_id** | **string** | Request ID |
**trace_id** | **string** | Trace ID |
**changes** | **object** | Changes made for a specific Tag | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
