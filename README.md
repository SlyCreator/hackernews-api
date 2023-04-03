## Spooling Hackernews
The objective of this project is to extract data from the Hackernews API (https://github.com/HackerNews/API) and store it in a Laravel database. The entities (stories, comments, authors, etc.) will each have their own table, following the structure provided on the Hackernews Github link. To handle data processing efficiently, the concepts of jobs, queues, services, and containers will be utilized. To prevent the storage of duplicate entities, the system will check for duplicates. The system will spool data every 12 hours and will extract up to 100 stories, along with all related items (e.g., authors, comments, and comment-authors), without any limit.
### Prerequisites

Before setting up the project, make sure to install  the following requirements :
- PHP 7.3 or later
- Composer
- MySQL

### Getting Started

To set up and run the project, follow the steps below:
1. Clone the repository using the command:

```git clone https://github.com/<username>/<project>.git```

2. Navigate to the project directory using the command:

``` cd hacker-news```

3. Install the dependencies using the command:

```composer install```

4. Create a .env file and configure your database connection. You can copy the .env.example file and update it with your database credentials:

```cp .env.example .env```

5. Run the database migration using the command:

``` php artisan migrate```

6. Start the queue worker using the command:

``` php artisan queue:work --tries=3```
7. Start the data spooling by running the following command:

``` php artisan schedule:run >> /dev/null 2>&1```

API Endpoints

The following API endpoints are available:

    /api/stories - GET request to retrieve all the stories.
    /api/stories/{id} - GET request to retrieve a specific story by ID.
Postman Collection

A Postman collection has been provided [here](https://documenter.getpostman.com/view/4612556/2s93RWNW3L) to demonstrate the functionality of the API endpoints.
