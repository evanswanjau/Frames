<?php

namespace App\Http\Controllers;

use App\Category;
use App\ChildCategory;
use App\Color;
use App\Order;
use App\Partner;
use App\Product;
use App\ProductImage;
use App\ProductSpecification;
use App\Size;
use App\Staff;
use App\Subcategory;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function getDashboard()
    {
        $data['page_title'] = 'Dashboard';
        $data['totalProduct'] = Product::all()->count();
        $data['totalCategory'] = Category::all()->count();
        $data['totalSubCategory'] = Subcategory::all()->count();
        $data['totalChildCategory'] = ChildCategory::all()->count();
        $data['userProduct'] = Product::whereStaff_id(Auth::user()->id)->count();
        return view('staff.dashboard',$data);
    }
    public function getChangePass()
    {
        $data['page_title'] = "Change Password";
        return view('staff.change-password',$data);
    }
    public function postChangePass(Request $request)
    {
        $this->validate($request, [
            'current_password' =>'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $c_password = Auth::guard('staff')->user()->password;
            $c_id = Auth::guard('staff')->user()->id;

            $user = Staff::findOrFail($c_id);

            if(Hash::check($request->current_password, $c_password)){

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                session()->flash('message', 'Password Changes Successfully.');
                session()->flash('type','success');
                return redirect()->back();
            }else{
                session()->flash('message', 'Current Password Not Match');
                session()->flash('type','warning');
                return redirect()->back();
            }

        } catch (\PDOException $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type','warning');
            return redirect()->back();
        }

    }
    public function editProfile()
    {
        $data['page_title'] = "Edit Staff Profile";
        $data['admin'] = Staff::findOrFail(Auth::user()->id);
        return view('staff.edit-profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $admin = Staff::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:staff,email,'.$admin->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(215,215)->save($location);
            if ($admin->image != 'admin-default.png'){
                $path = './assets/images/'.$admin->image;
                File::delete($path);
            }
            $in['image'] = $filename;
        }
        $admin->fill($in)->save();
        session()->flash('message','Profile Updated Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function addProduct()
    {
        $data['page_title'] = "Add New Product";
        $data['category'] = Category::all();
        $data['partner'] = Partner::all();
        $data['size'] = Size::all();
        $data['color'] = Color::all();
        $data['tags'] = Tag::all();
        return view('staff.product-create',$data);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products,name',
            'sku' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'current_price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'tags' => 'array',
            'color' => 'nullable|array',
            'size' => 'nullable|array',
            "gallery_image.*" => 'required|mimes:png,jpg,jpeg,gif',
        ]);

        $in = Input::except('_method','_token','specification','gallery_image','color','size','tags');
        $in['slug'] = str_slug($request->name);
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = $in['slug'].'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/product/' . $filename3;
            Image::make($image3)->resize(780,1000)->save($location);
            $in['image'] = $filename3;
        }
        $in['staff_id'] = Auth::user()->id;
        $product = Product::create($in);

        if ($in['color_status'] == 1){
            $product->colors()->sync($request->color, false);
        }
        if ($in['size_status'] == 1){
            $product->sizes()->sync($request->size, false);
        }

        $tagID = [];
        foreach ($request->tags as $t){
            $tCheck = Tag::whereId($t)->count();
            if ($tCheck == 0){
                $tt['name'] = $t;
                $tID = Tag::create($tt);
                $tagID[] = $tID->id;
            }else{
                $tag = Tag::whereId($t)->first();
                $tagID[] = $tag->id;
            }
        }

        $product->tags()->sync($tagID, false);

        if($request->hasFile('gallery_image')){
            $image4 = $request->file('gallery_image');
            foreach ($image4 as $key => $i)
            {
                $filename4 = $product->slug.'_'.$key.'.'.$i->getClientOriginalExtension();
                $location = 'assets/images/product/' . $filename4;
                Image::make($i)->resize(780,1000)->save($location);
                $image['name'] = $filename4;
                $image['product_id'] = $product->id;
                ProductImage::create($image);
            }
        }
        if ($request->specification != null){
            foreach ($request->specification as $des){
                if (!empty($des)){
                    $pp['product_id'] = $product->id;
                    $pp['specification'] = trim($des);
                    ProductSpecification::create($pp);
                }
            }
        }
        session()->flash('message','Product Store Successfully Completed.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function allProduct()
    {
        $data['page_title'] = "All Product";
        $data['products'] = Product::whereStaff_id(Auth::user()->id)->orderBy('id','desc')->get();
        return view('staff.product-all',$data);
    }
    public function editProduct($id)
    {
        $data['page_title'] = 'Edit Product';
        $data['product'] = Product::findOrFail($id);
        $data['category'] = Category::get();
        $data['subcategory'] = Subcategory::whereCategory_id($data['product']->category_id)->get();
        $data['childcategory'] = ChildCategory::wheresubcategory_id($data['product']->subcategory_id)->get();
        $data['productImage'] = ProductImage::whereProduct_id($id)->get();
        $data['productSpecification'] = ProductSpecification::whereProduct_id($id)->get();
        $data['partner'] = Partner::all();
        $data['size'] = Size::whereCategory_id($data['product']->category_id)->get();
        $data['color'] = Color::whereCategory_id($data['product']->category_id)->get();
        $data['tags'] = Tag::all();
        return view('staff.product-edit',$data);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products,name,'.$product->id,
            'sku' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'current_price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'tags' => 'array',
            'color' => 'nullable|array',
            'size' => 'nullable|array',
            "gallery_image.*" => 'mimes:png,jpg,jpeg,gif',
        ]);

        $in = Input::except('_method','_token','specification','gallery_image','color','size','tags');
        $in['slug'] = str_slug($request->name);
        $in['status'] = $request->status == 'on' ? '1' : '0';
        $in['color_status'] = $request->color_status;
        $in['size_status'] = $request->size_status;
        if($request->hasFile('image')){
            $image3 = $request->file('image');
            $filename3 = $in['slug'].'.'.$image3->getClientOriginalExtension();
            $location = 'assets/images/product/' . $filename3;
            $path = './assets/images/product/'.$product->image;
            File::delete($path);
            Image::make($image3)->resize(780,1000)->save($location);
            $in['image'] = $filename3;
        }

        if($request->hasFile('gallery_image')){
            $oldGalleryImage = ProductImage::whereProduct_id($id)->get();
            foreach ($oldGalleryImage as $oldImage){
                $path = './assets/images/product/'.$oldImage->name;
                File::delete($path);
                $oldImage->delete();
                $oldImage->delete();
            }
            $image4 = $request->file('gallery_image');
            foreach ($image4 as $key => $i)
            {
                $filename4 = $product->slug.'_'.$key.'.'.$i->getClientOriginalExtension();
                $location = 'assets/images/product/' . $filename4;
                Image::make($i)->resize(780,1000)->save($location);
                $image['name'] = $filename4;
                $image['product_id'] = $product->id;
                ProductImage::create($image);
            }
        }
        if ($request->specification != null){
            ProductSpecification::whereProduct_id($id)->delete();
            foreach ($request->specification as $des){
                if (!empty($des)){
                    $pp['product_id'] = $product->id;
                    $pp['specification'] = trim($des);
                    ProductSpecification::create($pp);
                }
            }
        }

        if ($in['color_status'] == 1){
            $product->colors()->sync($request->color);
        }else{
            $product->colors()->detach();
        }
        if ($in['size_status'] == 1){
            $product->sizes()->sync($request->size);
        }else{
            $product->sizes()->detach();
        }
        $tagID = [];
        foreach ($request->tags as $t){
            $tCheck = Tag::whereId($t)->count();
            if ($tCheck == 0){
                $tt['name'] = $t;
                $tID = Tag::create($tt);
                $tagID[] = $tID->id;
            }else{
                $tag = Tag::whereId($t)->first();
                $tagID[] = $tag->id;
            }
        }
        $product->tags()->sync($tagID);

        $product->fill($in)->save();
        session()->flash('message','Product Updated Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

}
