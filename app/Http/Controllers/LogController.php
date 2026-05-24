<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // Eager loading de usuario y servicio
        $query = Log::with(['user', 'service'])->latest();

        // Aplicar filtro por fecha si existe en el Request
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // withQueryString() mantiene el filtro de fecha en la URL al cambiar de página
        $logs = $query->paginate(10)->withQueryString();

        return view('logs.index', compact('logs'));
    }
}
