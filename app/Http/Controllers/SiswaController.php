<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SiswaController extends Controller
{
    public function index() {
        return Inertia::render("Siswa/Dashboard");
    }
}
