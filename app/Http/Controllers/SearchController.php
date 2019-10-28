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
    public function index(Request $request, $pattern = null)
    {
    	//FIX add validations: $pattern<required>
		$searchResults = (empty($pattern)) ? $this->pokemonService->all() : $this->pokemonService->find($pattern);
    	//FIXME eval request content-type header
    	return response()->json($searchResults,200);
    }

    /**
     * @param  [type]
     * @return [type]
     */
    public function search(Request $request, $pattern)
    {
    	//FIXME eval request content-type header
    	//return response()->view('pokemon.search',['searchResults'=>$this->pokemonService->find($pattern)],200);
    	return response()->json($this->pokemonService->find($pattern),200);
    }
}
