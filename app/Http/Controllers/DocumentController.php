<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

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
}
