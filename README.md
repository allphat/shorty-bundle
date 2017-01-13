almtest
=======

A Symfony project created on January 10, 2017, 8:56 pm.


Install
=========

you need composer to install application and mysqlite as db. (db file will be stored in app for ease)
Developped on ubuntu 16.04 with php7


composer install in project root
launch dictrine migration to set the table in mysqlte db


How to test
============

run symfony built-in server and go to

http://localhost:8000/


Fill url in the form and click on submit

data will be stored in db and short link appear.


Copy this url and use it in yor browser to be redirected to the url
you entered in the form



Missing
===========

"Algorithm" used to generate the short uri is not fit for production (neither the database)

Generated ids are not really random. 
In order to choose a good one (robust, really random), we need to ask some questions
- does it have to be unique ? 
- may be we could have ephemral links (that last a period then deactivates or redirect to anotger link after) ?
- do we allow to create multiple short links for a url (after all it would be used to measure traffic,
    so maybe we want a unique couple (shortid/longurl)) ?

to implement a correct, we need to ask some questions as :
- volume of urls generated (per hour/day/month)
- number of clicks on urls(per hour/day/month)
- internal service or need to be open to partners?
We need some infos like these to design and choose technology for (storage, cache)


some things that i wanted to change

- move calls to repository to a manager
- security constraints on url passed in form (malicious urls, js encoded)
- unit and functional test
- change size of url input (to follow rfc)
- real styling (installed bootstrap but not activated)
- implement counter click
- use a hostname like a.lm "redir.alittlemarket" misses the point imho :)
