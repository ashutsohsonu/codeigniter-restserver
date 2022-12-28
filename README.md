We need to follow few steps to setup the project in local.

Steps :
1. git clone the repo
2. composer install ( to fullfill the dependencies of project)
3. Set db user and password in database.php file for local connectivity
4. Import sql file(test.sql)
5. then open postman for test api
 url : localhost/codeigniter-restserver/index.php/order/create
params are required to provide :

user_id : 1
amt: 78
item_name: test
secheduled_pickup : 2023-02-03

I will share api details in api file(php-test.postman_collection.json)


