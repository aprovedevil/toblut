<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class NilaiSiswaController extends Controller
{
    public function index() {
        return Inertia::render("Siswa/Nilai");
    }
}
