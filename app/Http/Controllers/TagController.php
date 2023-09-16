<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTagsRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Validator;
use Response;
class TagController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UpdateTagsRequest::collection(Tag::where('user_id',User::user()->id)->orderBy('id','DESC')->paginate(10));
    }

       // check tag validation
       public function checkTag(Request $request){
        $validators = Validator::make($request->all(),[
            'tag'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    // check post validation
    public function checkPost(Request $request){
        $validators = Validator::make($request->all(),[
            'post'=>'required'
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators=Validator::make($request->all(),[
            'tag'=>'required',
            'post'=>'required'
        ]);
        if($validators->fails()){
            // return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
            return $this->failure('');

        }else{
            $tag = Tag::all();
            dd($tag->post);
            $tag->tag=$request->tag;
            $tag->user_id=User::user()->id;
            $tag->post_id=$request->post;
            $tag->save();
            // return Response::json(['success'=>'tag created successfully !']);
            return $this->success($tag,'tag created successfully !');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Tag::find($id)){
            return new UpdateTagsRequest(Tag::findOrFail($id));
        }else{
            // return Response::json(['error'=>'Tag not found!']);
            return $this->failure('Tag not found!');

        }      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validators=Validator::make($request->all(),[
            'tag'=>'required',
            'post'=>'required'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            // $tag=tag::where('id',$request->id)->where('user_id',User::user()->id)->first();
            $tag = Tag::find($id);
            dd($tag->post);
            if($tag){
                $tag->tag=$request->tag;
                $tag->user_id=User::user()->id;
                $tag->post_id=$request->post;
                $tag->save();
                // return Response::json(['success'=>'tag updated successfully !']);
            return $this->success($tag,'tag updated successfully !');

            }else{
                // return Response::json(['error'=>'tag not found !']);
                return $this->failure('Tag not found!');

            }            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        // $tag=tag::where('id',$request->id)->where('user_id',User::user()->id)->first();
        $tag = Tag::find($id);
        dd($tag->post);
        if($tag){
            $tag->delete();
            // return Response::json(['success'=>'tag removed successfully !']);
            return $this->success($tag,'tag removed successfully !');

        }else{
            // return Response::json(['error'=>'tag not found!']);
            return $this->failure('Tag not found!');

        }
    }
}
