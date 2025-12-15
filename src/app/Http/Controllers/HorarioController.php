<?php
namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Ficha;
use App\Models\TrainingEnvironment as Ambiente;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        return view('horario.index');
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'valor' => 'required'
        ]);

        switch ($request->tipo) {

            case 'instructor':
                $instructor = Instructor::where('document_number', $request->valor)->first();
                if (!$instructor) return back()->with('error', 'Instructor no encontrado');
                return redirect()->route('horario.instructor', $instructor->id);

            case 'ficha':
                $ficha = Ficha::where('code', $request->valor)->first();
                if (!$ficha) return back()->with('error', 'Ficha no encontrada');
                return redirect()->route('horario.ficha', $ficha->id);

            case 'ambiente':
                $ambiente = Ambiente::where('code', $request->valor)->first();
                if (!$ambiente) return back()->with('error', 'Ambiente no encontrado');
                return redirect()->route('horario.ambiente', $ambiente->id);
        }
    }

    public function calendarInstructor($id)
    {
        $instructor = Instructor::findOrFail($id);
        $name_instructor = $instructor->name;

        return view('horario.calendario', [
            'tipo' => 'instructor',
            'id' => $id,
            'title' => "Horario de Instructor",
            'name' => $name_instructor,
        ]);
    }

    public function calendarFicha($id)
    {   
        $ficha = Ficha::findOrFail($id);
        $code_ficha = $ficha->code;
        return view('horario.calendario', [
            'tipo' => 'ficha',
            'id' => $id,
            'title' => "Horario de Ficha",
            'name' => $code_ficha,
        ]);
    }

    public function calendarAmbiente($id)
    {
        $ambiente = Ambiente::findOrFail($id);
        $name_ambiente = $ambiente->name;
        return view('horario.calendario', [
            'tipo' => 'ambiente',
            'id' => $id,
            'title' => "Horario de Ambiente",
            'name' => $name_ambiente,
        ]);
    }
}
