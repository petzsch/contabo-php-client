# # InstanceStatusRepresentation

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**instance_id** | **int** | Instance id which is assigned to the firewall. |
**status** | **string** | Instance status in firewall can be:&lt;br/&gt; &#x60;ok&#x60; - instance was successfully assigned &lt;br/&gt; &#x60;processing&#x60; -  creating firewall rules &lt;br/&gt; &#x60;deleting&#x60; - deleting firewall rules &lt;br/&gt; &#x60;error_processing&#x60; - error occurred while creating firewall rules &lt;br/&gt;  &#x60;error_deleting&#x60; - error occurred while deleting firewall rules |
**error_message** | **string** | More detailed error message in case of error status. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
