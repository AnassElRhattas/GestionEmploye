<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\WhatsAppAutomationService;
use App\Models\Employee;

class WhatsAppController extends Controller
{
    protected WhatsAppAutomationService $whatsappService;

    public function __construct(WhatsAppAutomationService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index(Request $request)
    {
        $serviceStatus = $this->whatsappService->getStatus();
        $isServiceAvailable = $this->whatsappService->isServiceAvailable();
        $isWhatsAppConnected = $this->whatsappService->isWhatsAppConnected();
        $qrCode = $this->whatsappService->getQRCode();
        $q = (string) $request->get('q', '');

        $employees = Employee::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nom', 'like', "%{$q}%")
                        ->orWhere('prenom', 'like', "%{$q}%")
                        ->orWhere('telephone', 'like', "%{$q}%")
                        ->orWhere('identifiant', 'like', "%{$q}%");
                });
            })
            ->orderBy('prenom')
            ->orderBy('nom')
            ->select(['id', 'nom', 'prenom', 'telephone', 'identifiant'])
            ->paginate(10)
            ->withQueryString();

        return view('whatsapp.index', compact(
            'serviceStatus',
            'isServiceAvailable',
            'isWhatsAppConnected',
            'qrCode',
            'employees',
            'q'
        ));
    }

    public function status()
    {
        $serviceStatus = $this->whatsappService->getStatus();
        return response()->json($serviceStatus);
    }

    public function qrcode()
    {
        $qr = $this->whatsappService->getQRCode();
        return response()->json([
            'success' => (bool) $qr,
            'qrCode' => $qr,
        ]);
    }

    public function sendToEmployee(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'message' => ['required', 'string'],
        ]);

        if (!$this->whatsappService->isServiceAvailable()) {
            return response()->json([
                'success' => false,
                'message' => "Le service WhatsApp n'est pas disponible",
            ], 503);
        }

        if (!$this->whatsappService->isWhatsAppConnected()) {
            return response()->json([
                'success' => false,
                'message' => "WhatsApp n'est pas connecté",
            ], 400);
        }

        $result = $this->whatsappService->sendMessage($employee->telephone, $validated['message']);
        return response()->json($result, $result['success'] ? 200 : 500);
    }

    public function sendBulk(Request $request)
    {
        $validated = $request->validate([
            'contacts' => ['required', 'array'],
            'contacts.*.employee_id' => ['nullable', 'integer', 'exists:employees,id'],
            'contacts.*.number' => ['nullable', 'string'],
            'contacts.*.message' => ['required', 'string'],
        ]);

        if (!$this->whatsappService->isServiceAvailable()) {
            return response()->json([
                'success' => false,
                'message' => "Le service WhatsApp n'est pas disponible",
            ], 503);
        }

        if (!$this->whatsappService->isWhatsAppConnected()) {
            return response()->json([
                'success' => false,
                'message' => "WhatsApp n'est pas connecté",
            ], 400);
        }

        $contacts = [];
        foreach ($validated['contacts'] as $item) {
            $number = $item['number'] ?? null;
            if (!$number && !empty($item['employee_id'])) {
                $emp = Employee::find($item['employee_id']);
                if ($emp) {
                    $number = $emp->telephone;
                }
            }
            if ($number) {
                $contacts[] = [
                    'number' => $number,
                    'message' => $item['message'],
                ];
            }
        }

        $result = $this->whatsappService->sendBulkMessages($contacts);
        return response()->json($result, !empty($result['success']) ? 200 : 500);
    }
}


