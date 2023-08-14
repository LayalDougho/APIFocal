<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Validation\Rule;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UpdateCategoryRequest::collection(Category::orderBy('id','DESC')->paginate(10));
    }
    public function checkName(Request $request){
        $validators = Validator::make($request->all(),[
            'name'=>'required|unique:categories',
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators=Validator::make($request->all(),[
            'name'=>'required|unique:categories'
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $category=new Category();
            $category->name=$request->name;
            $category->save();
            return Response::json(['success'=>'Category created successfully !']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Category::where('id',$id)->first()){
            return new UpdateCategoryRequest(Category::findOrFail($id));
        }else{
            return Response::json(['error'=>'Category not found!']);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function checkEditName(Request $request){
        $validators = Validator::make($request->all(),[
            'name'=>['required',Rule::unique('categories')->ignore($request->id)]
        ]);
        return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
    }

    public function update(Request $request, string $id)
    {
        $validators=Validator::make($request->all(),[
            'name'=>['required',Rule::unique('categories')->ignore($request->id)]
        ]);
        if($validators->fails()){
            return Response::json(['errors'=>$validators->getMessageBag()->toArray()]);
        }else{
            $category=Category::findOrFail($request->id);
            $category->name=$request->name;
            $category->save();
            return Response::json(['success'=>'Category updated successfully !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,string $id)
    {
        $category=Category::where('id',$request->id)->first();
            if($category){
                $category->delete();
                return Response::json(['success'=>'Category removed successfully !']);
            }else{
                return Response::json(['error'=>'Category not found!']);
            }
    }
}
