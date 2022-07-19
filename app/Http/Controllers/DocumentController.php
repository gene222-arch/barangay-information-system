<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $docs = Document::query()
            ->when(
                $request->has('document_type') && 
                $request->filled('document_type'), 
                fn ($query) => $query->where('type', $request->document_type)
            )
            ->with('user')
            ->latest()
            ->get();

        return view('pages.documents.index', [  
            'documents' => $docs,
            'docType' => $request->query('document_type', ''),
        ]);
    }

    public function monthlyRevenues()
    {
        DB::statement("SET SQL_MODE = ''");

        $docs = Document::query()
            ->selectRaw('CONCAT(MONTHNAME(created_at), " ", YEAR(created_at)) as date_,SUM(cost) as revenue')
            ->groupByRaw('CONCAT(MONTH(created_at), YEAR(created_at))')
            ->orderByDesc('date_')
            ->get();

        return view('pages.documents.monthly-revenues', [  
            'documents' => $docs,
        ]);
    }
}
