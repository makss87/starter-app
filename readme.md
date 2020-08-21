### Config
All config is stored in **config/app.php**.

### Sub folder mode
1. Make sure you've moved all contents of public dir into project root before.
2. Amend **website_root** var in config/app.php

### Database
Run {app}/migrate to create necessary tables

### Routing
All app routes are stored in **app/Http/routes.php**.

Example
```
$router->get('', 'HomePageController@index');
```
The code above binds index uri with the controller class located in **app/controllers/HomePageController.php** and it's method **index**.


### Views(templates)
All views must be placed in **resources/views** folder or it's subfolders.

Views can be refernced in controllers by using the **view** helper.
```php
return view('pages.default', ['page'=>$whatever_is_stored_as_page_value]]);
```
First param is path(dot notation) to the view relative to **resources/views** folder
Second param is data(array $variable=>value) passed into that view. 
In example above view will be able to use `page` variable having value of `$page` controller variable.









