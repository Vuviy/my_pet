<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostTranslation;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {





//        $pos = Post::all();
//
//
//        $locales = ['uk', 'en'];
//        foreach ($locales as $loc)
//        {
//            foreach ($pos as $po)
//            {
//                $rr = [
//                    'post_id' => $po->id,
//                    'locale' => $loc,
//                    'title' => fake()->words(4, true),
//                    'short_text' => fake()->words(15, true),
//                    'content' => fake()->text(300),
//                ];
//
//                dd($rr);
//
//                $potr = new PostTranslation();
//                $potr->fill([
//                    'post_id' => $po->id,
//                    'locale' => 'uk',
//                    'title' => fake('uk_UA')->name . fake('uk_UA')->name,
//                    'short_text' => fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name,
//                    'content' => fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name . fake('uk_UA')->name,
//                ])->save();
//            }
//        }



        $posts = Post::query()->orderBy('id', 'DESC')->paginate(3);
        return view('blog::index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        $post = Post::findOrFail($id);

        return view('blog::show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
