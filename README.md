Travis  
[![Build Status](https://travis-ci.com/bjorn-87/ramverk1.svg?branch=master)](https://travis-ci.com/bjorn-87/ramverk1)  
Scrutinizer  
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/?branch=master)  
[![Code Coverage](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/?branch=master)  
[![Build Status](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/build-status/master)  
CircleCI  
[![<ORG_NAME>](https://circleci.com/gh/bjorn-87/ramverk1.svg?style=svg)](https://app.circleci.com/pipelines/github/bjorn-87/ramverk1)  
Codeclimate  
[![Maintainability](https://api.codeclimate.com/v1/badges/83cf9ad1738c64e65f5c/maintainability)](https://codeclimate.com/github/bjorn-87/ramverk1/maintainability)  
SymfonyInsight  
[![SymfonyInsight](https://insight.symfony.com/projects/8e7e41d3-0f7f-4a2b-8e90-0e1ad7889ffa/mini.svg)](https://insight.symfony.com/projects/8e7e41d3-0f7f-4a2b-8e90-0e1ad7889ffa)  

My redovisa repo
================

My name is Björn Olsson.
This is my repo for the BTH course Ramverk1-V2.

# Download and install
Clone this repo and use the command `make install`

# Using module bjos19/anax-weathermodule

Follow the steps in the README.md of the repo [bjos19/anax-weathermodule](https://github.com/bjorn-87/anax-weathermodule)
or on packagist [packagist bjos19/anax-weathermodule](https://packagist.org/packages/bjos19/anax-weathermodule).

# Testing
### `make test`
Runs the testsuit against a mockApi, no need for API-key.

# Add api key from [ipstack](https://ipstack.com/)
Create file `/config/api_ipstack.php` and copy the code below or rename the file `/config/api_ipstack_sample.php`.  

```
<?php

return [
    "apiKey" => "Replace this with valid Apikey"
];
```

# Add api key from [openweathermap one-call-api](https://openweathermap.org/api/one-call-api)
Create file `/config/api_owm.php` and copy the code below or rename the file `/config/api_owm_sample.php`.  

```
<?php

return [
    "apiKey" => "Replace this with valid Apikey"
];
```
