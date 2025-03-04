<?php

namespace App\Models;

use App\Enum\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    use HasFactory;

    protected $perPage = 20;

    protected $fillable = ['name', 'status'];

    protected $hidden = ['pivot'];

    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributeValues(): MorphMany
    {
        return $this->morphMany(AttributeValue::class, 'entity');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when($filters['filters'] ?? null, function (Builder $query, $filters) {
            foreach ($filters as $field => $value) {
                if (in_array($field, ['name', 'status'])) {
                    $query->whereLike($field, $value);
                }
            }
        })->when($filters['eav_filters'] ?? null, function (Builder $query, $eavFilters) {
            foreach ($eavFilters as $attributeName => $value) {
                $query->whereHas('attributeValues', function (Builder $q) use ($attributeName, $value) {
                    $q->whereHas('attribute', function (Builder $q) use ($attributeName) {
                        $q->where('name', $attributeName);
                    })->where('value', $value);
                });
            }
        });
    }
}
