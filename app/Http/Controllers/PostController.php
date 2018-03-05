<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Feedback;
use App\Post;
use App\Http\Requests\CheckPost;
use Redirect;
use Response;
use File;

class PostController extends Controller
{
    private function getFileName($file)
    {
    	return str_random(32).'.'.$file->extension();
    }

    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    public function show($id)
    {
        $post = Post::with(['categories', 'feedbacks'])
                    ->findOrFail($id);
        $feedbacks = $post->feedbacks;

        return view('post.show', compact('post', 'feedbacks'));
    }

    public function edit($id)
    {
        $post = Post::with('categories')
                    ->findOrFail($id);

        $categories = Category::get();

        return view('post.edit', compact('post', 'categories'));
    }

    public function get()
    {
        $posts = Post::get();
        return view('post.posts', compact('posts'));
    }

    public function store(CheckPost $request)
    {
        if ($request->categories)
            foreach ($request->categories as $category) {
                $categories[] = Category::findOrFail($category);
            }

        $post = New Post($request->only('name', 'content'));
        
    	if (isset($request->image)) {
    		$filename = $this->getFileName($request->image);
    		$request->image->move(base_path('public/images'), $filename);
    		$post->image = '/images/'.$filename;
    	}

    	$post->save();

        if ($request->categories)
        $post->categories()
            ->saveMany($categories);

    	return Redirect::route('showPost', $post->id);
    }

    public function update(Post $post, Request $request)
    {
        $categories = [];

        if ($request->categories)
            foreach ($request->categories as $category) {
                $categories[] = Category::findOrFail($category);
            }
        
        if (isset($request->image) && $request->image != $post->image) {
            $filename = $this->getFileName($request->image);
            $request->image->move(base_path('/public/images/'), $filename);

            File::delete(base_path('/public'.$post->image));
            $post->image = '/images/'.$filename;
        }

        $post->name = $request->name;
        $post->content = $request->content;

        $post->save();

        if ($request->categories) {
            $post->categories()->detach();    

            $post->categories()
                ->saveMany($categories);
        }
        else $post->categories()->detach();


        return Redirect::route('showPost', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach(); // remove all
        $post->feedbacks()->delete();  // relationships

        // remove image
        File::delete(base_path('/public'.$post->image));

        $post->delete();

        return Redirect::route('posts');
    }

    public function addFeedback(Post $post, Request $request)
    {   
        $this->validate($request, [
            'content' => 'required|max:255',
            'author' => 'required|max:64'
        ]);

        $post = Post::findOrFail($id);
        
        $feedback = New Feedback();
        $feedback->content = $request->content;
        $feedback->author = $request->author;

        $post->feedbacks()->save($feedback);

        return Response::json($feedback);
    }

}
