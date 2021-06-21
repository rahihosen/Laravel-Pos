<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class AdminLoginController extends Controller
{

    protected $url;

    public function __construct( UrlGenerator $url)
    {
        $this->url = $url;

        if (isset(auth()->user()->id)) {
            header("Location: " . $this->url->to('/home'));
            exit();
        }
    }

    public function showLoginForm ()
    {
        return view('auth.login');
    }
}
