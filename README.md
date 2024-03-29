# Tritonium project!
> *Is it a framework or not?*

[![GitHub stars](https://img.shields.io/github/stars/tregor/Tritonium?style=flat-square)](https://github.com/tregor/Tritonium/stargazers)
[![Last Commit](https://img.shields.io/github/last-commit/tregor/Tritonium?style=flat-square)](https://github.com/tregor/ErrorHandler)
[![GitHub forks](https://img.shields.io/github/forks/tregor/Tritonium?style=flat-square)](https://github.com/tregor/Tritonium/network)
[![GitHub license](https://img.shields.io/github/license/tregor/Tritonium?style=flat-square)](LICENSE)


Tritonium is an MVC microframework that is used by me on some projects.

It contains some helpful services and libraries, a simple templating engine, and other features.

---
## Navigation
- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [TODO](#todo)
- [Contribute](#contribute)
- [License](#license)
- [Copyright](#copyright)

---

## Requirements

This library is supported by **PHP versions 7.0** or higher.

## Installation

You can **clone the complete repository** with Git:

    $ git clone https://github.com/tregor/Tritonium.git

Or **install it manually**:

[Download Tritonium project](https://github.com/tregor/Tritonium/archive/master.zip):

    $ wget https://github.com/tregor/Tritonium/archive/master.zip

After downloading you will need to install the framework, init DB connection, and set some other settings.

First, edit config.php for your needs and init DB connection

    nano config.php

To start the installation script you need to execute:

    php tmd core/install

## Available Methods

Available methods in this library:

### Create new migration

To create any new migration SQL (install/update/delete operations) use this command:

    php tmd migrations/create

### Execute migrations

This command will execute every well-formatted migration SQL file:

    php tmd migrations/migrate

## TODO
- [X] Add templating engine and view renderer.
- [X] Make model system.
- [X] Develop Request service.
- [X] Make full PDO system, not MYSQL only.
- [X] Make bootstrapping out of autoloading.
- [X] Make an automatic class scanner-mapper
- [X] Add routing and implement controllers.
- [X] Move commands to TMD.
- [X] Implement global access for app vars
- [X] Exceptions system
- [X] Improve routing system with dynamical in-path params
- [X] Make ActiveRecord models
- [ ] Improve ActiveQuery system, add OrWhere
- [X] Implement events system
- [ ] Remake Migrations controller and core UI
- [X] Exceptions and Errors classification
- [X] Take care to in-framework Error Handler (Inline+Full mode+PrettyVarDumper)
- [ ] Improve ErrorHandler, add Inline mode, SQL profilling and JS debugger
- [ ] Improve templating engine and view renderer.
- [ ] Dictionaries and ENUMs as services
- [ ] Make Session and Cookies as JARs
- [ ] Make Helpers
  - [ ] CSV helper, will create object from csv file
  - [ ] Array helper, jump thru array with string address
- [ ] Installation wizard.
- [ ] Improve wiki and in-code comments.
- [ ] Add caching service built-in ActiveRecord
- [ ] Refactor code.
- [ ] Take a cup of coffee.

## Contribute

If you would like to help, please take a look at the list of
[issues](https://github.com/tregor/Tritonium/issues) or the [ToDo](#todo) checklist.

**Pull requests**

* [Fork and clone](https://help.github.com/articles/fork-a-repo).
* Run the **tests**.
* Create a **branch**, **commit**, **push** and send me a
  [pull request](https://help.github.com/articles/using-pull-requests).

## License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

## Copyright

[By tregor 2021](https://tregor.ru/)

Please let me know if you have any feedback or suggestions.

You can contact me on [Facebook](https://www.facebook.com/tregor1997) or through my [email](mailto:tregor1997@gmail.com).
