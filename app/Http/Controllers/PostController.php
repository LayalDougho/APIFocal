<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Validator;
use Response;
use Illuminate\Validation\Rule;


class PostCpontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UpdatePostRequest::collection();
    }

    //check title validation

    public function checkTitle(Request $request){
        $validators = Validator::make($request->all(),[
            'title'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }
    //check content validation
    public function checkContent(Request $request){
        $validators = Validator::make($request->all(),[
            'content'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }



    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators=Validator::make($request->all(),[
            'title'=>'required',
            'category'=>'required',
            'content'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $post=new post();
            $post->title=$request->title;
            $post->user_id=User::user()->id;
            $post->category_id=$request->category;
            $post->content=$request->content;
            $post->save();
            return Response::json(['success'=>'post created successfully !']);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Post::where('id',$id)->first()){
            return new UpdatePostRequest(Post::findOrFail($id));
        }else{
            return Response::json(['error'=>'post not found!']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validators=Validator::make($request->all(),[
            'title'=>'required',
            'category'=>'required',
            'content'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $post=Post::where('id',$request->id)->where('author_id',User::user()->id)->first();
            if($post){
                $post->title=$request->title;
                $post->user_id=User::user()->id;
                $post->category_id=$request->category;
                $post->content=$request->content;
                $post->save();
                return Response::json(['success'=>'post updated successfully !']);
            }else{
                return Response::json(['error'=>'post not found !']);
            }    
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $post=Post::where('id',$request->id)->where('user_id',User::user()->id)->first();
            if($post){
                $post->delete();
                return Response::json(['success'=>'post removed successfully !']);
            }else{
                return Response::json(['error'=>'post not found!']);
            }
    }
}
