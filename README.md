
# GYM Management System

Full-Stack project to manage gyms,track members' attendances and subscriptions.

## Installation

1. Clone the repository

```bash
  # using SSH
  git clone git@github.com:ojpro/gym-track.git

  # using HTTPS
  git clone https://github.com/ojpro/gym-track.git

```

2. Setup Backend

```bash
  # go to server folder
  cd gym-track/server

  # install composer packages
  composer Install

  # create an .env file
  cp .env.example .env

  # generate app key
  php artisan key:generate

  # start the server
  php artisan serve
```

3. set up the frontend (coming soon)

🚀 Now backend side is set up!.

## Running Tests

To run tests, run the following commands

```bash
  # navigate to the server directory
  cd server
  # start testing scripts
  php artisan test
```


## Authors

- [@ojpro](https://github.com/ojpro)


## License

[MIT](https://choosealicense.com/licenses/mit/)
