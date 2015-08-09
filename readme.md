#Deep Learning Dashboard (DLD)

##Current State:

This project is a scalable proof of concept utilizing deep learning technology from AlchemyAPI. The process begins with user input search text. DLD then grabs tweets and posts matching the search text from Twitter and StackExchange APIs and then feeds the responses into AlchemyAPI for natural language processing (NLP) analysis. The information gathered from Twitter and StackExchange is analyzed for sentiment, keywords, entities, concepts, and relevance. The results are then presented in graphical form using [Highcharts](http://www.highcharts.com/) as well as color coded table form using [DataTables](https://www.datatables.net/) for quick queries.

##Future State:

Users will be able to track and monitor various trends based on a search text, each of which will aggregate new data daily. Assuming TOS compliance, the future state of DLD will run recurring jobs to fetch API data in the background and then store results in a MySQL database for historical analysis. 

##Limitations:

DLD runs large amounts of API calls en masse which can result in long waiting times. The future state will resolve this issue by fetching data from the database instead of waiting on the APIs.

##Additional Notes:

It is recommended to use DLD in Chrome.



