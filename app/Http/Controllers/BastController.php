<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BastController extends Controller
{
    public function exportBast($id)
    {
        $project = Project::with(['thirdParty', 'tasks'])->findOrFail($id);
        
        $pdf = PDF::loadView('pdf.bast', compact('project'));
        
        return $pdf->download('BAST-' . $project->code . '.pdf');
    }
}