<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Validator;
use Response;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        $postRequest = UpdatePostRequest::collection(Post::where('user_id',User::user()->id)->orderBy('id','DESC')->paginate(10));
        return $this->success($postRequest);
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

    //check ctegory validation

    public function checkCategory(Request $request){
        $validators = Validator::make($request->all(),[
            'category'=>'required'
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
            //return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
            return $this->failure('');
        }else{
            $post=new post();
            $post->title=$request->title;
            $post->user_id=User::user()->id;
            $post->category_id=$request->category;
            $post->content=$request->content;
            //call helper
            if($request->has('image')){
                foreach($request->image as $image){
                    $post->image=uploadImage($image);
                }
            }
            
            $post->save();
            //return Response::json(['success'=>'post created successfully !']);
            return $this->success($post,'post created successfully !');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if(Post::where('id',$id)->first()){
        if(Post::find($id)){
            
            return new UpdatePostRequest(Post::findOrFail($id));
        }else{
            //return Response::json(['error'=>'post not found!']);
            return $this->success(Post::class,'post created successfully !');
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
            // $post=Post::where('id',$request->id)->where('author_id',User::user()->id)->first();
            $post =  Post::find($id);
            dd($post->tag);
            if($post){
                $post->title=$request->title;
                $post->user_id=User::user()->id;
                $post->category_id=$request->category;
                $post->content=$request->content;
                if($request->has('image')){
                    foreach($request->image as $image){
                        $post->image=uploadImage($image);
                    }
                }
                $post->save();
                // return Response::json(['success'=>'post updated successfully !']);
                return $this->success(Post::class,'post updated successfully !');
            }else{
                // return Response::json(['error'=>'post not found !']);
                return $this->failure('post not found !');
            }    
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        // $post=Post::where('id',$request->id)->where('user_id',User::user()->id)->first();
        $post =  Post::find($id);
        dd($post->tag);
            if($post){
                $post->delete();
                // return Response::json(['success'=>'post removed successfully !']);
                return $this->success(Post::class,'post removed successfully !');

            }else{
                // return Response::json(['error'=>'post not found!']);
                return $this->failure('post not found !');
                
            }
    }
}
