# # CreateSecretRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of the secret that will keep the password |
**value** | **string** | The secret value that needs to be saved. In case of a password it must match a pattern with at least one upper and lower case character and either one number with two special characters &#x60;!@#$^&amp;*?_~&#x60; or at least three numbers with one special character &#x60;!@#$^&amp;*?_~&#x60;. This is expressed in the following regular expression: &#x60;^((?&#x3D;.*?[A-Z]{1,})(?&#x3D;.*?[a-z]{1,}))(((?&#x3D;(?:[^d]*d){1})(?&#x3D;([^^&amp;*?_~]*[!@#$^&amp;*?_~]){2,}))|((?&#x3D;(?:[^d]*d){3})(?&#x3D;.*?[!@#$^&amp;*?_~]+))).{8,}$&#x60; |
**type** | **string** | The type of the secret. Can be &#x60;password&#x60; or &#x60;ssh&#x60; |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
