## Installation

```
compose install
cp .env.example .env
php artisan migrate
```


DB Email/Password
```
email: asargodha@gmail.com
password: password123
Authorization: Bearer 1|miJUrc7WRRgDiE4o4v0rEbEOtcChvxNBTf3xkxJu52f750aa
```


For /projects and /timesheets routes need to pass the Authorization header.
We can get the Authorization Bearer token from login of the user from `POST /api/login`


## Routes
| method    | uri                                    | action                                                    |
|-----------|----------------------------------------|-----------------------------------------------------------|
| GET|HEAD  | api/attribute-values                   | App\Http\Controllers\Api\AttributeValueController@index   |
| POST      | api/attribute-values                   | App\Http\Controllers\Api\AttributeValueController@store   |
| GET|HEAD  | api/attribute-values/{attribute_value} | App\Http\Controllers\Api\AttributeValueController@show    |
| PUT|PATCH | api/attribute-values/{attribute_value} | App\Http\Controllers\Api\AttributeValueController@update  |
| DELETE    | api/attribute-values/{attribute_value} | App\Http\Controllers\Api\AttributeValueController@destroy |
| GET|HEAD  | api/attributes                         | App\Http\Controllers\Api\AttributeController@index        |
| POST      | api/attributes                         | App\Http\Controllers\Api\AttributeController@store        |
| GET|HEAD  | api/attributes/{attribute}             | App\Http\Controllers\Api\AttributeController@show         |
| PUT|PATCH | api/attributes/{attribute}             | App\Http\Controllers\Api\AttributeController@update       |
| DELETE    | api/attributes/{attribute}             | App\Http\Controllers\Api\AttributeController@destroy      |
| POST      | api/login                              | App\Http\Controllers\Api\AuthController@login             |
| POST      | api/logout                             | App\Http\Controllers\Api\AuthController@logout            |
| GET|HEAD  | api/projects                           | App\Http\Controllers\Api\ProjectController@index          |
| POST      | api/projects                           | App\Http\Controllers\Api\ProjectController@store          |
| GET|HEAD  | api/projects/{project}                 | App\Http\Controllers\Api\ProjectController@show           |
| PUT|PATCH | api/projects/{project}                 | App\Http\Controllers\Api\ProjectController@update         |
| DELETE    | api/projects/{project}                 | App\Http\Controllers\Api\ProjectController@destroy        |
| POST      | api/register                           | App\Http\Controllers\Api\AuthController@register          |
| GET|HEAD  | api/timesheets                         | App\Http\Controllers\Api\TimesheetController@index        |
| POST      | api/timesheets                         | App\Http\Controllers\Api\TimesheetController@store        |
| GET|HEAD  | api/timesheets/{timesheet}             | App\Http\Controllers\Api\TimesheetController@show         |
| PUT|PATCH | api/timesheets/{timesheet}             | App\Http\Controllers\Api\TimesheetController@update       |
| DELETE    | api/timesheets/{timesheet}             | App\Http\Controllers\Api\TimesheetController@destroy      |


## SQL

SQL dump file path
```
database/db.sql
```
