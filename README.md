# Monitor System

### laravel-vue-monitor

<img src="https://laravel.com/img/logomark.min.svg" width="100" height="100"/><img src="https://vuejs.org/images/logo.svg" width="100" height="100"/>

![GitHub repo size](https://img.shields.io/github/repo-size/CaribesTIC/laravel-vue-monitor)
![GitHub contributors](https://img.shields.io/github/contributors/CaribesTIC/laravel-vue-monitor)
![GitHub watchers](https://img.shields.io/github/watchers/CaribesTIC/laravel-vue-monitor?style=social)
![GitHub stars](https://img.shields.io/github/stars/CaribesTIC/laravel-vue-monitor?style=social)
![GitHub forks](https://img.shields.io/github/forks/CaribesTIC/laravel-vue-monitor?style=social)

It is a software development project that monitoring product offer.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- You have a `Linux machine with Docker installed`

## Installing laravel-vue-monitor

To install this project, follow these steps once the project is cloned and inside the main directory :

Linux:

- Create docker-compose's .env file from .env.example `cp .env.example .env`
- Run `docker network create web_monitor`
- Run `docker network create postgresql_monitor`
- Run `docker-compose up -d`
- Change permission to exectute script.sh file `sudo chmod +x script.sh`
- Run `./script.sh`
- Create an alias in the `/etc/hosts` file for the location set in the VIRTUALHOST environment variable of your web server

## Contributing to laravel-vue-monitor

To contribute follow these steps:

1. Fork this repository.
2. Create a branch: `git checkout -b <branch_name>`.
3. Make your changes and commit them: `git commit -m '<commit_message>'`
4. Push to the original branch: `git push origin <project_name>/<location>`
5. Create the pull request.

Alternatively see the GitHub documentation on [creating a pull request](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).

## Contributors

Thanks to the following people who have contributed to this project:

- [@ejimenez123](https://github.com/ejimenez123)
- [@graterol-oswaldo](https://github.com/graterol-oswaldo)
- [@FDSoil](https://github.com/FDSoil)

## Contact

If you want to contact me you can reach me at <email@address.com>.

## License

This project uses the following license: [ GPL-3.0 License ](https://github.com/CaribesTIC/laravel-vue-monitor/blob/main/LICENSE).
