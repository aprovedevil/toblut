<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterSiswaController extends Controller
{
    public function index(){
        return Inertia::render("Siswa/MateriSiswa");
    }
}
