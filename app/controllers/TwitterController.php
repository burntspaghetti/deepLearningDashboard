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

		$results = $this->getTweets($searchTerm, $result_type, $count);

		$alchemyapi = new AlchemyAPI();

		$tweetIntel = [];
		$positive = [];
		$negative = [];
		$neutral = [];

		foreach($results->statuses as $tweet)
		{
			$sentimentOptions = ['sentiment' => 0];
			$tweetSentiment = $this->doAlchemy('text', $tweet->text, $sentimentOptions, 'sentiment', 'docSentiment', $alchemyapi);

			$conceptOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'showSourceText' => 1];
			$tweetConcepts = $this->doAlchemy('text', $tweet->text, $conceptOptions, 'concepts', 'concepts', $alchemyapi);

			$entityOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'sentiment' => 1];
			$tweetEntities = $this->doAlchemy('text', $tweet->text, $entityOptions, 'entities', 'entities', $alchemyapi);

			$keywordOptions = ['sentiment' => 1, 'showSourceText' => 1, 'maxRetrieve' => 5];
			$tweetKeywords = $this->doAlchemy('text', $tweet->text, $keywordOptions, 'keywords', 'keywords', $alchemyapi);


			$tmp = ['tweet' => $tweet->text,
					'screenName' => $tweet->user->screen_name,
					'userURL' => $tweet->user->url,
					'sentiment' => $tweetSentiment,
					'entities' => $tweetEntities,
					'keywords' => $tweetKeywords,
					'concepts' => $tweetConcepts];

			array_push($tweetIntel, $tmp);

			if(!empty($tweetSentiment))
			{
				if($tweetSentiment['type'] == 'positive')
				{
					array_push($positive, $tweetSentiment['type']);
				}
				elseif($tweetSentiment['type'] == 'negative')
				{
					array_push($negative, $tweetSentiment['type']);
				}
				elseif($tweetSentiment['type'] == 'neutral')
				{
					array_push($neutral, $tweetSentiment['type']);
				}
			}
		}

		$percentages = $this->getSentimentPercentages($positive, $negative, $neutral);

		return View::make('twitterResults')->with('tweetIntel', $tweetIntel)
			                               ->with('searchTerm', Input::get('twitterSearch'))
										   ->with('percentages', $percentages);
	}


	private function getTweets($searchTerm, $result_type, $count)
	{
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
		return $results;
	}

	private function doAlchemy($flavor, $data, $options, $call, $key, $alchemyapi)
	{
		$response = $alchemyapi->$call($flavor, $data, $options);
		if(array_key_exists($key, $response))
		{
			$intel = $response[$key];
		}
		else
		{
			$intel = null;
		}

		return $intel;
	}

	private function getSentimentPercentages($positive, $negative, $neutral)
	{
		$positiveCount = count($positive);
		$negativeCount = count($negative);
		$neutralCount = count($neutral);
		$totalResults = $positiveCount + $negativeCount + $neutralCount;
		$posPercent = ($positiveCount / $totalResults) * 100;
		$negPercent = ($negativeCount / $totalResults) * 100;
		$neuPercent = ($neutralCount / $totalResults) * 100;
		$percentages = ['positive' => $posPercent, 'negative' => $negPercent, 'neutral' => $neuPercent];
		return $percentages;
	}

}
