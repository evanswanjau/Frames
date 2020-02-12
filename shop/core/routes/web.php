<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['as'=>'home','uses'=>'HomeController@getIndex']);

Route::get('cron-fire',['as'=>'cron-fire','uses'=>'HomeController@submitCronJob']);

Route::get('about-us',['as'=>'about-us','uses'=>'HomeController@getAbout']);
Route::get('privacy-policy',['as'=>'privacy-policy','uses'=>'HomeController@getPrivacyPolicy']);
Route::get('terms-condition',['as'=>'terms-condition','uses'=>'HomeController@getTermsCondition']);
Route::get('contact-us',['as'=>'contact-us','uses'=>'HomeController@getContact']);
Route::post('contact-us',['as'=>'contact-submit','uses'=>'HomeController@submitContact']);
Route::post('submit-subscribe',['as'=>'submit-subscribe','uses'=>'HomeController@submitSubscribe']);

Route::get('price-range',['as'=>'price-range','uses'=>'HomeController@rangePrice']);
Route::get('product-price-range',['as'=>'product-price-range','uses'=>'HomeController@productRangePrice']);

Route::get('category/{id}/{slug}',['as'=>'category','uses'=>'HomeController@getCategoryProduct']);
Route::get('subcategory/{id}/{slug}',['as'=>'subcategory','uses'=>'HomeController@getSubCategoryProduct']);
Route::get('childcategory/{id}/{slug}',['as'=>'childcategory','uses'=>'HomeController@getChildCategoryProduct']);
Route::get('search-product',['as'=>'search-product','uses'=>'HomeController@getSearchProduct']);

Route::get('tag-products/{id}',['as'=>'tag-products','uses'=>'HomeController@getTagProduct']);

Route::get('provider-product/{id}',['as'=>'get-provider-product','uses'=>'HomeController@getProviderProduct']);

Route::get('compare',['as'=>'compare','uses'=>'HomeController@getCompare']);
Route::get('compare-add/{id}',['as'=>'compare-add','uses'=>'HomeController@addCompare']);
Route::get('compare-remove/{id}',['as'=>'compare-remove','uses'=>'HomeController@removeCompare']);

Route::get('partner-product/{id}',['as'=>'partner-product','uses'=>'HomeController@partnerProduct']);

Route::get('product-details/{slug}',['as'=>'product-details','uses'=>'HomeController@getProductDetails']);
Route::post('submit-friend-email',['as'=>'submit-friend-email','uses'=>'HomeController@submitFriendEmail']);

Route::get('cart',['as'=>'cart','uses'=>'HomeController@getCart']);


Route::post('add-to-cart',['as'=>'add-to-cart','uses'=>'CartController@addToCart']);
Route::post('single-cart-add',['as'=>'single-cart-add','uses'=>'CartController@singleAddToCart']);
Route::post('delete-cart-item',['as'=>'delete-cart-item','uses'=>'CartController@deleteFromCart']);
/*Route::post('only-delete-cart-item',['as'=>'only-delete-cart-item','uses'=>'CartController@deleteOnlyFromCart']);*/
Route::get('update-cart-item/{row_id}/{qty}',['as'=>'update-cart-item','uses'=>'CartController@updateCartItem']);

Route::post('wishlist-to-cart',['as'=>'wishlist-to-cart','uses'=>'CartController@wishToCart']);


/*---------------- Admin Auth Route List --------------------*/

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'Admin\ResetPasswordController@reset');
Route::get('admin-logout', 'Admin\LoginController@logout')->name('admin.logout');



/*===================== Admin Dashboard Redirected ====================*/

Route::get('admin-dashboard',['as'=>'dashboard','uses'=>'DashboardController@getDashboard']);

Route::group(['prefix' => 'admin'], function () {

    Route::get('edit-profile',['as'=>'edit-profile','uses'=>'BasicSettingController@editProfile']);
    Route::post('edit-profile',['as'=>'update-profile','uses'=>'BasicSettingController@updateProfile']);

    Route::get('change-password', ['as'=>'admin-change-password', 'uses'=>'BasicSettingController@getChangePass']);
    Route::post('change-password', ['as'=>'admin-change-password', 'uses'=>'BasicSettingController@postChangePass']);

    Route::get('basic-setting', ['as' => 'basic-setting', 'uses' => 'BasicSettingController@getBasicSetting']);
    Route::put('basic-general/{id}', ['as' => 'basic-update', 'uses' => 'BasicSettingController@putBasicSetting']);

    Route::get('manage-logo', ['as' => 'manage-logo', 'uses' => 'WebSettingController@manageLogo']);
    Route::post('manage-logo', ['as' => 'manage-logo', 'uses' => 'WebSettingController@updateLogo']);

    Route::get('manage-footer', ['as' => 'manage-footer', 'uses' => 'WebSettingController@manageFooter']);
    Route::put('manage-footer/{id}', ['as' => 'manage-footer-update', 'uses' => 'WebSettingController@updateFooter']);

    Route::get('email-template',['as'=>'email-template','uses'=>'BasicSettingController@manageEmailTemplate']);
    Route::post('email-template',['as'=>'email-template','uses'=>'BasicSettingController@updateEmailTemplate']);

    Route::get('email-setting', ['as' => 'email-setting', 'uses' => 'BasicSettingController@getEmailSetting']);
    Route::post('email-setting', ['as' => 'email-setting', 'uses' => 'BasicSettingController@updateEmailSetting']);

    Route::get('google-analytic',['as'=>'google-analytic','uses'=>'BasicSettingController@getGoogleAnalytic']);
    Route::post('google-analytic',['as'=>'google-analytic','uses'=>'BasicSettingController@updateGoogleAnalytic']);

    Route::get('live-chat',['as'=>'live-chat','uses'=>'BasicSettingController@getLiveChat']);
    Route::post('live-chat',['as'=>'live-chat','uses'=>'BasicSettingController@updateLiveChat']);

    Route::get('cron-job',['as'=>'cron-job','uses'=>'BasicSettingController@setCronJob']);

    Route::get('manage-slider', ['as' => 'manage-slider', 'uses' => 'WebSettingController@manageSlider']);
    Route::post('manage-slider', ['as' => 'manage-slider', 'uses' => 'WebSettingController@storeSlider']);
    Route::delete('slider-delete', ['as' => 'slider-delete', 'uses' => 'WebSettingController@deleteSlider']);

    Route::get('manage-social',['as'=>'manage-social','uses'=>'WebSettingController@manageSocial']);
    Route::post('manage-social',['as'=>'manage-social','uses'=>'WebSettingController@storeSocial']);
    Route::get('manage-social/{product_id?}',['as'=>'social-edit','uses'=>'WebSettingController@editSocial']);
    Route::put('manage-social/{product_id?}',['as'=>'social-edit','uses'=>'WebSettingController@updateSocial']);
    Route::delete('manage-social/{product_id?}',['as'=>'social-delete','uses'=>'WebSettingController@deleteSocial']);

    Route::get('menu-create',['as'=>'menu-create','uses'=>'WebSettingController@createMenu']);
    Route::post('menu-create',['as'=>'menu-create','uses'=>'WebSettingController@storeMenu']);
    Route::get('menu-control',['as'=>'menu-control','uses'=>'WebSettingController@manageMenu']);
    Route::get('menu-edit/{id}',['as'=>'menu-edit','uses'=>'WebSettingController@editMenu']);
    Route::post('menu-update/{id}',['as'=>'menu-update','uses'=>'WebSettingController@updateMenu']);
    Route::delete('menu-delete',['as'=>'menu-delete','uses'=>'WebSettingController@deleteMenu']);

    Route::get('manage-breadcrumb',['as'=>'manage-breadcrumb','uses'=>'WebSettingController@mangeBreadcrumb']);
    Route::post('manage-breadcrumb',['as'=>'manage-breadcrumb','uses'=>'WebSettingController@updateBreadcrumb']);

    Route::get('manage-speciality',['as'=>'manage-speciality','uses'=>'WebSettingController@mangeSpeciality']);
    Route::post('update-speciality-bg',['as'=>'update-speciality-bg','uses'=>'WebSettingController@updateSpecialityBg']);
    Route::get('manage-speciality/{product_id?}',['as'=>'edit-speciality','uses'=>'WebSettingController@editSpeciality']);
    Route::post('manage-speciality',['as'=>'update-speciality','uses'=>'WebSettingController@updateSpeciality']);

    Route::get('manage-parallax',['as'=>'manage-parallax','uses'=>'WebSettingController@mangeParallax']);
    Route::post('manage-parallax',['as'=>'manage-parallax','uses'=>'WebSettingController@updateParallax']);

    Route::get('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@manageAbout']);
    Route::post('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@updateAbout']);

    Route::get('provider-portion',['as'=>'provider-portion','uses'=>'WebSettingController@providerPortion']);
    Route::put('provider-portion/{id}',['as'=>'update-provider-portion','uses'=>'WebSettingController@updateProviderPortion']);

    Route::get('manage-privacy-policy',['as'=>'manage-privacy-policy','uses'=>'WebSettingController@managePrivacyPolicy']);
    Route::post('manage-privacy-policy',['as'=>'manage-privacy-policy','uses'=>'WebSettingController@updatePrivacyPolicy']);

    Route::get('manage-terms-condition',['as'=>'manage-terms-condition','uses'=>'WebSettingController@manageTermsCondition']);
    Route::post('manage-terms-condition',['as'=>'manage-terms-condition','uses'=>'WebSettingController@updateTermsCondition']);

    Route::get('advertisement-new',['as'=>'advertisement-new','uses'=>'DashboardController@newAdvertisement']);
    Route::post('advertisement-new',['as'=>'advertisement-new','uses'=>'DashboardController@storeAdvertisement']);
    Route::get('advertisement-all',['as'=>'advertisement-all','uses'=>'DashboardController@allAdvertisement']);
    Route::get('advertisement-edit/{id}',['as'=>'advertisement-edit','uses'=>'DashboardController@editAdvertisement']);
    Route::put('advertisement-edit/{id}',['as'=>'advertisement-update','uses'=>'DashboardController@updateAdvertisement']);

    Route::get('testimonial-create',['as'=>'testimonial-create','uses'=>'WebSettingController@createTestimonial']);
    Route::post('testimonial-create',['as'=>'testimonial-create','uses'=>'WebSettingController@submitTestimonial']);
    Route::get('testimonial-all',['as'=>'testimonial-all','uses'=>'WebSettingController@allTestimonial']);
    Route::get('testimonial-edit/{id}',['as'=>'testimonial-edit','uses'=>'WebSettingController@editTestimonial']);
    Route::put('testimonial-edit/{id}',['as'=>'testimonial-update','uses'=>'WebSettingController@updateTestimonial']);
    Route::delete('testimonial-delete',['as'=>'testimonial-delete','uses'=>'WebSettingController@deleteTestimonial']);

    Route::get('partner-create',['as'=>'partner-create','uses'=>'WebSettingController@createPartner']);
    Route::post('partner-create',['as'=>'partner-create','uses'=>'WebSettingController@submitPartner']);
    Route::get('partner-all',['as'=>'partner-all','uses'=>'WebSettingController@allPartner']);
    Route::get('partner-edit/{id}',['as'=>'partner-edit','uses'=>'WebSettingController@editPartner']);
    Route::put('partner-edit/{id}',['as'=>'partner-update','uses'=>'WebSettingController@updatePartner']);
    Route::delete('partner-delete',['as'=>'partner-delete','uses'=>'WebSettingController@deletePartner']);

    Route::get('manage-category',['as'=>'manage-category','uses'=>'DashboardController@manageCategory']);
    Route::post('manage-category',['as'=>'manage-category','uses'=>'DashboardController@storeCategory']);
    Route::get('manage-category/{product_id?}',['as'=>'category-edit','uses'=>'DashboardController@editCategory']);
    Route::put('manage-category/{product_id?}',['as'=>'category-edit','uses'=>'DashboardController@updateCategory']);
    Route::post('category-status',['as'=>'category-status','uses'=>'DashboardController@categoryStatus']);
    Route::delete('category-delete',['as'=>'category-delete','uses'=>'DashboardController@deleteCategory']);

    Route::get('manage-size',['as'=>'manage-size','uses'=>'DashboardController@manageSize']);
    Route::post('manage-size',['as'=>'manage-size','uses'=>'DashboardController@storeSize']);
    Route::get('manage-size/{product_id?}',['as'=>'size-edit','uses'=>'DashboardController@editSize']);
    Route::put('manage-size/{product_id?}',['as'=>'size-edit','uses'=>'DashboardController@updateSize']);

    Route::get('manage-color',['as'=>'manage-color','uses'=>'DashboardController@manageColor']);
    Route::post('manage-color',['as'=>'manage-color','uses'=>'DashboardController@storeColor']);
    Route::get('manage-color/{product_id?}',['as'=>'color-edit','uses'=>'DashboardController@editColor']);
    Route::put('manage-color/{product_id?}',['as'=>'color-edit','uses'=>'DashboardController@updateColor']);

    Route::get('manage-tags',['as'=>'manage-tags','uses'=>'DashboardController@manageTags']);
    Route::post('manage-tags',['as'=>'manage-tags','uses'=>'DashboardController@storeTags']);
    Route::get('manage-tags/{product_id?}',['as'=>'tags-edit','uses'=>'DashboardController@editTags']);
    Route::put('manage-tags/{product_id?}',['as'=>'tags-edit','uses'=>'DashboardController@updateTags']);

    Route::get('manage-subcategory',['as'=>'manage-subcategory','uses'=>'DashboardController@manageSubCategory']);
    Route::post('manage-subcategory',['as'=>'manage-subcategory','uses'=>'DashboardController@storeSubCategory']);
    Route::get('manage-subcategory/{product_id?}',['as'=>'subcategory-edit','uses'=>'DashboardController@editSubCategory']);
    Route::put('manage-subcategory/{product_id?}',['as'=>'subcategory-edit','uses'=>'DashboardController@updateSubCategory']);
    Route::delete('sub-category-delete',['as'=>'sub-category-delete','uses'=>'DashboardController@deleteSubcategory']);

    Route::get('manage-childcategory',['as'=>'manage-childcategory','uses'=>'DashboardController@manageChildCategory']);
    Route::post('manage-childcategory',['as'=>'manage-childcategory','uses'=>'DashboardController@storeChildCategory']);
    Route::get('manage-childcategory/{product_id?}',['as'=>'childcategory-edit','uses'=>'DashboardController@editChildCategory']);
    Route::put('manage-childcategory/{product_id?}',['as'=>'childcategory-edit','uses'=>'DashboardController@updateChildCategory']);
    Route::delete('child-category-delete',['as'=>'child-category-delete','uses'=>'DashboardController@deleteChildCategory']);

    Route::get('manage-subscribe',['as'=>'manage-subscribe','uses'=>'DashboardController@mangeSubscribe']);
    Route::delete('subscriber-delete',['as'=>'subscriber-delete','uses'=>'DashboardController@deleteSubscribe']);

    Route::get('manage-users',['as'=>'manage-users','uses'=>'DashboardController@mangeUsers']);
    Route::delete('users-delete',['as'=>'user-delete','uses'=>'DashboardController@deleteUser']);

    Route::get('payment-method',['as'=>'payment-method','uses'=>'DashboardController@paymentMethod']);
    Route::post('payment-method',['as'=>'payment-method','uses'=>'DashboardController@updatePaymentMethod']);
    Route::get('manual-payment-method',['as'=>'manual-payment-method','uses'=>'DashboardController@getManualPaymentMethod']);
    Route::get('manual-payment-method-create',['as'=>'manual-payment-method-create','uses'=>'DashboardController@createManualPaymentMethod']);
    Route::post('manual-payment-method-create',['as'=>'manual-payment-method-create','uses'=>'DashboardController@storeManualPaymentMethod']);
    Route::get('manual-payment-method-edit/{id}',['as'=>'manual-payment-method-edit','uses'=>'DashboardController@editManualPaymentMethod']);
    Route::put('manual-payment-method-edit/{id}',['as'=>'manual-payment-method-update','uses'=>'DashboardController@updateManualPaymentMethod']);

    Route::get('manual-payment-request',['as'=>'manual-payment-request','uses'=>'DashboardController@getManualPaymentRequest']);
    Route::get('manual-payment-request/{custom}',['as'=>'manual-payment-request-view','uses'=>'DashboardController@viewManualPaymentRequest']);
    Route::post('manual-payment-request-cancel',['as'=>'manual-payment-request-cancel','uses'=>'DashboardController@cancelManualPaymentRequest']);
    Route::post('manual-payment-request-confirm',['as'=>'manual-payment-request-confirm','uses'=>'DashboardController@confirmManualPaymentRequest']);
    Route::delete('manual-payment-request-delete',['as'=>'manual-payment-request-delete','uses'=>'DashboardController@deleteManualPaymentRequest']);

    Route::get('add-product',['as'=>'add-product','uses'=>'DashboardController@addProduct']);
    Route::post('add-product',['as'=>'add-product','uses'=>'DashboardController@storeProduct']);
    Route::get('all-product',['as'=>'all-product','uses'=>'DashboardController@allProduct']);
    Route::post('product-feature',['as'=>'product-feature','uses'=>'DashboardController@featuredProduct']);
    Route::get('product-edit/{id}',['as'=>'product-edit','uses'=>'DashboardController@editProduct']);
    Route::put('product-edit/{id}',['as'=>'product-update','uses'=>'DashboardController@updateProduct']);
    Route::get('provider-product',['as'=>'provider-product','uses'=>'DashboardController@providerProduct']);
    Route::delete('product-delete',['as'=>'product-delete','uses'=>'DashboardController@deleteProduct']);

    Route::get('all-order',['as'=>'all-order','uses'=>'DashboardController@allOrder']);
    Route::get('order-confirm',['as'=>'order-confirm','uses'=>'DashboardController@confirmOrder']);
    Route::get('pending-order',['as'=>'pending-order','uses'=>'DashboardController@pendingOrder']);
    Route::get('cancel-order',['as'=>'cancel-order','uses'=>'DashboardController@cancelOrder']);
    Route::get('order-view/{id}',['as'=>'order-view','uses'=>'DashboardController@viewOrder']);
    Route::post('update-shipping-status',['as'=>'update-shipping-status','uses'=>'DashboardController@updateShippingStatus']);
    Route::post('update-order-status',['as'=>'update-order-status','uses'=>'DashboardController@updateOrderStatus']);

    Route::get('manage-staff',['as'=>'manage-staff','uses'=>'DashboardController@manageStaff']);
    Route::post('manage-staff',['as'=>'manage-staff','uses'=>'DashboardController@storeStaff']);
    Route::get('manage-staff/{product_id?}',['as'=>'staff-edit','uses'=>'DashboardController@editStaff']);
    Route::put('manage-staff/{product_id?}',['as'=>'staff-edit','uses'=>'DashboardController@updateStaff']);


    Route::get('transaction-log',['as'=>'transaction-log','uses'=>'DashboardController@getTransactionLog']);

});
Route::get('/subcategory-get',function (){
    $category_id = \Illuminate\Support\Facades\Input::get('category_id');
    $subcategory = \App\Subcategory::where('category_id','=',$category_id)->get();
    return Response::json($subcategory);
});

Route::get('/category-color',function (){
    $category_id = \Illuminate\Support\Facades\Input::get('category_id');
    $categoryColor = \App\Color::where('category_id','=',$category_id)->get();
    return Response::json($categoryColor);
});

Route::get('/category-size',function (){
    $category_id = \Illuminate\Support\Facades\Input::get('category_id');
    $categorySize = \App\Size::where('category_id','=',$category_id)->get();
    return Response::json($categorySize);
});

Route::get('/childcategory-get',function (){
    $subcategory_id = \Illuminate\Support\Facades\Input::get('subcategory_id');
    $childcategory = \App\ChildCategory::where('subcategory_id','=',$subcategory_id)->get();
    return Response::json($childcategory);
});

/*---------------- Staff Auth Route List --------------------*/

Route::get('staff', 'Staff\LoginController@showLoginForm')->name('staff.login');
Route::post('staff', 'Staff\LoginController@login')->name('staff.login.post');
Route::get('staff/password/reset', 'Staff\ForgotPasswordController@showLinkRequestForm')->name('staff.password.request');
Route::post('staff/password/email', 'Staff\ForgotPasswordController@sendResetLinkEmail')->name('staff.password.email');
Route::get('staff/password/reset/{token}', 'Staff\ResetPasswordController@showResetForm')->name('staff.password.reset');
Route::post('staff/password/reset', 'Staff\ResetPasswordController@reset');
Route::get('staff-logout', 'Staff\LoginController@logout')->name('staff.logout');

Route::get('staff-dashboard',['as'=>'staff-dashboard','uses'=>'StaffController@getDashboard']);

Route::group(['prefix' => 'staff'], function () {

    Route::get('edit-profile',['as'=>'staff-edit-profile','uses'=>'StaffController@editProfile']);
    Route::post('edit-profile',['as'=>'staff-update-profile','uses'=>'StaffController@updateProfile']);

    Route::get('change-password', ['as'=>'staff-change-password', 'uses'=>'StaffController@getChangePass']);
    Route::post('change-password', ['as'=>'staff-change-password', 'uses'=>'StaffController@postChangePass']);

    Route::get('add-product',['as'=>'staff-add-product','uses'=>'StaffController@addProduct']);
    Route::post('add-product',['as'=>'staff-add-product','uses'=>'StaffController@storeProduct']);
    Route::get('all-product',['as'=>'staff-all-product','uses'=>'StaffController@allProduct']);
    Route::get('product-edit/{id}',['as'=>'staff-product-edit','uses'=>'StaffController@editProduct']);
    Route::put('product-edit/{id}',['as'=>'staff-product-update','uses'=>'StaffController@updateProduct']);

});

Auth::routes();

Route::get('order-complete/{orderNumber}',['as'=>'order-complete','uses'=>'HomeController@orderCompleted']);

Route::post('paypal-ipn',['as'=>'paypal-ipn','uses'=>'PaymentIPNController@paypalIpn']);
Route::post('perfect-ipn',['as'=>'perfect-ipn','uses'=>'PaymentIPNController@perfectIPN']);
Route::post('stripe-submit',['as'=>'stripe-submit','uses'=>'PaymentIPNController@submitStripe']);
Route::get('btc_ipn',['as'=>'btc_ipn','uses'=>'PaymentIPNController@btcIPN']);
Route::post('skrill-ipn',['as'=>'skrill-ipn','uses'=>'PaymentIPNController@skrillIPN']);
Route::get('payza-ipn',['as'=>'payza-ipn','uses'=>'PaymentIPNController@payzaIPN']);
Route::post('coinpayment-ipn',['as'=>'coinpayment-ipn','uses'=>'PaymentIPNController@coinPaymentIPN']);

Route::post('single-wishlist-add',['as'=>'single-wishlist-add','uses'=>'CartController@singleWishList']);

Route::get('user-dashboard',['as'=>'user-dashboard','uses'=>'UserController@getDashboard']);
Route::group(['prefix' => 'user'], function () {

    Route::get('edit-profile',['as'=>'user-edit-profile','uses'=>'UserController@editProfile']);
    Route::post('edit-profile',['as'=>'user-update-profile','uses'=>'UserController@updateProfile']);

    Route::get('change-password',['as'=>'user-change-password','uses'=>'UserController@getPassword']);
    Route::post('change-password',['as'=>'user-update-password','uses'=>'UserController@updatePassword']);

    Route::post('review-submit',['as'=>'review-submit','uses'=>'UserController@submitReview']);
    Route::post('comment-submit',['as'=>'comment-submit','uses'=>'UserController@submitComment']);

    Route::get('check-out',['as'=>'check-out','uses'=>'UserController@getCheckOut']);
    Route::post('submit-details',['as'=>'submit-details','uses'=>'UserController@submitDetails']);
    Route::post('user-dashboard-details',['as'=>'user-dashboard-details','uses'=>'UserController@userSubmitDetails']);
    Route::get('order-overview',['as'=>'oder-overview','uses'=>'UserController@orderOverview']);
    Route::post('confirm-order',['as'=>'confirm-order','uses'=>'UserController@orderSubmit']);
    Route::get('payment/{orderNumber}',['as'=>'payment','uses'=>'UserController@getPayment']);
    Route::get('payment-overview/{id}/{orderNumber}',['as'=>'payment-overview','uses'=>'UserController@getPaymentOverview']);
    Route::post('manual-payment-submit',['as'=>'manual-payment-submit','uses'=>'UserController@manualPaymentSubmit']);

    Route::get('all-order',['as'=>'user-all-order','uses'=>'UserController@allOrder']);
    Route::get('user-order-view/{id}',['as'=>'user-order-view','uses'=>'UserController@viewOrder']);

    Route::get('wishlist',['as'=>'wishlist','uses'=>'UserController@addWishList']);
    Route::delete('wishlist-delete',['as'=>'wishlist-delete','uses'=>'UserController@deleteWishlist']);

    Route::post('send-testimonial',['as'=>'user-send-testimonial','uses'=>'UserController@sendTestimonial']);
    Route::post('update-testimonial',['as'=>'user-update-testimonial','uses'=>'UserController@updateTestimonial']);

});
