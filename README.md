# Tritonium project!
> *Is it a framework or not?*

[![GitHub stars](https://img.shields.io/github/stars/tregor/Tritonium?style=flat-square)](https://github.com/tregor/Tritonium/stargazers)
[![Last Commit](https://img.shields.io/github/last-commit/tregor/Tritonium?style=flat-square)](https://github.com/tregor/ErrorHandler)
[![GitHub forks](https://img.shields.io/github/forks/tregor/Tritonium?style=flat-square)](https://github.com/tregor/Tritonium/network)
[![GitHub stars](https://img.shields.io/github/stars/tregor/Tritonium?style=flat-square)](https://github.com/tregor/Tritonium/stargazers)
[![GitHub license](https://img.shields.io/github/license/tregor/Tritonium?style=flat-square)](LICENSE)


Tritonium is a microframework that is used by me on some projects.

It contains some useful services and libraries, simple templating engine and other features.

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

After downloading you will need to install framework, init DB connection and set some other settings.

To start installation script you need to execute:

    core/commands/install.php

## Available Methods

Available methods in this library:

* Work In Progress

## TODO
- [X] Add templating engine and view renderer.
- [X] Make model system.
- [X] Develop Request service.
- [X] Make full PDO system, not MYSQL only.
- [X] Make bootstrapping out of autoload.
- [~] Add routing and implement controllers.
- [ ] Move commands to TMD.
- [ ] More power to controllers! Implement global app vars and BaseController vars (Like "$this->app->request" or "Tritonium::$request")
- [ ] Exceptions and errors classification
- [ ] Take care to in-framework Error Handler
- [ ] Improve templating engine and view renderer.
- [ ] Searching a way to implement dynamical table name for Models... (From Static to Object?)
- [ ] Improve documentation.
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

Please let me know if you have feedback or suggestions.

You can contact me on [Facebook](https://www.facebook.com/tregor1997) or through my [email](mailto:tregor1997@gmail.com).