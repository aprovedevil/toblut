<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class MaterPelajaranController extends Controller
{
    public function index() {
        return Inertia::render("Guru/MateriPelajaran");
    }
}
