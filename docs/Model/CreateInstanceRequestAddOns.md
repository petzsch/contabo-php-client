# # CreateInstanceRequestAddOns

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**private_networking** | **object** | Set this attribute if you want to upgrade your instance with the Private Networking addon.   Please provide an empty object for the time being as value. There will be more configuration possible   in the future. | [optional]
**additional_ips** | **object** | Set this attribute if you want to upgrade your instance with the Additional IPs addon. Please provide an empty object for the time being as value. There will be more configuration possible in the future. | [optional]
**extra_storage** | [**\OpenAPI\Client\Model\CreateInstanceAddonsExtraStorage**](CreateInstanceAddonsExtraStorage.md) |  | [optional]
**custom_image** | **object** | Set this attribute if you want to upgrade your instance with the Custom Images addon.   Please provide an empty object for the time being as value. There will be more configuration possible   in the future. | [optional]
**addons_ids** | [**\OpenAPI\Client\Model\AddOnRequest[]**](AddOnRequest.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
