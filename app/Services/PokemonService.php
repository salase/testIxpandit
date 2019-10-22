<?php

namespace App\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class PokemonService
{
	CONST FIRST_GEN_AMMOUNT = 151;//Unchangable number given by the business

	private $client;

	/**
	 * @param Client
	 */
	public function __construct(ClientInterface $client)
	{
		$this->client = $client;
	}

	/**
	 * @param  [type]
	 * @param  integer
	 * @return [type]
	 */
	public function list($limit = self::FIRST_GEN_AMMOUNT, $offset = 0)
	{
		//ToDo cache this somewhere
		try {
			$response = $this->client->get('pokemon',['query'=>['limit' => $limit, 'offset' => $offset]]);
		} catch (RequestException $e) {
		    echo Psr7\str($e->getRequest());
		    if ($e->hasResponse()) {
		        echo Psr7\str($e->getResponse());
		    }
		}
		//sleep(1);

		return json_decode($response->getBody());
	}

	/**
	 * @return [type]
	 */
	public function all()
	{
		$pokemons = collect([]);
		$offset = 0;
		do {
			$list = $this->list(self::FIRST_GEN_AMMOUNT, $offset);
			$pokemons = $pokemons->concat($list->results);
			$offset += self::FIRST_GEN_AMMOUNT;
		} while (!empty($list->next));

		return $pokemons;
	}

	public function find($pattern)
	{
		/*
		$pokemons = collect([]);
		$offset = 0;
		do {
			$list = $this->list(self::FIRST_GEN_AMMOUNT, $offset);
			$pokemons = collect($list->results)->filter(function($value, $key) use ($pattern) {
				return (strpos($value->name,strtolower($pattern)));
			});
			if($pokemons->isNotEmpty())
				break;
			$offset += self::FIRST_GEN_AMMOUNT + 1;
		} while (!empty($list->next));
		dd(__METHOD__,$pattern,$list,$pokemons,$offset);

		return $pokemons;
		*/
		$pokemons = $this->all()->filter(function($value, $key) use ($pattern) {
			$match = (strpos($value->name,strtolower($pattern)));
			return ($match===false) ? false : true;
		});

		return $pokemons;
	}

	public function retrieve($id)
	{
		try {
			$response = $this->client->get('pokemon/'.$id);
		} catch (RequestException $e) {
		    echo Psr7\str($e->getRequest());
		    if ($e->hasResponse()) {
		        echo Psr7\str($e->getResponse());
		    }
		}

		return json_decode($response->getBody());
	}
}