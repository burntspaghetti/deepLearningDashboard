<?php

require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');
require_once '../alchemyapi_php/alchemyapi.php';

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/testing', function()
{
	$searchTerm = 'Barack';
	$settings = array(
		'oauth_access_token' => Config::get('oauth.oauth_access_token'),
		'oauth_access_token_secret' => Config::get('oauth.oauth_access_token_secret'),
		'consumer_key' => Config::get('oauth.consumer_key'),
		'consumer_secret' => Config::get('oauth.consumer_secret')
	);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';

	//two word search
	//https://twitter.com/search?q=barack%20obama&src=typd

	$getfield = '?q='. $searchTerm . '&src=typd';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$jsonResponse =  $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();
	$results = json_decode($jsonResponse);
	dd($results);
});

Route::get('/test', function()
{
	//entity extraction from stackoverflow questions is not proving reliable or valuable
	$alchemyapi = new AlchemyAPI();
	$options = ['sentiment' => 1];
	$response = $alchemyapi->entities('url', 'http://stackoverflow.com/questions/30542605/are-xsds-available-or-alchemyapi', $options);
	dd($response);

//	$alchemyapi = new AlchemyAPI();
//	$options = array('sentiment' => 1);
//	$response = $alchemyapi->keywords('url', 'http://stackoverflow.com/questions/30542605/are-xsds-available-or-alchemyapi', $options);
//	dd($response);

});

Route::get('/', function()
{
	function curl($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_USERAGENT, 'cURL');
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_ENCODING , "gzip");

		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}


	$response = json_decode(curl("http://api.stackexchange.com/2.2/search/advanced?order=desc&sort=activity&body=alchemyapi&title=alchemyapi&site=stackoverflow"));

	$alchemyapi = new AlchemyAPI();

	$posts = [];
	$concepts = [];
	$keywords = [];
	$entities = [];

	foreach($response->items as $post)
	{
//		dd($post);
		
		var_dump($post->link);
		$options = ['sentiment' => 1];


		//extract text from url with alchemy api call
		//errored out... maybe try later
//		$response = $alchemyapi->text('text', $post->link, $options);


		//push all of the following to their own respective 4 arrays
		//search through concepts, keywords, and entities to aggregate results
		//average relevance and sentiments

		//make sure to grab linked data? link to in table?
//			$response = $alchemyapi->concepts('url', $post->link, $options);
//			$response = $alchemyapi->keywords('text', $post->link, $options);
			$response = $alchemyapi->sentiment('text', $post->link, $options);
//			$response = $alchemyapi->entities('text', $post->link, $options);
		dd($response);


//			array_push($tweets, $tweet);
		//feed tweets into alchemy api sentiment

	}



	foreach($response->items as $post)
	{
		dd($post->link);

	}

//	$feed = json_decode($feed,true);
//	$rep = $feed['items'][0]['reputation'];
//	echo $rep;//531776
});




Route::get('/twitter', 'TwitterController@home');
Route::post('/twitterSearch', 'TwitterController@search');
Route::get('/twitter/searchResults', 'TwitterController@results');

Route::get('/stackExchange', 'StackExchangeController@home');
Route::post('stackExchangeSearch', 'StackExchangeController@search');
Route::get('/stackExchange/searchResults', 'StackExchangeController@results');