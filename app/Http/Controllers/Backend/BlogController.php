<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use App\Models\BlogPost;
use Image;

class BlogController extends Controller
{
    public function BlogCategory(){
    	$blogcategory = BlogPostCategory::latest()->get();
    	return view('backend.blog.category.category_view',compact('blogcategory'));
    } // END METHOD
    public function BlogCategoryStore(Request $request){
    	 $request->validate([
        'blog_category_name_en' => 'required',
        'blog_category_name_hin' => 'required',
    	],[
           'blog_category_name_en.required' => 'Input Blog Category English Name',
           'blog_category_name_hin.required' => 'Input Blog Category Hindi Name',
    	]);
    	BlogPostCategory::insert([
        'blog_category_name_en' => $request->blog_category_name_en,
        'blog_category_name_hin' => $request->blog_category_name_hin,
        'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)) ,
        'blog_category_slug_hin' => str_replace(' ', '-', $request->blog_category_name_hin),
        'created_at' => Carbon::now(),
    	]);
    	 $notification = array(
        'message' => 'Blog Category Inserted Successfully',
        'alert-type' => 'success'
         );
        return redirect()->back()->with( $notification );

    } // END METHOD
    public function BlogCategoryEdit($id){
    	$blogcategory = BlogPostCategory::findOrFail($id);
    	return view('backend.blog.category.category_edit',compact('blogcategory'));

    } // END METHOD

     public function BlogCategoryUpdate(Request $request){
    	$blogcar_id = $request->id;
    	BlogPostCategory::findOrFail($blogcar_id)->update([
        'blog_category_name_en' => $request->blog_category_name_en,
        'blog_category_name_hin' => $request->blog_category_name_hin,
        'blog_category_slug_en' => strtolower(str_replace(' ', '-', $request->blog_category_name_en)) ,
        'blog_category_slug_hin' => str_replace(' ', '-', $request->blog_category_name_hin),
        'created_at' => Carbon::now(),
    	]);
    	 $notification = array(
        'message' => 'Blog Category Updated Successfully',
        'alert-type' => 'info'
         );
        return redirect()->route('blog.category')->with( $notification );

    } // END METHOD
      public function BlogCategoryDelete($id){
     BlogPostCategory::findOrFail($id)->delete();
     $notification = array(
        'message' => 'Blog Category Deleted Successfully',
        'alert-type' => 'success'
         );
        return redirect()->back()->with( $notification );
    }
    ///////////////// BLog Post All Method /////////////
    public function AddBlogPost(){
            $blogcategory = BlogPostCategory::latest()->get();
            $blogpost = BlogPost::latest()->get();
            return view('backend.blog.post.post_view',compact('blogpost','blogcategory'));
    }// END METHOD
     public function ListBlogPost(){
      $blogpost = BlogPost::with('category')->latest()->get();
      return view('backend.blog.post.post_list',compact('blogpost'));
  } // END METHOD

   public function BlogPostStore(Request $request){

    $request->validate([
            'post_title_en' => 'required',
            'post_title_hin' => 'required',
            'post_image' => 'required',
        ],[
            'post_title_en.required' => 'Input Post Title English Name',
            'post_title_hin.required' => 'Input Post Title Hindi Name',
        ]);

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;

    BlogPost::insert([
        'category_id' => $request->category_id,
        'post_title_en' => $request->post_title_en,
        'post_title_hin' => $request->post_title_hin,
        'post_slug_en' => strtolower(str_replace(' ', '-',$request->post_title_en)),
        'post_slug_hin' => str_replace(' ', '-',$request->post_title_hin),
        'post_image' => $save_url,
        'post_details_en' => $request->post_details_en,
        'post_details_hin' => $request->post_details_hin,
        'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('list.post')->with($notification);

  } // end mehtod 
  public function PostEdit($id){
    $blogcategories = BlogPostCategory::orderBy('blog_category_name_en','ASC')->get();
    $blogpost = BlogPost::findOrFail($id);
    return view('backend.blog.post.post_edit',compact('blogpost','blogcategories'));
  }
  public function PostUpdate(Request $request){
    $post_id = $request->id;
    BlogPost::findOrFail($post_id)->update([       
       'category_id' => $request->category_id,
        'post_title_en' => $request->post_title_en,
        'post_title_hin' => $request->post_title_hin,
        'post_slug_en' => strtolower(str_replace(' ', '-',$request->post_title_en)),
        'post_slug_hin' => str_replace(' ', '-',$request->post_title_hin),
        'post_details_en' => $request->post_details_en,
        'post_details_hin' => $request->post_details_hin,
        ]);
         $notification = array(
        'message' => 'Blog Post Updated Successfully',
        'alert-type' => 'info'
         );
        return redirect()->route('list.post')->with( $notification );
  }// END METHOD

   public function PostImageUpdate(Request $request){
    $post_id = $request->id;
    $oldImage = $request->old_img;
    unlink($oldImage);

    $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;

        BlogPost::findOrFail($post_id)->update([
            'post_image' => $save_url,
            'updated_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Post Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

     } // end method
     public function PostDelete($id){
            $post = BlogPost::findOrFail($id);
        unlink($post->post_image);
        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
     }
}
