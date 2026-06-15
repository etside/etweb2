<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\PortfolioItem;
use Illuminate\Support\Str;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $this->syncToPortfolio($project);
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $this->syncToPortfolio($project);
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        // Delete associated portfolio item
        PortfolioItem::where('title', $project->name)->delete();
    }

    /**
     * Sync Project to PortfolioItem
     */
    private function syncToPortfolio(Project $project): void
    {
        // Only sync active projects
        if (!$project->is_active) {
            // Delete portfolio item if project becomes inactive
            PortfolioItem::where('title', $project->name)->delete();
            return;
        }

        // Create or update portfolio item
        PortfolioItem::updateOrCreate(
            ['title' => $project->name],
            [
                'slug' => Str::slug($project->name),
                'description' => $project->description ?? 'Project by engineersTech',
                'image_url' => $project->cover_image, // Can be null now
                'logo_url' => $project->logo_url,
                'client_name' => $project->name,
                'category' => $project->category ?? 'Web Development',
                'external_link' => $project->url,
                'featured' => false,
                'sort_order' => $project->display_order ?? 0,
            ]
        );
    }
}
