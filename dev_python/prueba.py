import requests

url = "https://beta.impuls.com.mx/rest/model/atg/commerce/order/purchase/CartModifierActor/getInventoryByStore?productId=100038"

payload = {}

response = requests.request("GET", url, data = payload)

print(response.text.encode('utf8'))
