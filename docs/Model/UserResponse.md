# # UserResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**user_id** | **string** | User&#39;s id |
**first_name** | **string** | The first name of the user. Users may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. |
**last_name** | **string** | The last name of the user. Users may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. |
**email** | **string** | The email of the user to which activation and forgot password links are being sent to. There is a limit of 255 characters per email. |
**email_verified** | **bool** | User email verification status. |
**enabled** | **bool** | If uses is not enabled, he can&#39;t login and thus use services any longer. |
**totp** | **bool** | Enable or disable two-factor authentication (2FA) via time based OTP. |
**locale** | **string** | The locale of the user. This can be &#x60;de-DE&#x60;, &#x60;de&#x60;, &#x60;en-US&#x60;, &#x60;en&#x60; |
**roles** | [**\OpenAPI\Client\Model\RoleResponse[]**](RoleResponse.md) | The roles as list of &#x60;roleId&#x60;s of the user. |
**owner** | **bool** | If user is owner he will have permissions to all API endpoints and resources. Enabling this will superseed all role definitions and &#x60;accessAllResources&#x60;. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
