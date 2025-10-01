<?php

namespace App\Http\Controllers;

use App\Models\Proforma;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function financial(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $query = Proforma::query();
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        $total = (clone $query)->sum('total');
        $byStatus = (clone $query)
            ->selectRaw('status, COUNT(*) as count, SUM(total) as amount')
            ->groupBy('status')
            ->get();

        return view('reports.financial', [
            'from' => $from,
            'to' => $to,
            'total' => $total,
            'byStatus' => $byStatus,
        ]);
    }
}



