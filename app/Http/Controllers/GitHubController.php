<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitHubController extends Controller
{
    public function index()
    {
        // Ton lien GitHub
        $githubUrl = 'https://github.com/Sagesse2020';

        // Nom d'affichage (facultatif)
        $githubName = 'Sagesse2020';

        return view('github.index', compact('githubUrl', 'githubName'));
    }
}
