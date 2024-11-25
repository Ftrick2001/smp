<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;

// PeriodController.php
class PeriodController extends Controller
{
    public function index()
    {
        // Obtener todos los períodos ordenados
        $periods = Period::orderBy('grade')
                        ->orderBy('trimester')
                        ->get();

        return view('page.lesson', compact('periods'));
    }

    public function show($period_id)
    {
        // Cargar el período con sus relaciones
        $period = Period::with(['lessons' => function($query) {
            $query->orderBy('created_at', 'asc');
        }, 'lessons.subtopics' => function($query) {
            $query->orderBy('created_at', 'asc');
        }])->findOrFail($period_id);

        // Si es una petición AJAX, devolver JSON
        if(request()->ajax()) {
            return response()->json($period);
        }

        // Si no es AJAX, devolver la vista normal
        return view('lesson', compact('period'));
    }
}