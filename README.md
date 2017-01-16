Shorty  [![Build Status](https://travis-ci.org/alphatesla/shorty.svg?branch=master)](https://travis-ci.org/alphatesla/shorty)
=======

A Symfony project created on January 10, 2017, 8:56 pm.

Shorty justs take an url and renters a minified version "à la bitly".

Shortener algo can generate 56800235584 unique combinations.
So it is quite comfortable if it is planned to be used internally.
For a commercial service, every code generation must be guaranteed to be unique.

Prerequisites
==============

Composer is installed on your environment
Symfony is installed on your environment.
Sqlite3 needs to be installed.
Phpunit is used for testing.


Install
=========

- composer install in project root
- launch doctrine migration to set the table in mysqlte db
- dump assets
- launch sf built-in server if you don't feel to create a vhost
- you can launch tests with "phpunit tests/AppBundle/"


How to test
============

Go to http://localhost:8000/ or the domain that you chose.

Fill url in the form and click on submit.

data will be stored in db and short link appear.

Copy this url (or click on it) and use it in your browser to be redirected to the url
you entered in the form



Nice to have
==============

- I thought to migrate form submission in js with ajax but no time.

- Counter implementations is naive. Maybe we can parse server logs to gather data and implements counter?

- depending on links to be generated, visits to link, need to think about some cache strategies (sql + server)

- I would move app templates in bundle, apply proper theming to get rid of custom error management if form template

===============
