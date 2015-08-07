<?php

require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');
require_once '../alchemyapi_php/alchemyapi.php';

class TwitterController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function search()
	{
		$searchTerm = urlencode(Input::get('twitterSearch'));
		//add checkbox for mixed, recent, or popular param
		$result_type = 'mixed';
		$count = 100;

		

		$settings = array(
			'oauth_access_token' => Config::get('oauth.oauth_access_token'),
			'oauth_access_token_secret' => Config::get('oauth.oauth_access_token_secret'),
			'consumer_key' => Config::get('oauth.consumer_key'),
			'consumer_secret' => Config::get('oauth.consumer_secret')
		);

		$url = 'https://api.twitter.com/1.1/search/tweets.json';

		//two word search
		//https://twitter.com/search?q=barack%20obama&src=typd

		$getfield = '?q='. $searchTerm . '&result_type=' . $result_type .'&count=' . $count . '&src=typd';
		$requestMethod = 'GET';

		$twitter = new TwitterAPIExchange($settings);
		$jsonResponse =  $twitter->setGetfield($getfield)
			                     ->buildOauth($url, $requestMethod)
			                     ->performRequest();
		$results = json_decode($jsonResponse);
		dd($results);


		$alchemyapi = new AlchemyAPI();
		$options = ['sentiment' => 1];

//		dd($response);



		$tweets = [];
		$concepts = [];
		$keywords = [];
		$entities = [];

		foreach($results->statuses as $tweet)
		{
//			dd($tweet);
			
			var_dump($tweet->text);
			//push all of the following to their own respective 4 arrays
			//search through concepts, keywords, and entities to aggregate results
			//average relevance and sentiments

			//make sure to grab linked data? link to in table?
//			$response = $alchemyapi->concepts('text', $tweet->text, $options);
//			$response = $alchemyapi->keywords('text', $tweet->text, $options);
//			$response = $alchemyapi->sentiment('text', $tweet->text, $options);
			$response = $alchemyapi->entities('text', $tweet->text, $options);
			dd($response);


//			array_push($tweets, $tweet);
			//feed tweets into alchemy api sentiment

		}

		dd($results);

	}

}
