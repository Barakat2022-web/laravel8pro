<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getAllPost()
    {
        //  $posts=DB::table('posts')->get();
        $posts=Post::orderBy('id','DESC')->get();

        return view('posts',compact('posts'));
    }

    //function create post
    public function addPost()
    {

        return view('add-post');
    }

    public function addPostSubmit(Request $request)
    {
         /* DB::table('posts')->insert([
             'title'=>$request->title,
             'body'=>$request->body
         ]);
         */
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
         return back()->with('post_created','post has been created successfully');
    }

    public function getPostById($id)
    {
       // $post=DB::table('posts')->where('id',$id)->first();
        $post=Post::where('id',$id)->first();
        return view('single-post',compact('post'));
    }

    public function DeletePost($id)
    {
        //$post=DB::table('posts')->where('id',$id)->delete();
        $post=Post::where('id',$id)->delete();
        return back()->with('posts-deleted','Post has been deleted successfully');

    }

    public function editPost($id)
    {
            //$post=DB::table('posts')->where('id',$id)->first();
            $post=Post::find($id);

            if(!$post)
            {
                return redirect()->route('posts')->with('error','the post not exist');
            }
            return view('edit-post',compact('post'));
    }

    public function UpdatePost(Request $request)
    {
           /*  DB::table('posts')->where('id',$request->id)->update([
               'title'=>$request->title,
               'body'=>$request->body
           ]); */



            Post::where('id',$request->id)->update([
            'title'=>$request->title,
            'body'=>$request->body
           ]);

            return redirect()->route('posts')->with('post_updated','post has been updated successfully');
    }

    //Add comment related to post
    public function addComment($id)
    {
       $post=Post::find($id);
        $comment=new Comment();
         $comment->comment="This is thirds comment";

            $post->comments()->save($comment);

        return "Comment has been posted";



    }

    //return the comment related to post
    public function getCommentsByPost($id)
    {
       //$comment=Comment::find($id);

       //return comment related to this post

       return $post=Post::find($id)->comments;


    }

  


}
