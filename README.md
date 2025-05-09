<h1 align="center">ToDo App<h1>



## Overview

This application is a Task Manager built with Laravel12 and VueJS, designed to help users create, update and delete task with ease.  With pagination, error handling, and Design pattern awareness, this tool ensures a smooth experience for navigating large task results, while also gracefully handling common issues like network interruptions. Showing toast message after adding , deleting or updating a task. Also user can mark Done.



## Prerequisites
- PHP Version >= 8.3


## Installation
 1. Clone the repository from: ``` git clone https://github.com/Mohibul-Hasan-Rana/todo-list-with-laravel-12-and-vuejs.git```

 2. Navigate to the project directory: ```cd todo-list-with-laravel-12-and-vuejs```

 3. Install dependencies: ```composer update```

 4. Set up environment variables: ```cp .env.example .env```

 5. Generate an application key: ```php artisan key:generate```

 6. Update database information in env file. 

 7. Run migration file: ```php artisan migrate```

 8. Run those command ```composer dumpautoload``` and ```php artisan config:cache```

 ## Usage 

 1. Run this command: ```php artisan serve``` , ```npm install``` and ```npm run dev```

 2. Paste this URL in browser: http://127.0.0.1:8000/ 

 Or

 3. If php artisan serve not working then run this command ```php -S localhost:9000 -t public```

 4. Paste this URL in browser: http://localhost:9000