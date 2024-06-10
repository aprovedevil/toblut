<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GuruController extends Controller
{
    public function index() {
        return Inertia::render("Guru/Dashboard");
    }
}
