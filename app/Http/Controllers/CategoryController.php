<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Feedback;
use App\Post;
use Redirect;
use Response;
use App\Http\Requests\CheckCategory;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::with('posts')
            ->findOrFail($id);
        $feedbacks = $category->feedbacks;
        return view('category.show', compact('category', 'feedbacks'));
    } 

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function get()
    {
        $categories = Category::get();
        return view('category.categories', compact('categories'));
    }

    public function store(CheckCategory $request)
    {
    	$category = New Category($request->all());
    	$category->save();

    	return Redirect::route('showCategory', $category->id);
    }

    public function update(Category $category, CheckCategory $request)
    {
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return Redirect::route('showCategory', $category->id);
    }

    public function destroy(Category $category)
    {   
        $category->posts()->detach();     // remove all
        $category->feedbacks()->delete(); // relationships

        $category->delete();

        return Redirect::route('categories');
    }

    public function addFeedback(Category $category, Request $request)
    {   
        $this->validate($request, [
            'content' => 'required|max:255',
            'author' => 'required|max:64'
        ]);
     
        $feedback = New Feedback();
        $feedback->content = $request->content;
        $feedback->author = $request->author;

        $category->feedbacks()->save($feedback);

        return Response::json($feedback);
    }

}
