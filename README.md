# Laravel Student & Subject API

-   Create student with image or image path
-   Create student Subject
-   Fetch all students data with subjects
-   Edit student
-   Edit subjects
-   Delete student
-   Delete subject

------------------------------------------------------------------------

# Installation

## Clone project

git clone https://github.com/your-username/your-repo-name.git\  
cd your-repo-name

## Install dependencies

composer install

## Create environment file

cp .env.example .env

## Configure database in `.env`

DB_DATABASE=school\
DB_USERNAME=root\
DB_PASSWORD=

## Generate app key

php artisan key:generate

## Run migrations

php artisan migrate

## Storage link (for images)

php artisan storage:link

## Run server

php artisan serve

API base URL:

http://127.0.0.1:8000/api

------------------------------------------------------------------------

# API

# Student API

## Create Student

POST /students

name: Jayesh\
email: jayesh@test.com\
image: (file or path)

------------------------------------------------------------------------

## Get All Students with Subjects

GET /students

Response:

{ "status": true, "data": \[ { "name": "jayesh", "email":
"jayesh@test.com", "image": "students/file.jpg", "subject": \["Maths"\]
} \] }

------------------------------------------------------------------------

## Update Student

POST /students/{id}

------------------------------------------------------------------------

## Delete Student

DELETE /students/{id}

------------------------------------------------------------------------

# Subject APIs

## Create Subject

POST /student-subjects

{ "student_id": 1, "subject_name": "Maths" }

------------------------------------------------------------------------

## Update Subject

POST /student-subjects/{id}

------------------------------------------------------------------------

## Delete Subject

DELETE /student-subjects/{id}

------------------------------------------------------------------------
