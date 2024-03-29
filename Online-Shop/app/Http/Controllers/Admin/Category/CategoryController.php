<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category()
    {
       $category=Category::all();
       return view('admin.category.category',compact('category'));
    }


    public function storecategory(Request $request)
    {
    	$validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:50',
        ]);


        // $data=array();
        // $data['category_name']=$request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();



        $notification=array(
                        'messege'=>'Category Inser Success',
                        'alert-type'=>'success'
                         );
        return Redirect()->back()->with($notification);
       
    }

    public function DeleteCategory($id)
    {
    	DB::table('categories')->where('id',$id)->delete();

    	$notification=array(
                        'messege'=>'Category Delete Success',
                        'alert-type'=>'success'
                         );
        return Redirect()->back()->with($notification);

    }


    public function EditCategory($id)
    {
    	$category = DB::table('categories')->where('id',$id)->first();
    	return view('admin.category.edit_category',compact('category'));

    }

    public function UpdateCategory(Request $request,$id)
    {

    	$validatedData = $request->validate([
        'category_name' => 'required|max:50',
        ]);






        $data=array();
        $data['category_name']=$request->category_name;
    	$update = DB::table('categories')->where('id',$id)->update($data);

    	if ($update) {
    		$notification=array(
                        'messege'=>'Category Update Success',
                        'alert-type'=>'success'
                         );
        return Redirect()->route('categories')->with($notification);
    	}
    	else
    	{

    		$notification=array(
                        'messege'=>'Category Do Not Update',
                        'alert-type'=>'success'
                         );
        return Redirect()->route('categories')->with($notification);

    	}

    	
    }
}
