<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MCPLead extends Model
{
    protected $table = 'mcp_leads';

    protected $fillable = [
        'email',
        'name',
        'company',
        'phone',
        'service_interest',
        'budget_range',
        'conversation_summary',
        'platform_source',
        'status',
        'lead_score',
        'mcp_session_id',
        'last_contacted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_contacted_at' => 'datetime',
    ];

    /**
     * Get the contact submission associated with this lead
     */
    public function contactSubmission(): HasOne
    {
        return $this->hasOne(ContactSubmission::class, 'email', 'email');
    }

    /**
     * Scope to get new leads
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope to get leads by platform
     */
    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform_source', $platform);
    }

    /**
     * Get leads with high scores
     */
    public function scopeQualified($query, $threshold = 50)
    {
        return $query->where('lead_score', '>=', $threshold);
    }
}
