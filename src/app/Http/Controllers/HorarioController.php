<?php
namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Ficha;
use App\Models\Ambiente;
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
                $ambiente = Ficha::where('code', $request->valor)->first();
                if (!$ambiente) return back()->with('error', 'Ambiente no encontrado');
                return redirect()->route('horario.ambiente', $ambiente->id);
        }
    }

    public function calendarInstructor($id)
    {
        return view('horario.calendario', [
            'tipo' => 'instructor',
            'id' => $id
        ]);
    }

    public function calendarFicha($id)
    {
        return view('horario.calendario', [
            'tipo' => 'ficha',
            'id' => $id
        ]);
    }

    public function calendarAmbiente($id)
    {
        return view('horario.calendario', [
            'tipo' => 'ambiente',
            'id' => $id
        ]);
    }
}
