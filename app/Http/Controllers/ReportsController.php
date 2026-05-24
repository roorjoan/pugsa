<?php

namespace App\Http\Controllers;

use App\Models\DomainAccountRequest;
use App\Models\Log;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    // Permite obtener estadisticas de usuarios en el sistema en un rango de fechas
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'start_date' => 'nullable|date|before_or_equal:today',
                'end_date'   => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
            ],
            // Poner mensajes de error personalizados
            [
                'start_date.before_or_equal' => 'La fecha de inicio debe ser hoy o anterior.',
                'end_date.after_or_equal' => 'La fecha de fin debe ser hoy o posterior a la fecha de inicio.',
                'end_date.before_or_equal' => 'La fecha de fin debe ser hoy o anterior a la fecha de inicio.',
            ]
        );

        if ($validator->fails()) {
            // Disparar notificación de error con notify()
            notify()
                ->error()
                ->title('Error en el rango de fechas: ' . $validator->errors()->first())
                ->send();

            // Redirigir de vuelta con los errores originales por si acaso
            return to_route('reports.audit');
        }

        // Por defecto, el reporte muestra los últimos 30 días
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        // Consulta base para los logs dentro del rango
        $logsQuery = Log::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        // Usuarios totales registrados en el sistema
        $totalUsers = User::count();

        // Usuarios únicos que accedieron a algún servicio en este periodo
        $activeUsers = (clone $logsQuery)->distinct('user_id')->count('user_id');

        // Total de eventos de auditoría registrados
        $totalEvents = (clone $logsQuery)->count();

        // El servicio más accedido en este periodo
        $topServiceLog = (clone $logsQuery)
            ->select('service_id')
            ->selectRaw('COUNT(*) as count')
            ->whereNotNull('service_id')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->first();

        $topService = $topServiceLog ? Service::find($topServiceLog->service_id) : null;
        $topServiceCount = $topServiceLog ? $topServiceLog->count : 0;

        // Lista detallada de los usuarios más activos (Top 5)
        $topUsers = User::withCount(['logs' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }])
            ->whereHas('logs', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->orderByDesc('logs_count')
            ->take(5)
            ->get();

        return view('reports.audit', compact(
            'startDate',
            'endDate',
            'totalUsers',
            'activeUsers',
            'totalEvents',
            'topService',
            'topServiceCount',
            'topUsers'
        ));
    }

    //Permite obtener tendencias de uso de servicios en un rango de fechas
    public function getServiceTrends(Request $request)
    {
        // Validación de fechas usando Validator para aprovechar laravel-notify
        $validator = Validator::make(
            $request->all(),
            [
                'start_date' => 'nullable|date|before_or_equal:today',
                'end_date'   => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
            ],
            [
                'start_date.before_or_equal' => 'La fecha de inicio debe ser hoy o anterior.',
                'end_date.after_or_equal' => 'La fecha de fin debe ser hoy o posterior a la fecha de inicio.',
                'end_date.before_or_equal' => 'La fecha de fin debe ser hoy o anterior a la fecha de inicio.',
            ]
        );

        if ($validator->fails()) {
            notify()
                ->error()
                ->title('Error de fechas: ' . $validator->errors()->first())
                ->send();

            return to_route('reports.trends');
        }

        // Asignación de valores EXACTOS con fallback a los últimos 30 días (formato string Y-m-d)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate   = $request->input('end_date', Carbon::now()->toDateString());

        // Consulta de tendencias
        $trends = Log::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereNotNull('service_id')
            ->select('service_id', \DB::raw('count(*) as total_usage'))
            ->groupBy('service_id')
            ->orderByDesc('total_usage')
            ->with('service')
            ->get();

        return view('reports.trends', compact('trends', 'startDate', 'endDate'));
    }

    // Permite obtener solicitudes de cuentas de dominio en un rango de fechas
    public function domainAccountRequests(Request $request)
    {
        // Validación de fechas
        $validator = Validator::make(
            $request->all(),
            [
                'start_date' => 'nullable|date|before_or_equal:today',
                'end_date'   => 'nullable|date|after_or_equal:start_date|before_or_equal:today',
            ],
            [
                'start_date.before_or_equal' => 'La fecha de inicio debe ser hoy o anterior.',
                'end_date.after_or_equal' => 'La fecha de fin debe ser hoy o posterior a la fecha de inicio.',
                'end_date.before_or_equal' => 'La fecha de fin debe ser hoy o anterior a la fecha de inicio.',
            ]
        );

        if ($validator->fails()) {
            notify()
                ->error()
                ->title('Error de fechas: ' . $validator->errors()->first())
                ->send();

            return to_route('reports.domain_requests');
        }

        // Asignación de fechas (Por defecto: últimos 30 días)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate   = $request->input('end_date', Carbon::now()->toDateString());

        // Consulta base para el rango seleccionado
        // Nota: Asegúrate de usar el modelo correcto que maneja estas solicitudes en tu base de datos
        $query = DomainAccountRequest::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        // Procesamiento de Estadísticas (KPIs)
        $stats = [
            'total'    => (clone $query)->count(),
            'pending'  => (clone $query)->where('status', 'pending')->count(),
            'approved' => (clone $query)->where('status', 'approved')->count(),
            'rejected' => (clone $query)->where('status', 'rejected')->count(),
        ];

        // Listado paginado de las solicitudes para la tabla
        $requestsList = (clone $query)
            ->with('user') // Relación con el usuario que hace la solicitud
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('reports.domain_requests', compact('startDate', 'endDate', 'stats', 'requestsList'));
    }
}
