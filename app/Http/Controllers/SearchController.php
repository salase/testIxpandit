<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\View;

//use App\Services\PokemonService;

class SearchController extends Controller
{
	public function __construct()
	{
		$this->pokemonService = resolve('Service\Pokemon');//FIXME decouple
	}

    /**
     * @return [type]
     */
    public function index(Request $request)
    {
    	//$find = $this->pokemonService->find('nido');dd(__METHOD__,$find);
    	$one = $this->pokemonService->retrieve(1);dd($one);

    	return view('pokemon.search',[]);
    }

    /**
     * @param  [type]
     * @return [type]
     */
    public function search(Request $request, $pattern)
    {
    	return view('pokemon.search',['searchResults'=>['a','b','c']]);
    }
}
