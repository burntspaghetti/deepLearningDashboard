<?php

require_once('../vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');
require_once '../alchemyapi_php/alchemyapi.php';

class StackExchangeController extends BaseController {

    public function home()
    {
        return View::make('stackSearch');
    }

	public function search()
	{
        $validation = Validator::make(
            Input::all(), array(
                'stackExchangeSearch' => 'required | max:50',
            )
        );

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }

		$searchTerm = urlencode(Input::get('stackExchangeSearch'));

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

        $searchURL = "http://api.stackexchange.com/2.2/search?pagesize=100&order=desc&sort=activity&intitle=". $searchTerm ."&site=stackoverflow";
        $response = json_decode(curl($searchURL));

        $alchemyapi = new AlchemyAPI();
        $postIntel = [];

        foreach($response->items as $post)
        {
            $textOptions = ['useMetadata' => 1];
            $textResponse = $alchemyapi->text('url', $post->link, $textOptions);

            //DONE
            $sentimentOptions = ['sentiment' => 1];
//            $sentimentResponse = $alchemyapi->sentiment('text', $textResponse['text'], $sentimentOptions);
            $sentimentResponse = $alchemyapi->sentiment('url', $post->link, $sentimentOptions);
            if(array_key_exists('docSentiment', $sentimentResponse))
            {
                $postSentiment = $sentimentResponse['docSentiment'];
            }
            else
            {
                $postSentiment = null;
            }

            //DONT USE
            //when loading stack url into concepts call, it just returns random unrelated stuff
            //when loading extracted text into concepts call, it returns empty every time
//            $conceptOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'showSourceText' => 1];
//            $conceptsResponse = $alchemyapi->concepts('text', $textResponse, $conceptOptions);
//
//            if(array_key_exists('concepts', $conceptsResponse))
//            {
//                $postConcepts = $conceptsResponse['concepts'];
//                array_push($concepts, $postConcepts);
//            }


            $entityOptions = ['maxRetrieve' => 5, 'linkedData' => 1, 'sentiment' => 1];
//            $entityResponse = $alchemyapi->entities('url', $post->link, $entityOptions);
            //text seems to return better results than link?
            $entityResponse = $alchemyapi->entities('text', $textResponse['text'], $entityOptions);
            if(array_key_exists('entities', $entityResponse))
            {
                $postEntities = $entityResponse['entities'];
            }
            else
            {
                $postEntities = null;
            }


            $keywordOptions = ['sentiment' => 1, 'showSourceText' => 1, 'maxRetrieve' => 5];
//            $keywordResponse = $alchemyapi->keywords('url', $post->link, $keywordOptions);
            $keywordResponse = $alchemyapi->keywords('text', $textResponse['text'], $keywordOptions);
            if(array_key_exists('keywords', $keywordResponse))
            {
                $postKeywords = $keywordResponse['keywords'];
            }
            else
            {
                $postKeywords = null;
            }

            $tmp = ['link' => $post->link,
                    'title' => $post->title,
                    'answered' => $post->is_answered,
                    'sentiment' => $postSentiment,
                    'entities' => $postEntities,
                    'keywords' => $postKeywords];
            
            array_push($postIntel, $tmp);
        }

        return View::make('stackResults')->with('postIntel', $postIntel)->with('searchTerm', Input::get('stackExchangeSearch'));
	}
}
