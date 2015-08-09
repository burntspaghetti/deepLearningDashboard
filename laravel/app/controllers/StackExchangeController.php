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

        $response = $this->getPosts(Input::get('stackExchangeSearch'), Input::get('count'));

        $alchemyapi = new AlchemyAPI();
        $postIntel = [];

        foreach($response->items as $post)
        {
            $textOptions = ['useMetadata' => 1];
            $textResponse = $alchemyapi->text('url', $post->link, $textOptions);

            $sentimentOptions = ['sentiment' => 1];
            $postSentiment = $this->doAlchemy('url', $post->link, $sentimentOptions, 'sentiment', 'docSentiment', $alchemyapi);

            //Dont use concepts
            //when loading stack url into concepts call, it just returns random unrelated stuff
            //when loading extracted text into concepts call, it returns empty every time

            $entityOptions = ['maxRetrieve' => 5, 'sentiment' => 1];
            $postEntities = $this->doAlchemy('text', $textResponse['text'], $entityOptions, 'entities', 'entities', $alchemyapi);

            $keywordOptions = ['sentiment' => 1, 'showSourceText' => 1, 'maxRetrieve' => 5];
            $postKeywords = $this->doAlchemy('text', $textResponse['text'], $keywordOptions, 'keywords', 'keywords', $alchemyapi);

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

    private function getPosts($searchTerm, $count)
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

        $searchURL = "http://api.stackexchange.com/2.2/search?pagesize=". $count . "&order=desc&sort=activity&intitle=". $searchTerm ."&site=stackoverflow";
        $response = json_decode(curl($searchURL));

        return $response;
    }
}
