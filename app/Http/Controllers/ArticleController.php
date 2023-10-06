<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Contracts\Foundation\Application;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View|Factory|Application
    {
        $articles = Article::query()
            ->select(['id', 'title', 'thumbnail', 'created_at', 'user_id'])
            ->with(['user:id,name'])
            ->withCount('comments')
            ->latest()
            ->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return $this->form(new Article());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {

        Article::query()->create($request->validated());

        return redirect()->route('articles.index')->with('message', 'Статья добавленна');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View|Factory|Application
    {
        return $this->form($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();

        if($request->hasFile('thumbnail')){

            $data['thumbnail'] = $request->file('thumbnail')->store('images');

        }
        $article -> update($data);

        return redirect()->route('articles.index')->with('message', 'Статья отредактированна');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        
        return redirect()->route('articles.index')->with('message', 'Статья удалена');
    }

    private function form(Article $article): View|Factory|Application
    {
        $users = User::query()
            ->pluck('name', 'id')
            ->toArray(); 


        return view('articles.form', [
            'users' => $users,
            'article' => $article,
        ]);
    }
}
