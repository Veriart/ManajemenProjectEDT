<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use App\Models\Task;
use Filament\Resources\Pages\Page;

class ProjectTimeline extends Page
{
    protected static string $resource = ProjectResource::class;

    protected static string $view = 'filament.resources.project-resource.pages.project-timeline';

    public $record;

    public function mount($record): void
    {
        $this->record = Project::findOrFail($record);
    }
}