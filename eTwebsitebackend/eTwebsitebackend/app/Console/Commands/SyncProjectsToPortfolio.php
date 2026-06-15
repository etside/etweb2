<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\PortfolioItem;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncProjectsToPortfolio extends Command
{
    protected $signature = 'sync:projects-to-portfolio';
    protected $description = 'Sync all active projects to portfolio items';

    public function handle()
    {
        $projects = Project::where('is_active', true)->get();
        
        $this->info("Found {$projects->count()} active projects");
        
        foreach ($projects as $project) {
            PortfolioItem::updateOrCreate(
                ['title' => $project->name],
                [
                    'slug' => Str::slug($project->name),
                    'description' => $project->description,
                    'image_url' => $project->cover_image,
                    'logo_url' => $project->logo_url,
                    'client_name' => $project->name,
                    'category' => $project->category ?? 'Web Development',
                    'external_link' => $project->url,
                    'featured' => false,
                    'sort_order' => $project->display_order ?? 0,
                ]
            );
            $this->line("✓ Synced: {$project->name}");
        }
        
        $this->info("\nPortfolio sync complete!");
    }
}
