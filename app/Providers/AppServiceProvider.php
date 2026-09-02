<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // O modelo padrão de paginação do Laravel usa Tailwind; como aqui o CSS
        // é próprio, trocamos pelo modelo simples (uma lista <ul class="pagination">).
        Paginator::defaultView('pagination::default');
    }
}
