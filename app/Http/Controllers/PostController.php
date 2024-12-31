<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        
       
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //validate
         $request->validate([
            'title'=>['required','max:255'],
             'body'=>['required'],
             'image'=>['nullable','file','max:4000','mimes:webp,png,jpg']
        ]);

        //store img if exists
        $path=null;
        if($request->hasFile('image')){
            $path=Storage::disk('public')->put('posts_images',$request->image);
         
        }

        //create post
       Auth::user()->posts()->create([
       'title'=> $request->title,
       'body'=> $request->body,
       'image'=> $path
       ]);

        //redirect to dashboard
       return back()->with('success','Your post was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify', $post);

        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        
        //update post
        $post->update($fields);
        //redirect back to dashboard
        return redirect()->route('dashboard')->with('success','Your post was updated');
    }

        
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);

        $post->delete();

        return back()->with('delete','Your post was deleted');
         }
}
