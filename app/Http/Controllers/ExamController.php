<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Result;


class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('lesson.period')->get();
        return view('page.examen', compact('exams'));
    }

    public function show($exam_id)
    {
        // Traer el examen con las preguntas asociadas usando 'with'
        $exam = Exam::with('questions')->findOrFail($exam_id);

        // Si la petición es AJAX, devolver los datos como JSON
        if (request()->ajax()) {
            return response()->json($exam);
        }

        // Si no es una solicitud AJAX, retornar la vista con el examen
        return view('page.examen', compact('exam'));
    }

    public function storeResult(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'student' => 'required|string|max:255',
            'score' => 'required|numeric|min:0'
        ]);

        $result = new Result();
        $result->exam_id = $request->exam_id;
        $result->student = $request->student;
        $result->score = $request->score;
        $result->save();

        return response()->json(['message' => 'Resultado guardado exitosamente']);
    }



}
