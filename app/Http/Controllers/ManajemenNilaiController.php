<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class ManajemenNilaiController extends Controller
{
    public function index() {
        return Inertia::render("Guru/ManajemenNilai");
    }
}
