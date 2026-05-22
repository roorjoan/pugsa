<?php

namespace App\Http\Controllers;

use App\Models\DomainAccountRequest;
use Illuminate\Http\Request;

class DomainAccountRequestController extends Controller
{
    // Vista para usuarios (crear solicitudes)
    public function create()
    {
        return view('domain-requests.create');
    }

    // Procesar la solicitud del usuario
    public function store()
    {
        // Buscamos si el usuario tiene alguna solicitud que NO esté rechazada (es decir, pendiente o aprobada)
        $activeRequest = DomainAccountRequest::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        // Si encontramos una, bloqueamos la creación y le damos feedback específico
        if ($activeRequest) {
            if ($activeRequest->status === 'pending') {

                notify()
                    ->success()
                    ->title('Ya tienes una solicitud en proceso. Por favor, espera la respuesta del administrador.')
                    ->send();

                return back();
            }

            if ($activeRequest->status === 'approved') {

                notify()
                    ->success()
                    ->title('Tu solicitud anterior ya fue aprobada. Ya cuentas con acceso al dominio.')
                    ->send();

                return back();
            }
        }

        // Si no tiene solicitudes activas (o si solo tiene rechazadas), le permitimos crear una nueva
        DomainAccountRequest::create([
            'user_id' => auth()->id()
            // 'status' toma el valor 'pending' automáticamente por tu base de datos
        ]);

        notify()
            ->success()
            ->title('Solicitud enviada correctamente.')
            ->send();

        return back();
    }

    // Vista para Administradores (listar solicitudes)
    public function index()
    {
        $requests = DomainAccountRequest::with('user')->latest()->paginate(10);
        return view('domain-requests.index', compact('requests'));
    }

    // Aprobar o rechazar
    public function update(Request $request, DomainAccountRequest $domainRequest)
    {
        $domainRequest->update([
            'status' => $request->status,
            'approved_by' => auth()->user()->name
        ]);

        notify()
            ->success()
            ->title('Solicitud actualizada correctamente.')
            ->send();

        return back();
    }
}
