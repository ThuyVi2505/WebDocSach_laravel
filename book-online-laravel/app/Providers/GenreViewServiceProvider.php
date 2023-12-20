<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use App\Models\{Genre,Book,Chapter};
class GenreViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $all_book = Book::withCount(['chapter' => function ($query) {
                $query->where('chapter_status', 1)->orderBy('chapter_number', 'desc')->latest();
            }])->where('book_status', 1)->orderByRaw('(SELECT MAX(chapter.created_at) FROM chapter WHERE chapter.book_id = book.id) desc')->get();
            $path = public_path()."/json_book/";
            if(!is_dir($path)){
                mkdir($path,0777,true);
            }
            File::put($path.'book.json',json_encode($all_book));
            $genre = Genre::orderBy('genre_name', 'asc')->where('genre_status', 1)->get();
            $view->with('genre', $genre);
        });
        //
    }
}
