<?php

namespace App\Http\Controllers;

use App\Exports\AdditionsExport;
use App\Services\MathService;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class MathController extends Controller
{
    protected $mathService;

    public function __construct(MathService $mathService)
    {
        $this->mathService = $mathService;
    }

    public function export()
    {
        $filePath = $this->mathService->exportToCsv(5, 5, 3);
        return Response::download($filePath);
    }
}
