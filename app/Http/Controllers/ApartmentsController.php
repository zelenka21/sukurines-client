<?php

namespace App\Http\Controllers;

class ApartmentsController extends Controller
{
    public function index()
    {
        return view('admin.apartments.index');
    }
    public function getReviews()
    {
        return view('admin.reviews.index');
    }
     public function getUsers()
    {
        return view('admin.users.index');
    }
      public function getApartment()
    {
        return view('apartments');
    }
         public function browseApartments()
    {
        return view('browse');
    }

}
