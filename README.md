Installation guide
======================

* Install libraries:
  ```
  composer install
  ```
* Create **.env** file from **.env.example**
* Set database connection settings in **.env** file
* Invoke migrations
  ```
  php artisan migrate
  ```
* Run server
  ```
  php artisan serve
  ```
* Register user and admin accounts
* Use console commands to manage admin privileges:

  To grant admin rights use command:
  ```
  php artisan setadmin {userid}
  ```
  To revoke admin rights use command:
  ```
  php artisan unsetadmin {userid}
  ```
