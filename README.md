API Endpoints

1. Get All Websites

Request:
curl -X GET /api/websites

Response:
- 200 OK: Returns a list of all websites.

---

2. Create a New Post for a Website

Request:
curl -X POST /api/websites/{website}/posts/create \
-H "Content-Type: application/json" \
-d '{"title":"New Post","description":"This is the description of the new post."}'

Parameters:
- website: website id.

Response:
- 201 Created: Returns the created post.

---

3. Subscribe to a Website

Request:
curl -X POST /api/websites/{website}/subscribe \
-H "Content-Type: application/json" \
-d '{"email":"user@gmail.com"}'

Parameters:
- website: website id.

Response:
- 201 Created: Returns the subscription details.
- 404 Not Found: If the user email does not exist.
- 200 OK: If the user is already subscribed.

---

4. Create a New User

Request:
curl -X POST /api/users/create \
-H "Content-Type: application/json" \
-d '{"email": "user@inisev.com"}'

Response:
- 201 Created: Returns the created user.

---

5. Get All Users

Request:
curl -X GET /api/users/get

Response:
- 200 OK: Returns a list of all users.
