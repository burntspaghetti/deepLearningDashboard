#Deep Learning Dashboard (DLD)

##Current State

This project is a scalable proof of concept utilizing deep learning technology from AlchemyAPI. The process begins with a keyword search such as a hashtag or brand name. DLD then grabs tweets or posts matching the search text from the Twitter and StackExchange APIs and then feeds the matches into AlchemyAPI for natural language processing (NLP) analysis. The information gathered from Twitter and StackExchange is analyzed for sentiment, keywords, entities, concepts, and relevance. The results are then presented in graphical form using [Highcharts](http://www.highcharts.com/) as well as color coded table form using [DataTables](https://www.datatables.net/) for quick queries.

##Future State

Users will be able to track and monitor various trends in sentiment for the people, places, and things they care about. Assuming TOS compliance, the future state of DLD will run recurring jobs to fetch API data in the background and then store results in a MySQL database for historical analysis. 

##Limitations

* DLD runs large amounts of API calls en masse which can result in long waiting times. The future state will resolve this issue by fetching data from the database instead of waiting on the APIs.

* API rate limits will need to be considered.

##Attributions


* [Vaprobrash](https://github.com/fideloper/Vaprobash) - Vagrant Provisioning Bash Scripts

* [Highcharts](http://www.highcharts.com/) - Interactive JavaScript charts for your web page

* [DataTables](https://www.datatables.net/) - Tables plug-in for jQuery

* [Flatly](https://bootswatch.com/flatly/) - Flat and modern bootstrap theme

* [Laravel 4.2](http://laravel.com/docs/4.2) - The PHP Framework For Web Artisans

* [twitter-api-php](https://github.com/J7mbo/twitter-api-php) - Simple PHP Wrapper for Twitter API v1.1 calls

* [alchemyapi_php](https://github.com/AlchemyAPI/alchemyapi_php) - A sdk for AlchemyAPI using php

* [Twitter API v1.1](https://dev.twitter.com/rest/public)

* [StackExchange API v2.2](https://api.stackexchange.com/)

##Additional Notes

It is recommended to use DLD in Chrome.




