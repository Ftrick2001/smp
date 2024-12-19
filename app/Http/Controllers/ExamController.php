<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('lesson.period')->get();
        return view('page.examen', compact('exams'));
    }

    public function show($exam_id)
    {
        try {
            $exam = Exam::with('questions')->findOrFail($exam_id);

            if (request()->ajax()) {
                return response()->json($exam);
            }

            return view('page.examen', compact('exam'));
        } catch (\Exception $e) {
            Log::error('Error loading exam: ' . $e->getMessage());

            if (request()->ajax()) {
                return response()->json(['error' => 'Error loading exam'], 500);
            }

            return back()->with('error', 'Unable to load exam');
        }
    }

    public function storeResult(Request $request)
    {
        try {
            $validated = $request->validate([
                'exam_id' => 'required|exists:exams,id',
                'student' => 'required|string|max:255',
                'score' => 'required|numeric|min:0'
            ]);

            $result = Result::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Resultado guardado exitosamente',
                'data' => $result
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing exam result: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el resultado'
            ], 500);
        }
    }
}