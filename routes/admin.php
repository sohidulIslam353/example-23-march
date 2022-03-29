<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware' =>'is_admin'], function(){
	Route::get('/admin/home','AdminController@admin')->name('admin.home');
	Route::get('/admin/logout','AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change','AdminController@PasswordChange')->name('admin.password.change');
    Route::post('/admin/password/update','AdminController@PasswordUpdate')->name('admin.password.update');

	//category routes
	Route::group(['prefix'=>'category'], function(){
		Route::get('/','CategoryController@index')->name('category.index');
		Route::post('/store','CategoryController@store')->name('category.store');
		Route::get('/delete/{id}','CategoryController@destroy')->name('category.delete');
		Route::get('/edit/{id}','CategoryController@edit');
		Route::post('/update','CategoryController@update')->name('category.update');
	});

	//global route
	Route::get('/get-child-category/{id}','CategoryController@GetChildCategory');

	//subcategory routes
	Route::group(['prefix'=>'subcategory'], function(){
		Route::get('/','SubcategoryController@index')->name('subcategory.index');
		Route::post('/store','SubcategoryController@store')->name('subcategory.store');
		Route::get('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
		Route::get('/edit/{id}','SubcategoryController@edit');
		Route::post('/update','SubcategoryController@update')->name('subcategory.update');
	});

	//warehouse routes
	Route::group(['prefix'=>'warehouse'], function(){
		Route::get('/','WarehouseController@index')->name('warehouse.index');
		Route::post('/store','WarehouseController@store')->name('warehouse.store');
		Route::get('/delete/{id}','WarehouseController@destroy')->name('warehouse.delete');
		Route::get('/edit/{id}','WarehouseController@edit');
		Route::post('/update','WarehouseController@update')->name('warehouse.update');
	});

	//childcategory routes
	Route::group(['prefix'=>'childcategory'], function(){
		Route::get('/','ChildcategoryController@index')->name('childcategory.index');
		Route::post('/store','ChildcategoryController@store')->name('childcategory.store');
		Route::get('/delete/{id}','ChildcategoryController@destroy')->name('childcategory.delete');
		Route::get('/edit/{id}','ChildcategoryController@edit');
		Route::post('/update','ChildcategoryController@update')->name('childcategory.update');
	});

	//Brand Routes
	Route::group(['prefix'=>'brand'], function(){
		Route::get('/','BrandController@index')->name('brand.index');
		Route::post('/store','BrandController@store')->name('brand.store');
		Route::get('/delete/{id}','BrandController@destroy')->name('brand.delete');
		Route::get('/edit/{id}','BrandController@edit');
		Route::post('/update','BrandController@update')->name('brand.update');
	});

	//product routes
	Route::group(['prefix'=>'product'], function(){
		Route::get('/','ProductController@index')->name('product.index');
		Route::get('/create','ProductController@create')->name('product.create');
		Route::post('/store','ProductController@store')->name('product.store');
		Route::get('/delete/{id}','ProductController@destroy')->name('product.delete');
		Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
		Route::post('/update','ProductController@update')->name('product.update');
		Route::get('/active-featured/{id}','ProductController@activefeatured');
		Route::get('/not-featured/{id}','ProductController@notfeatured');
		Route::get('/active-deal/{id}','ProductController@activedeal');
		Route::get('/not-deal/{id}','ProductController@notdeal');
		Route::get('/active-status/{id}','ProductController@activestatus');
		Route::get('/not-status/{id}','ProductController@notstatus');
	});

	//Coupon Routes
	Route::group(['prefix'=>'coupon'], function(){
		Route::get('/','CouponController@index')->name('coupon.index');
		Route::post('/store','CouponController@store')->name('store.coupon');
		Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete');
		Route::get('/edit/{id}','CouponController@edit');
		Route::post('/update','CouponController@update')->name('update.coupon');
	});

	//Campaign Routes
	Route::group(['prefix'=>'campaign'], function(){
		Route::get('/','CampaignController@index')->name('campaign.index');
		Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::get('/delete/{id}','CampaignController@destroy')->name('campaign.delete');
		Route::get('/edit/{id}','CampaignController@edit');
		Route::post('/update','CampaignController@update')->name('campaign.update');
	});

	//__campaign product routes__//
	Route::group(['prefix'=>'campaign-product'], function(){
		Route::get('/{campaign_id}','CampaignController@campaignProduct')->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}','CampaignController@ProductAddToCampaign')->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}','CampaignController@ProductListCampaign')->name('campaign.product.list');
		Route::get('/remove/{id}','CampaignController@RemoveProduct')->name('product.remove.campaign');
		// Route::post('/update','CampaignController@update')->name('campaign.update');
	});

	//__order 
	Route::group(['prefix'=>'order'], function(){
		Route::get('/','OrderController@index')->name('admin.order.index');
		// Route::post('/store','CampaignController@store')->name('campaign.store');
		Route::get('/admin/edit/{id}','OrderController@Editorder');
		Route::post('/update/order/status','OrderController@updateStatus')->name('update.order.status');
		Route::get('/view/admin/{id}','OrderController@ViewOrder');
		Route::get('/delete/{id}','OrderController@delete')->name('order.delete');
		 
	});

	//setting Routes
	Route::group(['prefix'=>'setting'], function(){
		//seo setting
		Route::group(['prefix'=>'seo'], function(){
			Route::get('/','SettingController@seo')->name('seo.setting');
			Route::post('/update/{id}','SettingController@seoUpdate')->name('seo.setting.update');
	    });
	    //smtp setting
		Route::group(['prefix'=>'smtp'], function(){
			Route::get('/','SettingController@smtp')->name('smtp.setting');
			Route::post('/update/','SettingController@smtpUpdate')->name('smtp.setting.update');
	    });

	    //website setting
		Route::group(['prefix'=>'website'], function(){
			Route::get('/','SettingController@website')->name('website.setting');
			Route::post('/update/{id}','SettingController@WebsiteUpdate')->name('website.setting.update');
	    });

	    //website setting
		Route::group(['prefix'=>'payment-gateway'], function(){
			Route::get('/','SettingController@PaymentGateway')->name('payment.gateway');
			Route::post('/update-aamarpay','SettingController@AamarpayUpdate')->name('update.aamarpay');
			Route::post('/update-surjopay','SettingController@SurjopayUpdate')->name('update.surjopay');
	    });

	    //Page setting
		Route::group(['prefix'=>'page'], function(){
			Route::get('/','PageController@index')->name('page.index');
			Route::get('/create','PageController@create')->name('create.page');
			Route::post('/store','PageController@store')->name('page.store');
			Route::get('/delete/{id}','PageController@destroy')->name('page.delete');
			Route::get('/edit/{id}','PageController@edit')->name('page.edit');
			Route::post('/update/{id}','PageController@update')->name('page.update');
	    });


	     //Pickup Point
		Route::group(['prefix'=>'pickup-point'], function(){
			Route::get('/','PickupController@index')->name('pickuppoint.index');
			Route::post('/store','PickupController@store')->name('store.pickup.point');
			Route::delete('/delete/{id}','PickupController@destroy')->name('pickup.point.delete');
			Route::get('/edit/{id}','PickupController@edit');
			Route::post('/update','PickupController@update')->name('update.pickup.point');
	    });


	    //Ticket 
		Route::group(['prefix'=>'ticket'], function(){
			Route::get('/','TicketController@index')->name('ticket.index');
			Route::get('/ticket/show/{id}','TicketController@show')->name('admin.ticket.show');
			Route::post('/ticket/reply','TicketController@ReplyTicket')->name('admin.store.reply');
			Route::get('/ticket/close/{id}','TicketController@CloseTicket')->name('admin.close.ticket');
			Route::delete('/ticket/delete/{id}','TicketController@destroy')->name('admin.ticket.delete');
			
	    });

		//Blog category
	    Route::group(['prefix'=>'blog-category'], function(){
			Route::get('/','BlogController@index')->name('admin.blog.category');
			Route::post('/store','BlogController@store')->name('blog.category.store');
			Route::get('/delete/{id}','BlogController@destroy')->name('blog.category.delete');
			Route::get('/edit/{id}','BlogController@edit');
			Route::post('/update','BlogController@update')->name('blog.category.update');
		});

	    //__role create__
	    Route::group(['prefix'=>'role'], function(){
			Route::get('/','RoleController@index')->name('manage.role');
			Route::get('/create','RoleController@create')->name('create.role');
			Route::post('/store','RoleController@store')->name('store.role');
			Route::get('/delete/{id}','RoleController@destroy')->name('role.delete');
			Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
			Route::post('/update','RoleController@update')->name('update.role');
		});

	    //__report routes__//
	    Route::group(['prefix'=>'report'], function(){
			Route::get('/order','OrderController@Reportindex')->name('report.order.index');
			Route::get('/order/print','OrderController@ReportOrderPrint')->name('report.order.print');
			
		});

	});


});
