<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index() {
        return Inertia::render('Admin/Dashboard'); // Nama komponen harus cocok dengan yang ada di direktori `resources/js/Pages`
    }
}
