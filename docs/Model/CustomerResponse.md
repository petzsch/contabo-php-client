# # CustomerResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tenant_id** | **string** | Your customer tenant id |
**customer_id** | **string** | Your customer number |
**salutation** | **string** | Customer salutation |
**type** | **string** | Customer type |
**private** | [**\OpenAPI\Client\Model\CustomerTypePrivate**](CustomerTypePrivate.md) |  |
**business** | [**\OpenAPI\Client\Model\CustomerTypeBusiness**](CustomerTypeBusiness.md) |  |
**tax_percentage** | **float** | Customer tax percentage |
**currency** | **string** | Customer currency |
**balance** | **float** | Customer balance |
**locale** | **string** | Customer locale |
**addresses** | [**\OpenAPI\Client\Model\CustomerAddress[]**](CustomerAddress.md) |  |
**emails** | [**\OpenAPI\Client\Model\CustomerEmail[]**](CustomerEmail.md) |  |
**phones** | [**\OpenAPI\Client\Model\CustomerPhone[]**](CustomerPhone.md) |  |
**status** | **string** | Customer status |
**created_date** | **\DateTime** | The creation date of the customer |
**monthly_recurring_revenue** | **float** | The monthly revenue of the customer (How much the customer has to pay recurring each month) |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
