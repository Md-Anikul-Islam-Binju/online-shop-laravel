<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $product=DB::table('products')
                       ->join('categories','products.category_id','categories.id')
                       ->join('brands','products.brand_id','brands.id')
                       ->select('products.*','categories.category_name','brands.brand_name')
                       ->get();
        return view('admin.product.index',compact('product'));
    }

    public function create()
    {
    	  $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.create',compact('category','brand'));
    }

    public function GetSubcat($category_id)
    {
       $subcat = DB::table('subcategories')->where('category_id',$category_id)->get();
       return json_encode($subcat);
       //return view('admin.product.create',compact('category','brand'));
    }

    public function store(Request $request)
    {

        $data=array();
        
        $data['product_name']=$request->product_name; 
        $data['product_code']=$request->product_code; 
        $data['product_quantity']=$request->product_quantity;
        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;  
        $data['brand_id']=$request->brand_id;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['selling_price']=$request->selling_price;  
        $data['product_details']=$request->product_details;                        
        $data['video_link']=$request->video_link;         
        $data['main_slider']=$request->main_slider; 
        $data['hot_deal']=$request->hot_deal; 
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend;
        $data['buyone_getone']=$request->buyone_getone;   
        $data['mid_slider']=$request->mid_slider; 
        $data['hot_new']=$request->hot_new;
        //$data['status']=$request->status;          
        $data['status']=1; 




        $image_one=$request->image_one;
        $image_two=$request->image_two;                  
        $image_three=$request->image_three;



          if($image_one && $image_two && $image_three){

          $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
          Image::make($image_one)->resize(230,300)->save('public/media/product/'.$image_one_name);
          $data['image_one']='public/media/product/'.$image_one_name;

          $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
          Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
          $data['image_two']='public/media/product/'.$image_two_name; 

          $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
          Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
          $data['image_three']='public/media/product/'.$image_three_name; 
                
                $product=DB::table('products')
                          ->insert($data);
                    $notification=array(
                     'messege'=>'Successfully Product Inserted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);   
        }         


    }

    public function Inactive($id)
    {   
      DB::table('products')->where('id',$id)->update(['status'=> 0]);

      $notification=array(
                     'messege'=>'Successfully Product Inactive',
                     'alert-type'=>'success'
                    );
      return Redirect()->back()->with($notification);

    }

    public function Active($id)
    {
      DB::table('products')->where('id',$id)->update(['status'=> 1]);

      $notification=array(
                     'messege'=>'Successfully Product Active',
                     'alert-type'=>'success'
                    );
      return Redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
      $data=DB::table('products')->where('id',$id)->first();
      $image1=$data->image_one;
      $image2=$data->image_two;
      $image3=$data->image_three;
      unlink($image1);
      unlink($image2);
      unlink($image3);

      DB::table('products')->where('id',$id)->delete();
      $notification=array(
                        'messege'=>'Product Delete Success',
                        'alert-type'=>'success'
                         );
        return Redirect()->back()->with($notification); 
    }


    public function ViewProduct($id)
    {
        $product=DB::table('products')
                       ->join('categories','products.category_id','categories.id')
                       ->join('brands','products.brand_id','brands.id')
                       ->join('subcategories','products.subcategory_id','subcategories.id')
                       ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name')
                       ->where('products.id',$id)
                       ->first();
       
        return view('admin.product.show',compact('product'));

        //return response()->json($product); 
    }

    public function EditProduct($id)
    {   

        $product=DB::table('products')->where('id',$id)->first();
        return view('admin.product.edit',compact('product')); 
    }

    public function UpdateProduct(Request $request,$id)
    {
        

        $data=array();
        
        $data['product_name']=$request->product_name; 
        $data['product_code']=$request->product_code; 
        $data['product_quantity']=$request->product_quantity;
        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;  
        $data['brand_id']=$request->brand_id;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['selling_price']=$request->selling_price;
        $data['discount_price']=$request->discount_price;   
        $data['product_details']=$request->product_details;                        
        $data['video_link']=$request->video_link;         
        $data['main_slider']=$request->main_slider; 
        $data['hot_deal']=$request->hot_deal; 
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend;
        $data['buyone_getone']=$request->buyone_getone;    
        $data['mid_slider']=$request->mid_slider; 
        $data['hot_new']=$request->hot_new;
        //$data['status']=$request->status;          
        $data['status']=1;


        $update = DB::table('products')->where('id',$id)->update($data);

         if ($update) {
            $notification=array(
                        'messege'=>'Products Update Success',
                        'alert-type'=>'success'
                         );
            return Redirect()->route('all.product')->with($notification);
        }
        else
        {

            $notification=array(
                        'messege'=>'Products Do Not Update',
                        'alert-type'=>'success'
                         );
            return Redirect()->route('all.product')->with($notification);
        } 
    }
}
