<p align="center"><img src="https://raw.githubusercontent.com/infinitypaul/football/master/public/football.png" /></p>
<p align="center">FootBall League.</p>
<p align="center"><a href="https://instagram.com/infinitypaul">Creator</a> | <a href="">Getting Started</a></p>

<p>&nbsp;</p>

## Download Instruction

1. Clone the project.

```
git clone https://github.com/infinitypaul/football.git projectname
```

2. Install dependencies via composer.

```
composer install 
```

3. Migrate and seed the Database.

```
php artisan migrate --seed
```

4. Run php server.

```
php artisan serve
```



> You can also install the Application via Docker:

## Pre-requisites

- Docker running on the host machine.
- Docker compose running on the host machine.

1. Clone the project.

```
git clone https://github.com/infinitypaul/football.git projectname
```

2. Run the testrig.sh file on the Project Root Folder on your terminal/Command Prompt, This script does everything you need to run your this project. It starts up the servers, ensures the database is booted, installs dependencies, runs database migrations, and runs database seeds. These services are exposed to your computer on the standard ports, then you can access your website on http:localhost


## Troubleshooting

- Port number might be already in use, change from `80` to another number in your `docker-compose.yml` file.
- If you have any other issues, [report them](https://github.com/infinitypaul/football/issues).

Enjoy!

### License

The  Find Your Service App is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
