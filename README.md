# LBX Test

# Environment
- php version8.1
- Xampp version 8.1.17
- Laravel 10.0
- Composer 2.5.8

# How to run the project?

- Did you install the composer?
- Did you config your .env file and your DB?
- If so, Ok. Then just you can run the project by folling steps
 1. run *CONFIG APP.bat*
 2. run *MIGRATE DB.bat*
 3. run *RUN SERVER.bat*
- But notice that you have to ensure the env file whether you configured your environment properly(DB config, App config etc);
- That's it. Then you can test the result with APIs.

# What's special in my project?

This project handles a large amount of data. So it is very crucial to optimize the handling of db and other datas.
For this, I have used some techniques such as parallel processing, queuing, bulk insertion. (by doing so, I have decreased the time of loading db by *over 90%*. Originally it takes 10 min. but after using several technologies, it only takes *13s*!!!)
- I have used **Job** worker to implement parallel processing.
- Also used bulk insertion, to accelorate the loading data to db.
- And used helper functions to format the record from csv file for loading db.
- Used validation to validate data(for some, used **reg expression**).

# Test cases: you can test all the cases by using postman. :) :) :)

    1. import csv file and load db.
    api: http://127.0.0.1:8000/api/employee
    method: post
    payload: the url of csv file.

    ex: **curl -X POST -H 'Content-Type: text/csv' -d http://127.0.0.1/import.csv http://127.0.0.1:8000/api/employee**

    *** in my project, when loading db, even though you encounter the errors, it will igonre the error record and continue to load. I mean, it will load only valid data.

    2. Get all employees from db
    api: http://127.0.0.1:8000/api/employee
    method: get

    ex: **http://127.0.0.1:8000/api/employee**

    3. Get a employee with certain id
    api: http://127.0.0.1:8000/api/employee/{id}
    method: get

    ex: **http://127.0.0.1:8000/api/employee/13423**

    4. Remove a employee with certain id
    api: http://127.0.0.1:8000/api/employee/{id}
    method: delete

    ex **http://127.0.0.1:8000/api/employee/13423**

# Thank you for your attention.

