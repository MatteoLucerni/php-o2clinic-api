# API for O2Clinic site

Made using PHP

## Endpoint: Send Message

**URL:** `/api/messages/handle_message.php`

**Method:** `POST`

### Description

This endpoint allows users to send a message that will be stored in the database. It is ideal for contact forms or customer support systems.

### Required Headers

- `Content-Type: application/json`
- `Access-Control-Allow-Origin: *`
- `Access-Control-Allow-Methods: POST`
- `Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With`

### Request Body Parameters

The request body must be in JSON format and include the following fields:

| Field     | Type   | Description                | Required |
| --------- | ------ | -------------------------- | -------- |
| `name`    | string | Sender's name              | Yes      |
| `email`   | string | Sender's email address     | Yes      |
| `phone`   | string | Sender's phone number      | Yes      |
| `message` | string | Message content (optional) | No       |

**Example Request Body:**

```json
{
  "name": "Mario Rossi",
  "email": "mario.rossi@example.com",
  "phone": "1234567890",
  "message": "Hello, I would like more information about your services."
}
```
