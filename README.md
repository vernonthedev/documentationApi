<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

API Documentation V1 [Version One]
====================

This document outlines the functionalities and usage of the Laravel API for managing customers and invoices. Secure access is ensured through Laravel Sanctum token authentication.

### Technologies Used

- [Laravel Framework](https://laravel.com/docs/11.x/installation).
- [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum).


## Authentication
The API utilizes Laravel Sanctum for token-based authentication. To access protected endpoints, users need to generate a token using their login credentials.

1. **Generating a Token:**
- Send a GEt request to ```/setup``` and it will generate thsi default user that will be used to generate the tokens that will be used to access the tokens:

```json
{
  "email": "admin@admin.com",
  "password": "password"
}
```

- A successful response will include a token field containing the 3 access tokens.
- [ ] Basic token
- [x] Admin token
- [x] Update token

2. **Including the Token in Requests:**
- Include the access token in the authorization header of all subsequent requests. Here's an example using curl:
```bash
curl -X GET https://your-api-domain/api/v1/customers \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```
__Important Note__: 
>Store the access token securely and avoid exposing it in client-side code.

### API Endpoints
The API is organized with a base URI of ```/api/v1```. Here's a breakdown of the available endpoints:

**Customers:**

- ```GET /customers```: Retrieve a list of all customers.
- ```GET /customers/{id}```: Get details of a specific customer by their ID.
- ```POST /customers```: Create a new customer.
- ```PUT /customers/{id}```: Update an existing customer[all fields].
- ```PATCH /customers/{id}```: Update a single existing customer field.
- ```DELETE /customers/{id}```: Delete a customer.

**Invoices:**

- ```GET /invoices```: Retrieve a list of all invoices.
- ```GET /invoices/{id}```: Get details of a specific invoice by their ID.
- ```POST /invoices```: Create a new invoice.
- ```PUT /invoices/{id}```: Update an existing invoice[all fields].
- ```PATCH /invoices/{id}```: Update a single existing invoice field.
- ```DELETE /invoices/{id}```: Delete a invoice.

![Screenshot from 2024-05-27 13-47-55](https://github.com/vernonthedev/documentationApi/assets/108737724/5665d609-404b-4420-8257-733ea902f9c9)


**Additional Features**
- Bulk Invoice Insertion
- Customer and Invoice Filtering using operator custom patterns..
> [For more info, please refer to the more detailed api documentation.](https://vernonthedev.github.io/api/docs)

![Screenshot from 2024-05-27 13-48-26](https://github.com/vernonthedev/documentationApi/assets/108737724/93bfc2b8-28af-47da-9e23-eb114cd972aa)
- Documentation Home page



**Additional Notes:**
![Screenshot from 2024-05-27 13-48-26](https://github.com/vernonthedev/documentationApi/assets/108737724/a5e87556-3237-44ab-a60b-7254417e7bbd)


Specific details about request parameters and response structures can be found in the controller code within your project.
Error responses will be formatted as JSON objects with an error message and relevant details (e.g., validation errors).

***Example Usage:***
- Generate a token using the ```/login``` endpoint.
- Use the retrieved token in subsequent requests with the Authorization header.
- Refer to the specific endpoint documentation for details on request parameters and expected responses.

This is a basic documentation structure. You can expand on it by including:

- Specific request parameters for each endpoint (e.g., required fields, data types).
- Expected response structure (including data fields and their meanings).
- Authentication error codes and their descriptions.
- Example code snippets for making API calls in different languages.
- Remember to update this documentation as your API evolves and add new functionalities.

> Thanks for checking out my repo 

**vernonthedev**
