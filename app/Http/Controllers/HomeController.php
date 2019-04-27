<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function reviewers(){
        return view('reviewers');
    } 
    public function journals(){
        return view('journals');
    }
    public function publications(){
        return view('publications');
    } 
    public function institutions(){
        return view('institutions');
    }
    public function countries(){
        return view('countries');
    }
    public function get_country_name(){
      $countries = Country::all();
      $data = '';
      foreach ($countries as $key) {
          $data .= '<option value="'.$key->id.'">'.$key->name.'</option>';
      }
      return $data;

    }
}
