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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::group(array('namespace'=>'FrontEnd',), function()
{
    Route::get('/', 'QRController@generate');
});



Route::group(array('namespace'=>'Backend','prefix'=>'admin'), function()
{
    Route::get('/', array( 'uses' => 'LoginController@index'));
    Route::get('/login', array( 'uses' => 'LoginController@index'));
    Route::post('/', array( 'uses' => 'LoginController@postLogin'));
    Route::post('/login', array('uses' => 'LoginController@postLogin'));
    Route::get('/forgot-password', array( 'uses' =>'ForgotPasswordController@forgotPassword'));
    Route::post('/forgot-password', array('uses' =>'ForgotPasswordController@postForgotPassword'));
    Route::get('/reset/{email}/{resetCode}', array( 'uses' =>'ForgotPasswordController@resetPassword'));
    Route::post('/reset/{email}/{resetCode}', array( 'uses' =>'ForgotPasswordController@postResetPassword'));
});




Route::group(array('namespace'=>'Backend','prefix'=>'admin','middleware' => 'admin','permission'), function()
{

    Route::post('/logout', array( 'uses' => 'LoginController@logout'));
    Route::get('/dashboard', array( 'uses' => 'DashboardController@dashboard'));
    Route::get('/dashboard/campaign/{id}', array( 'uses' => 'DashboardController@getcampaign'));
    Route::get('/dashboard/todaysscanned', array( 'uses' => 'DashboardController@todaysscannedlist'));
    
    Route::get('/user/add/new', array( 'uses' => 'UserController@Add'));
    Route::post('/user/add/new', array( 'uses' => 'UserController@AddUser', 'as' => 'User.AddUser'));
    Route::get('/user/edit/{id}', array( 'uses' => 'UserController@viewEditUser'));
    Route::post('/user/edit/{id}', array( 'uses' => 'UserController@editUser', 'as' => 'User.EditUser'));
    Route::get('/user', array( 'uses' => 'UserController@listUser', 'as' => 'User.ListView'));
    Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'User.Activate']);
    Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'User.Deactivate']);
    Route::get('user/{user}/destroy', ['uses' => 'UserController@destroy', 'as' => 'User.Destroy']);
    Route::get('user/{user}/permissions', ['uses' => 'UserController@permissions', 'as' => 'User.Permissions']);
    Route::post('user/{user}/save', ['uses' => 'UserController@save']);
    Route::get('/user/{action}', array( 'uses' => 'UserController@actionUser'));
    Route::post('/user/{action}', array( 'uses' => 'UserController@statusUser'));

    Route::get('/role/add/new', array( 'uses' => 'RoleController@role'));
    Route::post('/role/add/new', array('uses' => 'RoleController@postRole', 'as' => 'Role.AddRole'));
    Route::post('/role/edit/{id}', array( 'uses' => 'RoleController@editRole', 'as' => 'Role.EditRole'));
    Route::get('/role/edit/{id}', array('uses' => 'RoleController@viewRole'));
    Route::get('/role', array( 'uses' => 'RoleController@listRole', 'as' => 'Role.ListView'));
    Route::get('role/{user}/rolepermission', ['uses' => 'RoleController@rolepermission', 'as' => 'Role.Permission']);
    Route::post('role/{user}/save', ['uses' => 'RoleController@save']);



    Route::get('/gift/add/new', array( 'uses' => 'GiftController@Add'));
    Route::post('/gift/add/new', array( 'uses' => 'GiftController@AddGift', 'as' => 'Gift.AddGift'));
    Route::get('/gift/edit/{id}', array( 'uses' => 'GiftController@viewEditGift'));
    Route::post('/gift/edit/{id}', array( 'uses' => 'GiftController@editGift', 'as' => 'Gift.EditGift'));
    Route::get('/gift', array( 'uses' => 'GiftController@listGift', 'as' => 'Gift.ListView'));
    Route::get('gift/{id}/activate', ['uses' => 'GiftController@activate', 'as' => 'Gift.Activate']);
    Route::get('gift/{id}/deactivate', ['uses' => 'GiftController@deactivate', 'as' => 'Gift.Deactivate']);
    Route::get('gift/{id}/destroy', ['uses' => 'GiftController@destroy', 'as' => 'Gift.Destroy']);
    Route::get('/gift/{action}', array( 'uses' => 'GiftController@actionGift'));
    Route::post('/gift/{action}', array( 'uses' => 'GiftController@statusGift'));
	
    Route::get('/gcampaign', array( 'uses' => 'GiftController@listGiftAssignment'));
    Route::get('/gift/assigncampign/{id}', array( 'uses' => 'GiftController@viewEditGiftAssignment'));
    Route::post('/gift/assigncampign/{id}', array( 'uses' => 'GiftController@addGiftAssignment', 'as' => 'Gift.editGiftAssignment'));
 
 
    Route::get('/qrcode/add/new', array( 'uses' => 'QrCodeController@Add'));
    Route::post('/qrcode/add/new', array( 'uses' => 'QrCodeController@AddQrCode', 'as' => 'QrCode.AddQrCode'));
    Route::get('/qrcode/edit/{id}', array( 'uses' => 'QrCodeController@viewEditQrCode'));
    Route::post('/qrcode/edit/{id}', array( 'uses' => 'QrCodeController@editQrCode', 'as' => 'QrCode.EditQrCode'));
    Route::get('/qrcode', array( 'uses' => 'QrCodeController@listQrCode', 'as' => 'QrCode.ListView'));
    Route::get('qrcode/{id}/activate', ['uses' => 'QrCodeController@activate', 'as' => 'QrCode.Activate']);
    Route::get('qrcode/{id}/deactivate', ['uses' => 'QrCodeController@deactivate', 'as' => 'QrCode.Deactivate']);
    Route::get('qrcode/{id}/destroy', ['uses' => 'QrCodeController@destroy', 'as' => 'QrCode.Destroy']);
    Route::get('/qrcode/{action}', array( 'uses' => 'QrCodeController@actionQrCode'));
    Route::post('/qrcode/{action}', array( 'uses' => 'QrCodeController@statusQrCode'));


    Route::get('/state/add/new', array( 'uses' => 'StateController@Add'));
    Route::post('/state/add/new', array( 'uses' => 'StateController@AddState', 'as' => 'State.AddState'));
    Route::get('/state/edit/{id}', array( 'uses' => 'StateController@viewEditState'));
    Route::post('/state/edit/{id}', array( 'uses' => 'StateController@editState', 'as' => 'State.EditState'));
    Route::get('/state', array( 'uses' => 'StateController@listState', 'as' => 'State.ListState'));
    Route::get('state/{id}/activate', ['uses' => 'StateController@activate', 'as' => 'State.Activate']);
    Route::get('state/{id}/deactivate', ['uses' => 'StateController@deactivate', 'as' => 'State.Deactivate']);
    Route::get('state/{id}/destroy', ['uses' => 'StateController@destroy', 'as' => 'State.Destroy']);
    Route::get('/state/{action}', array( 'uses' => 'StateController@actionState'));
    Route::post('/state/{action}', array( 'uses' => 'StateController@statusState'));

    Route::get('/city/add/new', array( 'uses' => 'CityController@Add'));
    Route::post('/city/add/new', array( 'uses' => 'CityController@AddCity', 'as' => 'City.AddCity'));
    Route::get('/city/edit/{id}', array( 'uses' => 'CityController@viewEditCity'));
    Route::post('/city/edit/{id}', array( 'uses' => 'CityController@editCity', 'as' => 'City.EditCity'));
    Route::get('/city', array( 'uses' => 'CityController@listCity', 'as' => 'City.ListCity'));
    Route::get('city/{id}/activate', ['uses' => 'CityController@activate', 'as' => 'City.Activate']);
    Route::get('city/{id}/deactivate', ['uses' => 'CityController@deactivate', 'as' => 'City.Deactivate']);
    Route::get('city/{id}/destroy', ['uses' => 'CityController@destroy', 'as' => 'City.Destroy']);
    Route::get('/city/{action}', array( 'uses' => 'CityController@actionCity'));
    Route::post('/city/{action}', array( 'uses' => 'CityController@statusCity'));

    Route::get('/bsm/add/new', array( 'uses' => 'BsmController@Add'));
    Route::post('/bsm/add/new', array( 'uses' => 'BsmController@AddBsm', 'as' => 'Bsm.AddBsm'));
    Route::get('/bsm/edit/{id}', array( 'uses' => 'BsmController@viewEditBsm'));
    Route::post('/bsm/edit/{id}', array( 'uses' => 'BsmController@editBsm', 'as' => 'Bsm.EditBsm'));
    Route::get('/bsm', array( 'uses' => 'BsmController@listBsm', 'as' => 'Bsm.ListBsm'));
    Route::get('bsm/{id}/activate', ['uses' => 'BsmController@activate', 'as' => 'Bsm.Activate']);
    Route::get('bsm/{id}/deactivate', ['uses' => 'BsmController@deactivate', 'as' => 'Bsm.Deactivate']);
    Route::get('bsm/{id}/destroy', ['uses' => 'BsmController@destroy', 'as' => 'Bsm.Destroy']);
    Route::get('/bsm/{action}', array( 'uses' => 'BsmController@actionBsm'));
    Route::post('/bsm/{action}', array( 'uses' => 'BsmController@statusBsm'));

    Route::get('/gstate/add/new', array( 'uses' => 'GiftbypincodeController@Add'));
    Route::post('/gstate/add/new', array( 'uses' => 'GiftbypincodeController@AddGpin', 'as' => 'Gpin.AddGpin'));
    Route::get('/gstate/edit/{id}', array( 'uses' => 'GiftbypincodeController@viewEditGpin'));
    Route::post('/gstate/edit/{id}', array( 'uses' => 'GiftbypincodeController@editGpin', 'as' => 'Gpin.EditGpin'));
    Route::get('/gstate', array( 'uses' => 'GiftbypincodeController@listGpin', 'as' => 'Gpin.ListGpin'));
    Route::get('gstate/{id}/activate', ['uses' => 'GiftbypincodeController@activate', 'as' => 'Gpin.Activate']);
    Route::get('gstate/{id}/deactivate', ['uses' => 'GiftbypincodeController@deactivate', 'as' => 'Gpin.Deactivate']);
    Route::get('gstate/{id}/destroy', ['uses' => 'GiftbypincodeController@destroy', 'as' => 'Gpin.Destroy']);
    Route::get('/gstate/{action}', array( 'uses' => 'GiftbypincodeController@actionGpin'));
    Route::post('/gstate/{action}', array( 'uses' => 'GiftbypincodeController@statusGpin'));

Route::get('/gift/assigncampign/{id}', array( 'uses' => 'GiftController@viewEditGiftAssignment'));
    Route::post('/gift/assigncampign/{id}', array( 'uses' => 'GiftController@addGiftAssignment', 'as' => 'Gift.editGiftAssignment'));
    
    Route::get('/gcampaign', array( 'uses' => 'GiftController@listGiftAssignment'));

    Route::get('/qrcode-print', array( 'uses' => 'QrCodeController@listQrCodePrint', 'as' => 'QrCode.ListView'));
    Route::get('/generate-pdf/{id}', array( 'uses' => 'HomeController@generatePDF', 'as' => 'QrCode.PDF'));
Route::get('/generate-jpeg/{id}', array( 'uses' => 'HomeController@generateJPEG', 'as' => 'QrCode.PDF'));


    Route::get('/contact', array( 'uses' => 'ContactController@listContact', 'as' => 'Contact.ListView'));
    Route::get('/contact/edit/{id}', array( 'uses' => 'ContactController@viewEditContact'));
    Route::post('/contact/edit/{id}', array( 'uses' => 'ContactController@editContact', 'as' => 'Contact.EditContact'));
    Route::get('/contact', array( 'uses' => 'ContactController@listContact', 'as' => 'Contact.ListContact'));
    Route::get('contact/{id}/activate', ['uses' => 'ContactController@activate', 'as' => 'Contact.Activate']);
    Route::get('contact/{id}/deactivate', ['uses' => 'ContactController@deactivate', 'as' => 'Contact.Deactivate']);
    Route::get('contact/{id}/destroy', ['uses' => 'ContactController@destroy', 'as' => 'Contact.Destroy']);
    Route::get('/contact/{action}', array( 'uses' => 'ContactController@actionContact'));
    Route::post('/contact/{action}', array( 'uses' => 'ContactController@statusContact'));
    Route::get('/getgift','AjaxController@selectgiftByCampaign');
    
    
    Route::get('/generatepdf/pdfbychunks/{id}', array( 'uses' => 'GeneratePdfController@viewgeneratePDFbyChunks'));
    Route::get('/generatepdf/printpdf/{id}', array( 'uses' => 'GeneratePdfController@printQrCode', 'as' => 'QrCode.PDF'));
    
    
    
    
     Route::get('/giftsequence', array( 'uses' => 'GiftSequenceController@listGiftSequence', 'as' => 'Gift.ListView'));
     
     
    Route::get('/giftsequence/add/new', array( 'uses' => 'GiftSequenceController@Add'));
    Route::post('/giftsequence/add/new', array( 'uses' => 'GiftSequenceController@AddGiftSequence', 'as' => 'Gift.AddGift'));
    Route::get('/giftsequence/edit/{id}', array( 'uses' => 'GiftSequenceController@viewEditGiftSequence'));
    Route::post('/giftsequence/edit/{id}', array( 'uses' => 'GiftSequenceController@editGiftSequence', 'as' => 'Gift.EditGift'));
    

});
