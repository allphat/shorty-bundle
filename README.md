Shorty  [![Build Status](https://travis-ci.org/allphat/shorty.svg?branch=master)](https://travis-ci.org/allphat/shorty) [![Coverage Status](https://coveralls.io/repos/github/allphat/shorty/badge.svg?branch=master)](https://coveralls.io/github/allphat/shorty?branch=master)
=======

A Symfony project created on January 10, 2017, 8:56 pm.

Shorty justs take an url and renters a minified version "à la bitly".

Prerequisites
==============

Composer is installed on your environment
Symfony is installed on your environment.
Sqlite3 needs to be installed.
Phpunit is used for testing.


Install
=========

- add shorty options to your config yml file
    shorty:
        allow_follow:   true
        allow_secure:   true
        allow_lifetime: 0

- declare  shorty in your kernel new Allphat\Bundle\ShortyBundle\ShortyBundle(),

- launch doctrine migration to set the table in mysqlte db


- create a code in a controller with $data = $this->forward('shorty.controller:createAction');
    $data is a json response like {'code': 'XXXXXX'}
