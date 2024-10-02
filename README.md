## Task Management System 

## Requirements
- [PHP] ^8.2 - (https://www.php.net/downloads.php) 
- [Node] Js (https://nodejs.org/en/download/package-manager)
- [Composer] (https://getcomposer.org/download/)


## Getting Started
- For minimal setup, I used SQLite instead of MySQL. If you want to install and start the app quickly
- Clone this repository in your local machine (git clone <repository-url>)
- Open your terminal and navigate to your project using (cd <localpath>)
- Create .env file and copy the content of env.example
- Run the following command 
    - composer install
    - composer dump-autoload
    - php artisan migrate 
    - php artisan db:seed --class=CategorySeeder
    - php artisan serve
    - npm install && npm run dev 
- You can now access the app at http://127.0.0.1:8000


## How to Setup API
- Download [Postman](https://www.postman.com/) for API testing.
- Import `Task Management Api.postman_collection.json`, which is located in the root folder of this app.
- After importing, you need to generate an API token by hitting the **/api/register** and **/api/login** endpoints.
- Once you have the token, you can add it to the Headers in Postman as follows:
    - Key: `Authorization`
    - Value: `Bearer <token>` (replace `<token>` with the actual token you received)

### API Endpoints
| Method | Endpoint                          | Description                        |
|--------|-----------------------------------|------------------------------------|
| POST   | `/api/register`                   | Register a new user                |
| POST   | `/api/login`                      | Login with user credentials        |
| GET    | `/api/tasks`                      | Retrieve a list of tasks           |
| POST   | `/api/tasks`                      | Create a new task                  |
| GET    | `/api/tasks/{id}`                 | Retrieve a specific task by ID     |
| PUT    | `/api/tasks/{id}`                 | Update a specific task by ID       |
| DELETE | `/api/tasks/{id}`                 | Delete a specific task by ID       |
| POST   | `/api/tasks/{id}/update-status`   | Update the status of a task        |
| GET    | `/api/tasks-stats`                | Get the list of task statistics    |


## Approach
### Separation of Web and API Functionality
In this task, I followed a clear separation between the web and API functionality to maintain a clean and modular structure:

- **Web Functionality**: All user-facing views and routes are handled by Laravel’s web middleware group, ensuring that traditional web responses (HTML) are processed separately. Web-specific routes are managed under the `routes/web.php` file.
  
- **API Functionality**: API endpoints are defined in the `routes/api.php` file and return JSON responses. I’ve ensured that API routes are stateless and interact with the application through the necessary service layers. This separation allows for more efficient handling of data for web and API clients independently, making the application easier to scale.


## Stretch Goals

### Enhanced Filtering and Pagination
- I have finished adding filtering in both the API and web interfaces.
- Additionally, I created a trait for shared filtering functionality in both API and web.

### Dashboard and Statistics
- I have completed adding statistics to the dashboard.
- I also added a new endpoint: 
  - GET | `/api/tasks-stats` for retrieving task statistics.
- The TaskService is utilized for both web and API to ensure consistency in data handling.

### Additional Testing
- I created a feature test for the task filter function, but this is currently implemented for the API only, as I did not finish the web testing.
