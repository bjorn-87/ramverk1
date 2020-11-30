[![Build Status](https://travis-ci.org/bjorn-87/ramverk1.svg?branch=master)](https://travis-ci.org/bjorn-87/ramverk1) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bjorn-87/ramverk1/build-status/master)

My redovisa repo
==============

My name is Björn Olsson.
This is my repo for the BTH course Ramverk1-V2.

# Download and install
Clone this repo and use the command `make install`

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
