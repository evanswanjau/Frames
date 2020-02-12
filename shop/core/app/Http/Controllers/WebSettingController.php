<?php

namespace App\Http\Controllers;

use App\BasicSetting;
use App\Faqs;
use App\Menu;
use App\Page;
use App\Partner;
use App\Service;
use App\Slider;
use App\Social;
use App\Speciality;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class WebSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function manageLogo()
    {
        $data['page_title'] = "Manage Logo & Favicon";
        return view('webControl.logo', $data);
    }
    public function updateLogo(Request $request)
    {
        $this->validate($request,[
           'logo' => 'mimes:png',
            'favicon' => 'mimes:png',
            'loader' => 'mimes:gif',
            'footer-logo' => 'mimes:png'
        ]);
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $filename = 'logo'.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->save($location);
        }
        if($request->hasFile('favicon')){
            $image = $request->file('favicon');
            $filename = 'favicon'.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(50,50)->save($location);
        }
        if($request->hasFile('loader')){
            $image = $request->file('loader');
            $filename = 'loader'.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/';
            $image->move($location,$filename);
        }
        if($request->hasFile('footer-logo')){
            $image = $request->file('footer-logo');
            $filename = 'footer-logo'.'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->save($location);
        }
        session()->flash('message','Logo and Favicon Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function manageFooter()
    {
        $data['page_title'] = "Manage Web Footer";
        return view('webControl.footer', $data);
    }
    public function updateFooter(Request $request,$id)
    {
        $basic = BasicSetting::findOrFail($id);
        $this->validate($request,[
            'footer_text' => 'required',
            'copy_text' => 'required',
            'footer_image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('footer_image')){
            $image = $request->file('footer_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1600,475)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->footer_image;
            if (file_exists($link)){
                unlink($link);
            }
            $in['footer_image'] = $filename;
        }
        $basic->fill($in)->save();
        session()->flash('message','Web Footer Updated Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function manageSlider()
    {
        $data['page_title'] = "Manage Slider";
        $data['slider'] = Slider::all();
        return view('webControl.slider', $data);
    }
    public function storeSlider(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|mimes:png,jpeg,jpg,gif'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'slider_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/slider/' . $filename;
            Image::make($image)->resize(1920,620)->save($location);
            $in['image'] = $filename;
        }
        Slider::create($in);
        session()->flash('message','Slider Created Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }
    public function deleteSlider(Request $request)
    {
        $this->validate($request,[
           'id' => 'required'
        ]);
        $slider = Slider::findOrFail($request->id);
        $path = './assets/images/slider/';
        $link = $path.$slider->image;
        $slider->delete();
        if (file_exists($link)) {
            unlink($link);
        }
        session()->flash('message','Slider Deleted Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function manageSocial()
    {
        $data['page_title'] = "Manage Social";
        $data['social'] = Social::all();
        return view('webControl.social', $data);
    }
    public function storeSocial(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'link' => 'required',
        ]);

        $product = Social::create($request->input());
        return response()->json($product);

    }
    public function editSocial($product_id)
    {
        $product = Social::find($product_id);
        return response()->json($product);
    }
    public function updateSocial(Request $request,$product_id)
    {
        $product = Social::find($product_id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->link = $request->link;
        $product->save();
        return response()->json($product);
    }
    public function deleteSocial($product_id)
    {
        $product = Social::destroy($product_id);
        return response()->json($product);
    }

    public function manageMenu()
    {
        $data['page_title'] = "Control Menu";
        $data['menu'] = Menu::all();
        return view('webControl.menu-show',$data);
    }
    public function createMenu()
    {
        $data['page_title'] = "Create Menu";
        return view('webControl.menu-create',$data);
    }
    public function storeMenu(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:menus,name',
            'description' => 'required'
        ]);
        Menu::create($request->all());
        session()->flash('message', 'Menu Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function editMenu($id)
    {
        $data['page_title'] = "EdIt MEnu";
        $data['menu'] = Menu::findOrFail($id);
        return view('webControl.menu-edit',$data);
    }
    public function updateMenu(Request $request,$id)
    {
        $menu = Menu::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|unique:menus,name,'.$menu->id,
            'description' => 'required'
        ]);
        $menu->fill($request->all())->save();
        session()->flash('message', 'Menu Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteMenu(Request $request)
    {
        $this->validate($request,[
            'id' => 'required'
        ]);
        Menu::destroy($request->id);
        session()->flash('message', 'Menu Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function mangeBreadcrumb()
    {
        $data['page_title'] = "Manage Breadcrumb";
        return view('webControl.breadcrumb',$data);
    }
    public function updateBreadcrumb(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
           'breadcrumb' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('breadcrumb')){
            $image = $request->file('breadcrumb');
            $filename = 'breadcrumb_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1920,650)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->breadcrumb;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['breadcrumb'] = $filename;
        }
        $basic->fill($in)->save();
        session()->flash('message', 'Breadcrumb Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function mangeParallax()
    {
        $data['page_title'] = "Manage Parallax Image";
        return view('webControl.parallax',$data);
    }
    public function updateParallax(Request $request)
    {
        $basic = BasicSetting::first();
        $this->validate($request,[
            'counter_bg' => 'mimes:png,jpg,jpeg',
            'subscribe_bg' => 'mimes:png,jpg,jpeg',
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('subscribe_bg')){
            $image = $request->file('subscribe_bg');
            $filename = 'subscribe_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1070,780)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->subscribe_bg;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['subscribe_bg'] = $filename;
        }
        if($request->hasFile('counter_bg')){
            $image = $request->file('counter_bg');
            $filename = 'counter_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/' . $filename;
            Image::make($image)->resize(1920,1064)->save($location);
            $path = './assets/images/';
            $link = $path.$basic->counter_bg;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['counter_bg'] = $filename;
        }
        $basic->fill($in)->save();
        session()->flash('message', 'Parallax Image Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function manageAbout()
    {
        $data['page_title'] = "Manage About";
        return view('webControl.about',$data);
    }
    public function updateAbout(Request $request)
    {
        $this->validate($request,[
           'about' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->about = $request->about;
        $basic->save();
        session()->flash('message', 'About Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function providerPortion()
    {
        $data['page_title'] = "Manage Provider Portion";
        return view('webControl.provider-portion',$data);
    }

    public function updateProviderPortion(Request $request, $id)
    {
        $request->validate([
           'provider_title' => 'required',
           'provider_subtitle' => 'required',
        ]);
        $basic = BasicSetting::first();
        $basic->provider_title = $request->provider_title;
        $basic->provider_subtitle = $request->provider_subtitle;
        $basic->save();
        session()->flash('message', 'Provider Portion Updated Successfully.');
        Session::flash('type', 'success');
        return redirect()->back();
    }

    public function managePrivacyPolicy()
    {
        $data['page_title'] = "Manage Privacy Policy";
        return view('webControl.privacy-policy',$data);
    }
    public function updatePrivacyPolicy(Request $request)
    {
        $this->validate($request,[
            'about' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->privacy = $request->about;
        $basic->save();
        session()->flash('message', 'Privacy Policy Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function manageTermsCondition()
    {
        $data['page_title'] = "Terms Condition About";
        return view('webControl.terms-condition',$data);
    }
    public function updateTermsCondition(Request $request)
    {
        $this->validate($request,[
            'about' => 'required'
        ]);
        $basic = BasicSetting::first();
        $basic->terms = $request->about;
        $basic->save();
        session()->flash('message', 'Terms Condition Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createFaqs()
    {
        $data['page_title'] = "Create New Question";
        return view('webControl.faqs-create',$data);
    }

    public function storeFaqs(Request $request)
    {
        $request->validate([
           'title' => 'required',
            'description' => 'required'
        ]);
        $in = Input::except('_method','_token');
        Faqs::create($in);
        session()->flash('message', 'FAQS Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function allFaqs()
    {
        $data['page_title'] = "All Question";
        $data['faqs'] = Faqs::orderBy('id','desc')->paginate(10);
        return view('webControl.faqs-all',$data);
    }

    public function editFaqs($id)
    {
        $data['page_title'] = "Edit Faqs";
        $data['faqs'] = Faqs::findOrFail($id);
        return view('webControl.faqs-edit',$data);
    }

    public function updateFaqs(Request $request, $id)
    {
        $faqs = Faqs::findOrFail($id);
        $request->validate([
           'title' => 'required',
            'description' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $faqs->fill($in)->save();
        session()->flash('message', 'FAQS Updated Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function deleteFaqs(Request $request)
    {
        $request->validate([
           'id' => 'required'
        ]);
        Faqs::destroy($request->id);
        session()->flash('message', 'FAQS Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createTestimonial()
    {
        $data['page_title'] = "Create New Testimonial";
        return view('webControl.testimonial-create',$data);
    }
    public function submitTestimonial(Request $request)
    {
        $request->validate([
           'name' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
            'message' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'testimonial_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/testimonial/' . $filename;
            Image::make($image)->resize(180,180)->save($location);
            $in['image'] = $filename;
        }
        Testimonial::create($in);
        session()->flash('message', 'Testimonial Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function allTestimonial()
    {
        $data['page_title'] = "All Testimonial";
        $data['testimonial'] = Testimonial::orderBy('id','desc')->paginate(10);
        return view('webControl.testimonial-all',$data);
    }
    public function editTestimonial($id)
    {
        $data['page_title'] = "Edit Testimonial";
        $data['testimonial'] = Testimonial::findOrFail($id);
        return view('webControl.testimonial-edit',$data);
    }

    public function updateTestimonial(Request $request,$id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:png,jpeg,jpg',
            'message' => 'required'
        ]);
        $in = Input::except('_method','_token');
        $in['status'] = $request->status == 'on' ? '1' : '0';
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'testimonial_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/testimonial/' . $filename;
            Image::make($image)->resize(180,180)->save($location);
            $path = './assets/images/';
            $link = $path.$testimonial->image;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['image'] = $filename;
        }
        $testimonial->fill($in)->save();
        session()->flash('message', 'Testimonial Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deleteTestimonial(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $testimonial = Testimonial::findOrFail($request->id);
        $path = './assets/images/';
        $link = $path.$testimonial->image;
        if (file_exists($link)) {
            unlink($link);
        }
        $testimonial->delete();
        session()->flash('message', 'Testimonial Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createPartner()
    {
        $data['page_title'] = "Create New Partner";
        return view('webControl.partner-create',$data);
    }
    public function submitPartner(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'partner_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/partner/' . $filename;
            Image::make($image)->resize(170,90)->save($location);
            $in['image'] = $filename;
        }
        Partner::create($in);
        session()->flash('message', 'Partner Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function allPartner()
    {
        $data['page_title'] = "All Partner";
        $data['testimonial'] = Partner::orderBy('id','desc')->paginate(10);
        return view('webControl.partner-all',$data);
    }
    public function editPartner($id)
    {
        $data['page_title'] = "Edit Partner";
        $data['testimonial'] = Partner::findOrFail($id);
        return view('webControl.partner-edit',$data);
    }

    public function updatePartner(Request $request,$id)
    {
        $testimonial = Partner::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:png,jpeg,jpg',
        ]);
        $in = Input::except('_method','_token');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'partner_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/partner/' . $filename;
            Image::make($image)->resize(170,90)->save($location);
            $path = './assets/images/partner/';
            $link = $path.$testimonial->image;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['image'] = $filename;
        }
        $testimonial->fill($in)->save();
        session()->flash('message', 'Partner Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function deletePartner(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $testimonial = Partner::findOrFail($request->id);
        $path = './assets/images/partner/';
        $link = $path.$testimonial->image;
        if (file_exists($link)) {
            unlink($link);
        }
        $testimonial->delete();
        session()->flash('message', 'Partner Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
    public function manageAboutText()
    {
        $data['page_title'] = "Manage About Text";
        return view('webControl.about-text', $data);
    }

    public function updateAboutText(Request $request)
    {
        $page = BasicSetting::first();
        $in = Input::except('_method','_token');
        $page->fill($in)->save();
        session()->flash('message','About Text Update Successfully.');
        session()->flash('title','Success');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function mangeSpeciality()
    {
        $data['page_title'] = 'Manage Speciality';
        $data['speciality'] = Speciality::all();
        return view('webControl.speciality',$data);
    }

    public function editSpeciality($product_id)
    {
        $product = Speciality::find($product_id);
        return response()->json($product);
    }

    public function updateSpeciality(Request $request)
    {
        $speciality = Speciality::findOrFail($request->product_id);
        $request->validate([
           'title' => 'required',
           'subtitle' => 'required',
           'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method','_token','product_id');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'speciality_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/speciality/' . $filename;
            Image::make($image)->resize(60,60)->save($location);
            $path = './assets/images/speciality/';
            $link = $path.$speciality->image;
            if (file_exists($link)) {
                unlink($link);
            }
            $in['image'] = $filename;
        }
        $speciality->fill($in)->save();
        session()->flash('message','Speciality Update Successfully.');
        session()->flash('type','success');
        return redirect()->back();
    }

    public function updateSpecialityBg(Request $request)
    {
        $request->validate([
           'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $basic = BasicSetting::first();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'speciality_'.time().'.'.$image->getClientOriginalExtension();
            $location = 'assets/images/speciality/' . $filename;
            Image::make($image)->resize(1172,110)->save($location);
            $path = './assets/images/speciality/';
            $link = $path.$basic->speciality_bg;
            if (file_exists($link)) {
                unlink($link);
            }
            $basic->speciality_bg = $filename;
            $basic->save();
        }
        session()->flash('message','Speciality Bg Update Successfully.');
        session()->flash('type','success');
        return redirect()->back();

    }


}
