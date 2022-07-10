# # CreateUserRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**first_name** | **string** | The name of the user. Names may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. | [optional]
**last_name** | **string** | The last name of the user. Users may contain letters, numbers, colons, dashes, and underscores. There is a limit of 255 characters per user. | [optional]
**email** | **string** | The email of the user to which activation and forgot password links are being sent to. There is a limit of 255 characters per email. |
**enabled** | **bool** | If user is not enabled, he can&#39;t login and thus use services any longer. |
**totp** | **bool** | Enable or disable two-factor authentication (2FA) via time based OTP. |
**locale** | **string** | The locale of the user. This can be &#x60;de-DE&#x60;, &#x60;de&#x60;, &#x60;en-US&#x60;, &#x60;en&#x60; |
**roles** | **int[]** | The roles as list of &#x60;roleId&#x60;s of the user. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
