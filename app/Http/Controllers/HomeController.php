<?php 	namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;


class HomeController extends Controller
{
	public function index()
	{
		//pega as áres de interesse do banco e direciona para a tela de submeter currículos
		$offices = Office::where('is_office', true)->orderBy('created_at')->get();

		// return view('insert-curriculum', ['offices' => $offices]);
		return view('master');
	}
}