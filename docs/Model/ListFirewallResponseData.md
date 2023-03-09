# # ListFirewallResponseData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**firewall_id** | **string** | Your firewall id. |
**name** | **string** | The name of the firewall. |
**description** | **string** | The description of the firewall. |
**status** | **string** | Inactive status means no rules of this firewall are set for all assigned instances. |
**instance_status** | [**\OpenAPI\Client\Model\InstanceStatusRepresentation[]**](InstanceStatusRepresentation.md) |  |
**instances** | [**\OpenAPI\Client\Model\InstanceDetails[]**](InstanceDetails.md) |  |
**rules** | [**\OpenAPI\Client\Model\Rules**](Rules.md) |  |
**is_default** | **bool** | The default firewall rules are assigned by default to newly created instances with Firewall Add-On if not specified otherwise. Exactly one firewall can be set as default. |
**created_date** | **\DateTime** | The creation date time for the firewall |
**updated_date** | **\DateTime** | The update date time for the firewall |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
