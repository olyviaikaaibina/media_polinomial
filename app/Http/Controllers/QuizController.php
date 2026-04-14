<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('bab')
            ->orderBy('bab_id')
            ->orderBy('id')
            ->get();

        $babs = Bab::orderBy('urutan')->get();

        return view('guru.daftarkuis', compact('quizzes', 'babs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bab_id' => 'required|exists:bab,id',
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'total_questions' => 'required|integer|min:0',
            'kkm' => 'required|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $quiz = Quiz::findOrFail($id);

        $data = [
            'bab_id' => $request->bab_id,
            'title' => $request->title,
            'description' => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'total_questions' => $request->total_questions,
            'kkm' => $request->kkm,
        ];

        if ($request->hasFile('image')) {
            if ($quiz->image && Storage::disk('public')->exists($quiz->image)) {
                Storage::disk('public')->delete($quiz->image);
            }

            $path = $request->file('image')->store('quiz_images', 'public');
            $data['image'] = $path;
        }

        $quiz->update($data);

        return redirect()->route('daftarkuis')->with('success', 'Kuis berhasil diupdate.');
    }

    public function soal($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);

        return view('guru.soalkuis', compact('quiz'));
    }
}