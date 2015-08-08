<?php

require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');
require_once '../alchemyapi_php/alchemyapi.php';

class TwitterController extends BaseController {

	public function home()
	{
		return View::make('twitterSearch');
	}

	public function search()
	{
		$validation = Validator::make(
			Input::all(), array(
				'twitterSearch' => 'required | max:50',
			)
		);

		if ($validation->fails()) {
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}

		$searchTerm = urlencode(Input::get('twitterSearch'));
		$result_type = Input::get('type');
		$count = Input::get('numberOfTweets');

		$settings = array(
			'oauth_access_token' => Config::get('oauth.oauth_access_token'),
			'oauth_access_token_secret' => Config::get('oauth.oauth_access_token_secret'),
			'consumer_key' => Config::get('oauth.consumer_key'),
			'consumer_secret' => Config::get('oauth.consumer_secret')
		);

		$url = 'https://api.twitter.com/1.1/search/tweets.json';

		$getfield = '?q='. $searchTerm . '&result_type=' . $result_type .'&count=' . $count . '&src=typd';
		$requestMethod = 'GET';

		$twitter = new TwitterAPIExchange($settings);
		$jsonResponse =  $twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();
		$results = json_decode($jsonResponse);

		$alchemyapi = new AlchemyAPI();
		$tweetIntel = [];

		foreach($results->statuses as $tweet)
		{
			//need to set options for each call
			//sentiment => 1 = keyword, entity, or relational sentiment
			//sentiment => 0 = document level sentiment...
			//experiment with each
			//returning the same sentiment?

			//DONE
			$sentimentOptions = ['sentiment' => 0];
			$sentimentResponse = $alchemyapi->sentiment('text', $tweet->text, $sentimentOptions);
			if(array_key_exists('docSentiment', $sentimentResponse))
			{
				$tweetSentiment = $sentimentResponse['docSentiment'];
			}
			else
			{
			    $tweetSentiment = null;
			}

			//DONE
			$conceptOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'showSourceText' => 1];
			$conceptsResponse = $alchemyapi->concepts('text', $tweet->text, $conceptOptions);
			if(array_key_exists('concepts', $conceptsResponse))
			{
				$tweetConcepts = $conceptsResponse['concepts'];
			}
			else
			{
			    $tweetConcepts = null;
			}

			//DONE
			$entityOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'sentiment' => 1];
			$entityResponse = $alchemyapi->entities('text', $tweet->text, $entityOptions);
			if(array_key_exists('entities', $entityResponse))
			{
				$tweetEntities = $entityResponse['entities'];
			}
			else
			{
			    $tweetEntities = null;
			}

			//DONE
			$keywordOptions = ['sentiment' => 1, 'showSourceText' => 1, 'maxRetrieve' => 5];
			$keywordResponse = $alchemyapi->keywords('text', $tweet->text, $keywordOptions);
			if(array_key_exists('keywords', $keywordResponse))
			{
				$tweetKeywords = $keywordResponse['keywords'];
			}

			$tmp = ['tweet' => $tweet->text,
					'screenName' => $tweet->user->screen_name,
					'userURL' => $tweet->user->url,
					'sentiment' => $tweetSentiment,
					'entities' => $tweetEntities,
					'keywords' => $tweetKeywords,
					'concepts' => $tweetConcepts];
			array_push($tweetIntel, $tmp);
		}

		return View::make('twitterResults')->with('tweetIntel', $tweetIntel)->with('searchTerm', Input::get('twitterSearch'));
		//count up all positiive, negatives, and mixed?
	}

}
