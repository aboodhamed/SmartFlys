<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator as PaginationPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          PaginationPaginator::useBootstrapFive();

        //when do a migration you have to commment all of these lines
        
        $entities = Cache::remember('global_entities', 60 * 60, function () {
            return [
                // 'country' => \App\Models\Entity::where('EntityName', 'country')->first()?->EntityID,
                // 'province' => \App\Models\Entity::where('EntityName', 'province')->first()?->EntityID,
                // 'category' => \App\Models\Entity::where('EntityName', 'category')->first()?->EntityID,
                // 'evaluation-authority' => \App\Models\Entity::where('EntityName', 'evaluation-authority')->first()?->EntityID,
                // 'sukuk-type' => \App\Models\Entity::where('EntityName', 'sukuk-type')->first()?->EntityID,
                // 'account' => \App\Models\Entity::where('EntityName', 'account')->first()?->EntityID,
                // 'dashboard' => \App\Models\Entity::where('EntityName', 'dashboard')->first()?->EntityID,
                // 'sukuk' => \App\Models\Entity::where('EntityName', 'sukuk')->first()?->EntityID,
                // 'evaluations' => \App\Models\Entity::where('EntityName', 'evaluations')->first()?->EntityID,
                // 'system-module' => \App\Models\Entity::where('EntityName', 'system-module')->first()?->EntityID,
                // 'role-rights' => \App\Models\Entity::where('EntityName', 'role-rights')->first()?->EntityID,
                // 'users' => \App\Models\Entity::where('EntityName', 'users')->first()?->EntityID,
                // 'sessions' => \App\Models\Entity::where('EntityName', 'sessions')->first()?->EntityID,
                // 'city' => \App\Models\Entity::where('EntityName', 'city')->first()?->EntityID,
                // 'security' => \App\Models\Entity::where('EntityName', 'security')->first()?->EntityID,
            ];
        });
    
        $actions = Cache::remember('global_actions', 60 * 60, function () {
            return [
                // 'edit' => \App\Models\Action::where('ActionName', 'edit')->first()?->ActionID,
                // 'show' => \App\Models\Action::where('ActionName', 'show')->first()?->ActionID,
                // 'delete' => \App\Models\Action::where('ActionName', 'delete')->first()?->ActionID,
                // 'evaluate' => \App\Models\Action::where('ActionName', 'evaluate')->first()?->ActionID,
                // 'create' => \App\Models\Action::where('ActionName', 'create')->first()?->ActionID,
                // 'import' => \App\Models\Action::where('ActionName', 'import')->first()?->ActionID,
                // 'export' => \App\Models\Action::where('ActionName', 'export')->first()?->ActionID,
                // 'approve' => \App\Models\Action::where('ActionName', 'approve')->first()?->ActionID,
                // 'reject' => \App\Models\Action::where('ActionName', 'reject')->first()?->ActionID,
            ];
        });
    
        View::share('entities', $entities);
        View::share('actions', $actions);

    }
}
