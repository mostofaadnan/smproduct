<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\ExtensionController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\ItemTypeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ManualGatewayController;
use App\Http\Controllers\Admin\MlmController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\PtcController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SmsTemplateController;
use App\Http\Controllers\Admin\SponsorCommisionPlanController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController as AuthResetPasswordController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\Gateway\blockchain\ProcessController as BlockchainProcessController;
use App\Http\Controllers\Gateway\blockio\ProcessController as BlockioProcessController;
use App\Http\Controllers\Gateway\cashmaal\ProcessController as CashmaalProcessController;
use App\Http\Controllers\Gateway\coinbase_commerce\ProcessController as Coinbase_commerceProcessController;
use App\Http\Controllers\Gateway\coingate\ProcessController as CoingateProcessController;
use App\Http\Controllers\Gateway\coinpayments\ProcessController as CoinpaymentsProcessController;
use App\Http\Controllers\Gateway\coinpayments_fiat\ProcessController as Coinpayments_fiatProcessController;
use App\Http\Controllers\Gateway\flutterwave\ProcessController as FlutterwaveProcessController;
use App\Http\Controllers\Gateway\instamojo\ProcessController as InstamojoProcessController;
use App\Http\Controllers\Gateway\mollie\ProcessController as MollieProcessController;
use App\Http\Controllers\Gateway\payeer\ProcessController as PayeerProcessController;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Gateway\paypal\ProcessController;
use App\Http\Controllers\Gateway\paypal_sdk_2\ProcessController as Paypal_sdk_2ProcessController;
use App\Http\Controllers\Gateway\paystack\ProcessController as PaystackProcessController;
use App\Http\Controllers\Gateway\paytm\ProcessController as PaytmProcessController;
use App\Http\Controllers\Gateway\perfect_money\ProcessController as Perfect_moneyProcessController;
use App\Http\Controllers\Gateway\razorpay\ProcessController as RazorpayProcessController;
use App\Http\Controllers\Gateway\skrill\ProcessController as SkrillProcessController;
use App\Http\Controllers\Gateway\stripe\ProcessController as StripeProcessController;
use App\Http\Controllers\Gateway\stripe_js\ProcessController as Stripe_jsProcessController;
use App\Http\Controllers\Gateway\stripe_v3\ProcessController as Stripe_v3ProcessController;
use App\Http\Controllers\Gateway\voguepay\ProcessController as VoguepayProcessController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PtcController as ControllersPtcController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReportController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/cron', [CronController::class, 'cron'])->name('bv.matching.cron');

Route::namespace('Gateway')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('paypal', [ProcessController::class, 'ipn'])->name('paypal');
    Route::get('paypal_sdk', [Paypal_sdk_2ProcessController::class, 'ipn'])->name('paypal_sdk');
    Route::post('perfect_money', [Perfect_moneyProcessController::class, 'ipn'])->name('perfect_money');
    Route::post('stripe', [StripeProcessController::class, 'ipn'])->name('stripe');
    Route::post('stripe_js', [Stripe_jsProcessController::class, 'ipn'])->name('stripe_js');
    Route::post('stripe_v3', [Stripe_v3ProcessController::class, 'ipn'])->name('stripe_v3');
    Route::post('skrill', [SkrillProcessController::class, 'ipn'])->name('skrill');
    Route::post('paytm', [PaytmProcessController::class, 'ipn'])->name('paytm');
    Route::post('payeer', [PayeerProcessController::class, 'ipn'])->name('payeer');
    Route::post('paystack', [PaystackProcessController::class, 'ipn'])->name('paystack');
    Route::post('voguepay', [VoguepayProcessController::class, 'ipn'])->name('voguepay');
    Route::get('flutterwave/{trx}/{type}', [FlutterwaveProcessController::class, 'ipn'])->name('flutterwave');
    Route::post('razorpay', [RazorpayProcessController::class, 'ipn'])->name('razorpay');
    Route::post('instamojo', [InstamojoProcessController::class, 'ipn'])->name('instamojo');
    Route::get('blockchain', [BlockchainProcessController::class, 'ipn'])->name('blockchain');
    Route::get('blockio', [BlockioProcessController::class, 'ipn'])->name('blockio');
    Route::post('coinpayments', [CoinpaymentsProcessController::class, 'ipn'])->name('coinpayments');
    Route::post('coinpayments_fiat', [Coinpayments_fiatProcessController::class, 'ipn'])->name('coinpayments_fiat');
    Route::post('coingate', [CoingateProcessController::class, 'ipn'])->name('coingate');
    Route::post('coinbase_commerce', [Coinbase_commerceProcessController::class, 'ipn'])->name('coinbase_commerce');
    Route::get('mollie', [MollieProcessController::class, 'ipn'])->name('mollie');
    Route::post('cashmaal', [CashmaalProcessController::class, 'ipn'])->name('cashmaal');
});

// User Support Ticket
Route::prefix('ticket')->group(function () {
    Route::get('/', [TicketController::class, 'supportTicket'])->name('ticket');
    Route::get('/new', [TicketController::class, 'openSupportTicket'])->name('ticket.open');
    Route::post('/create', [TicketController::class, 'storeSupportTicket'])->name('ticket.store');
    Route::get('/view/{ticket}', [TicketController::class, 'viewTicket'])->name('ticket.view');
    Route::post('/reply/{ticket}', [TicketController::class, 'replyTicket'])->name('ticket.reply');
    Route::get('/download/{ticket}', [TicketController::class, 'ticketDownload'])->name('ticket.download');
});

/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/', [LoginController::class, 'login'])->name('login');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        // Admin Password Reset
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
        Route::post('password/reset', [ForgotPasswordController::class, 'sendResetLinkEmail']);
        Route::post('password/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify-code');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.change-link');
        Route::post('password/reset/change', [ResetPasswordController::class, 'reset'])->name('password.change');
    });

    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('profile',  [AdminController::class, 'profile'])->name('profile');
        Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
        Route::get('password', [AdminController::class, 'password'])->name('password');
        Route::post('password', [AdminController::class, 'passwordUpdate'])->name('password.update');

        Route::get('notification/read/{id}', [AdminController::class, 'notificationRead'])->name('notification.read');
        Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');

        // Users Manager
        Route::get('users', [ManageUsersController::class, 'allUsers'])->name('users.all');
        Route::get('users/active', [ManageUsersController::class, 'activeUsers'])->name('users.active');
        Route::get('users/banned', [ManageUsersController::class, 'bannedUsers'])->name('users.banned');
        Route::get('users/email-verified',  [ManageUsersController::class, 'emailVerifiedUsers'])->name('users.emailVerified');
        Route::get('users/email-unverified',  [ManageUsersController::class, 'emailUnverifiedUsers'])->name('users.emailUnverified');
        Route::get('users/sms-unverified',  [ManageUsersController::class, 'smsUnverifiedUsers'])->name('users.smsUnverified');
        Route::get('users/sms-verified',  [ManageUsersController::class, 'smsVerifiedUsers'])->name('users.smsVerified');

        Route::get('users/{scope}/search',  [ManageUsersController::class, 'search'])->name('users.search');
        Route::get('user/detail/{id}',  [ManageUsersController::class, 'detail'])->name('users.detail');
        Route::get('user/referral/{id}',  [ManageUsersController::class, 'userRef'])->name('users.ref');
        Route::post('user/update/{id}',  [ManageUsersController::class, 'update'])->name('users.update');
        Route::post('user/add-sub-balance/{id}',  [ManageUsersController::class, 'addSubBalance'])->name('users.addSubBalance');
        Route::get('user/send-email/{id}',  [ManageUsersController::class, 'showEmailSingleForm'])->name('users.email.single');
        Route::post('user/send-email/{id}',  [ManageUsersController::class, 'sendEmailSingle'])->name('users.email.single');
        Route::get('user/transactions/{id}',  [ManageUsersController::class, 'transactions'])->name('users.transactions');
        Route::get('user/deposits/{id}',  [ManageUsersController::class, 'deposits'])->name('users.deposits');
        Route::get('user/deposits/via/{method}/{type?}/{userId}',  [ManageUsersController::class, 'depViaMethod'])->name('users.deposits.method');
        Route::get('user/withdrawals/{id}',  [ManageUsersController::class, 'withdrawals'])->name('users.withdrawals');
        Route::get('user/withdrawals/via/{method}/{type?}/{userId}',  [ManageUsersController::class, 'withdrawalsViaMethod'])->name('users.withdrawals.method');
        // Login History
        Route::get('users/login/history/{id}',  [ManageUsersController::class, 'userLoginHistory'])->name('users.login.history.single');

        Route::get('users/send-email',  [ManageUsersController::class, 'showEmailAllForm'])->name('users.email.all');
        Route::post('users/send-email',  [ManageUsersController::class, 'sendEmailAll'])->name('users.email.send');



        // mlm plan
        Route::get('plans', [MlmController::class, 'plan'])->name('plan');
        Route::post('plan/store', [MlmController::class, 'planStore'])->name('plan.store');

        Route::post('plan/update', [MlmController::class, 'planUpdate'])->name('plan.update');

        // matching bonus
        Route::post('matching-bonus/update', [MlmController::class, 'matchingUpdate'])->name('matching-bonus.update');

        // tree
        Route::get('/tree/{id}',  [ManageUsersController::class, 'tree'])->name('users.single.tree');
        Route::get('/user/tree/{user}',  [ManageUsersController::class, 'otherTree'])->name('users.other.tree');
        Route::get('/user/tree/search',  [ManageUsersController::class, 'otherTree'])->name('users.other.tree.search');

        Route::get('notice', [GeneralSettingController::class, 'noticeIndex'])->name('setting.notice');
        Route::post('notice/update', [GeneralSettingController::class, 'noticeUpdate'])->name('setting.notice.update');


        /*
        =================PTC================
        */

        //PTC ADS
        Route::get('/ptc',  [PtcController::class, 'index'])->name('ptc.index');
        Route::get('/ptc/create',  [PtcController::class, 'create'])->name('ptc.create');
        Route::post('/ptc/store',  [PtcController::class, 'store'])->name('ptc.store');
        Route::get('/ptc/edit/{id}',  [PtcController::class, 'edit'])->name('ptc.edit');
        Route::post('/ptc/update/{id}',  [PtcController::class, 'update'])->name('ptc.update');
        //Sponsore Generation
        Route::get('/sponsore-generation',  [SponsorCommisionPlanController::class, 'index'])->name('sponsor_generetion_plans.index');
        Route::get('/sponsore-generation/create',  [SponsorCommisionPlanController::class, 'create'])->name('sponsor_generetion_plans.create');
        Route::get('/sponsore-generation/add-plan',  [SponsorCommisionPlanController::class, 'addPlan'])->name('sponsor_generetion_plans.addPlan');
        Route::post('/sponsore-generation/store',  [SponsorCommisionPlanController::class, 'store'])->name('sponsor_generetion_plans.store');
        Route::get('/sponsore-generation/edit/{id}',  [SponsorCommisionPlanController::class, 'edit'])->name('sponsor_generetion_plans.edit');
        Route::post('/sponsore-generation/update/{id}',  [SponsorCommisionPlanController::class, 'update'])->name('sponsor_generetion_plans.update');

        //items
        //Route::resource('item_types', ItemTypeController::class);
        Route::get('/item_types',  [ItemTypeController::class, 'index'])->name('item_types.index');
        Route::get('/item_types/create',  [ItemTypeController::class, 'create'])->name('item_types.create');
        Route::post('/item_types/store',  [ItemTypeController::class, 'store'])->name('item_types.store');
        Route::get('/item_types/edit/{id}',  [ItemTypeController::class, 'edit'])->name('item_types.edit');
        Route::post('/item_types/update/{id}',  [ItemTypeController::class, 'update'])->name('item_types.update');
        
        // Subscriber
        Route::get('subscriber', [SubscriberController::class, 'index'])->name('subscriber.index');
        Route::get('subscriber/send-email', [SubscriberController::class, 'sendEmailForm'])->name('subscriber.sendEmail');
        Route::post('subscriber/remove', [SubscriberController::class, 'remove'])->name('subscriber.remove');
        Route::post('subscriber/send-email', [SubscriberController::class, 'sendEmail'])->name('subscriber.sendEmail');


        // Deposit Gateway
        Route::name('gateway.')->prefix('gateway')->group(function () {
            // Automatic Gateway
            Route::get('automatic', [GatewayController::class, 'index'])->name('automatic.index');
            Route::get('automatic/edit/{alias}', [GatewayController::class, 'edit'])->name('automatic.edit');
            Route::post('automatic/update/{code}', [GatewayController::class, 'update'])->name('automatic.update');
            Route::post('automatic/remove/{code}', [GatewayController::class, 'remove'])->name('automatic.remove');
            Route::post('automatic/activate', [GatewayController::class, 'activate'])->name('automatic.activate');
            Route::post('automatic/deactivate', [GatewayController::class, 'deactivate'])->name('automatic.deactivate');



            // Manual Methods
            Route::get('manual', [ManualGatewayController::class, 'index'])->name('manual.index');
            Route::get('manual/new', [ManualGatewayController::class, 'create'])->name('manual.create');
            Route::post('manual/new', [ManualGatewayController::class, 'store'])->name('manual.store');
            Route::get('manual/edit/{alias}', [ManualGatewayController::class, 'edit'])->name('manual.edit');
            Route::post('manual/update/{id}', [ManualGatewayController::class, 'update'])->name('manual.update');
            Route::post('manual/activate', [ManualGatewayController::class, 'activate'])->name('manual.activate');
            Route::post('manual/deactivate', [ManualGatewayController::class, 'deactivate'])->name('manual.deactivate');
        });


        // DEPOSIT SYSTEM
        Route::name('deposit.')->prefix('deposit')->group(function () {
            Route::get('/', [DepositController::class, 'deposit'])->name('list');
            Route::get('pending', [DepositController::class, 'pending'])->name('pending');
            Route::get('rejected', [DepositController::class, 'rejected'])->name('rejected');
            Route::get('approved', [DepositController::class, 'approved'])->name('approved');
            Route::get('successful', [DepositController::class, 'successful'])->name('successful');
            Route::get('details/{id}', [DepositController::class, 'details'])->name('details');

            Route::post('reject', [DepositController::class, 'reject'])->name('reject');
            Route::post('approve', [DepositController::class, 'approve'])->name('approve');
            Route::get('via/{method}/{type?}', [DepositController::class, 'depViaMethod'])->name('method');
            Route::get('/{scope}/search', [DepositController::class, 'search'])->name('search');
            Route::get('date-search/{scope}', [DepositController::class, 'dateSearch'])->name('dateSearch');
        });


        // WITHDRAW SYSTEM
        Route::name('withdraw.')->prefix('withdraw')->group(function () {
            Route::get('pending', [WithdrawalController::class, 'pending'])->name('pending');
            Route::get('approved', [WithdrawalController::class, 'approved'])->name('approved');
            Route::get('rejected', [WithdrawalController::class, 'rejected'])->name('rejected');
            Route::get('log', [WithdrawalController::class, 'log'])->name('log');
            Route::get('via/{method_id}/{type?}', [WithdrawalController::class, 'logViaMethod'])->name('method');
            Route::get('{scope}/search', [WithdrawalController::class, 'search'])->name('search');
            Route::get('date-search/{scope}', [WithdrawalController::class, 'dateSearch'])->name('dateSearch');
            Route::get('details/{id}', [WithdrawalController::class, 'details'])->name('details');
            Route::post('approve', [WithdrawalController::class, 'approve'])->name('approve');
            Route::post('reject', [WithdrawalController::class, 'reject'])->name('reject');


            // Withdraw Method
            Route::get('method/', [WithdrawMethodController::class, 'methods'])->name('method.index');
            Route::get('method/create', [WithdrawMethodController::class, 'create'])->name('method.create');
            Route::post('method/create', [WithdrawMethodController::class, 'store'])->name('method.store');
            Route::get('method/edit/{id}', [WithdrawMethodController::class, 'edit'])->name('method.edit');
            Route::post('method/edit/{id}', [WithdrawMethodController::class, 'update'])->name('method.update');
            Route::post('method/activate', [WithdrawMethodController::class, 'activate'])->name('method.activate');
            Route::post('method/deactivate', [WithdrawMethodController::class, 'deactivate'])->name('method.deactivate');
        });

        // Report
        Route::get('report/referral-commission', [ReportController::class, 'refCom'])->name('report.refCom');
        Route::get('report/binary-commission', [ReportController::class, 'binary'])->name('report.binaryCom');
        Route::get('report/invest', [ReportController::class, 'invest'])->name('report.invest');

        Route::get('report/bv-log', [ReportController::class, 'bvLog'])->name('report.bvLog');
        Route::get('report/bv-log/{id}', [ReportController::class, 'singleBvLog'])->name('report.single.bvLog');

        Route::get('report/transaction', [ReportController::class, 'transaction'])->name('report.transaction');
        Route::get('report/transaction/search', [ReportController::class, 'transactionSearch'])->name('report.transaction.search');

        //  PTC VIEW REPORT
        Route::get('report/ptcview', [ReportController::class, 'ptcview'])->name('report.ptcview');
        Route::get('report/ptcview/search', [ReportController::class, 'ptcviewSearch'])->name('report.ptcview.search');

        Route::get('report/login/history', [ReportController::class, 'loginHistory'])->name('report.login.history');
        Route::get('report/login/ipHistory/{ip}', [ReportController::class, 'loginIpHistory'])->name('report.login.ipHistory');


        // Admin Support
        Route::get('tickets', [SupportTicketController::class, 'tickets'])->name('ticket');
        Route::get('tickets/pending', [SupportTicketController::class, 'pendingTicket'])->name('ticket.pending');
        Route::get('tickets/closed', [SupportTicketController::class, 'closedTicket'])->name('ticket.closed');
        Route::get('tickets/answered', [SupportTicketController::class, 'answeredTicket'])->name('ticket.answered');
        Route::get('tickets/view/{id}', [SupportTicketController::class, 'ticketReply'])->name('ticket.view');
        Route::post('ticket/reply/{id}', [SupportTicketController::class, 'ticketReplySend'])->name('ticket.reply');
        Route::get('ticket/download/{ticket}', [SupportTicketController::class, 'ticketDownload'])->name('ticket.download');
        Route::post('ticket/delete', [SupportTicketController::class, 'ticketDelete'])->name('ticket.delete');


        // Language Manager
        Route::get('/language', [LanguageController::class, 'langManage'])->name('language.manage');
        Route::post('/language', [LanguageController::class, 'langStore'])->name('language.manage.store');
        Route::post('/language/delete/{id}', [LanguageController::class, 'langDel'])->name('language.manage.del');
        Route::post('/language/update/{id}', [LanguageController::class, 'langUpdatepp'])->name('language.manage.update');
        Route::get('/language/edit/{id}', [LanguageController::class, 'langEdit'])->name('language.key');
        Route::post('/language/import', [LanguageController::class, 'langImport'])->name('language.import_lang');



        Route::post('language/store/key/{id}', [LanguageController::class, 'storeLanguageJson'])->name('language.store.key');
        Route::post('language/delete/key/{id}', [LanguageController::class, 'deleteLanguageJson'])->name('language.delete.key');
        Route::post('language/update/key/{id}', [LanguageController::class, 'updateLanguageJson'])->name('language.update.key');



        // General Setting
        Route::get('general-setting', [GeneralSettingController::class, 'index'])->name('setting.index');
        Route::post('general-setting', [GeneralSettingController::class, 'update'])->name('setting.update');

        // Logo-Icon
        Route::get('setting/logo-icon', [GeneralSettingController::class, 'logoIcon'])->name('setting.logo_icon');
        Route::post('setting/logo-icon', [GeneralSettingController::class, 'logoIconUpdate'])->name('setting.logo_icon');

        // Plugin
        Route::get('extensions', [ExtensionController::class, 'index'])->name('extensions.index');
        Route::post('extensions/update/{id}', [ExtensionController::class, 'update'])->name('extensions.update');
        Route::post('extensions/activate', [ExtensionController::class, 'activate'])->name('extensions.activate');
        Route::post('extensions/deactivate', [ExtensionController::class, 'deactivate'])->name('extensions.deactivate');


        // Email Setting
        Route::get('email-template/global', [EmailTemplateController::class, 'emailTemplate'])->name('email.template.global');
        Route::post('email-template/global', [EmailTemplateController::class, 'emailTemplateUpdate'])->name('email.template.global');
        Route::get('email-template/setting', [EmailTemplateController::class, 'emailSetting'])->name('email.template.setting');
        Route::post('email-template/setting', [EmailTemplateController::class, 'emailSettingUpdate'])->name('email.template.setting');
        Route::get('email-template/index', [EmailTemplateController::class, 'index'])->name('email.template.index');
        Route::get('email-template/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email.template.edit');
        Route::post('email-template/{id}/update', [EmailTemplateController::class, 'update'])->name('email.template.update');
        Route::post('email-template/send-test-mail', [EmailTemplateController::class, 'sendTestMail'])->name('email.template.sendTestMail');


        // SMS Setting
        Route::get('sms-template/global', [SmsTemplateController::class, 'smsSetting'])->name('sms.template.global');
        Route::post('sms-template/global', [SmsTemplateController::class, 'smsSettingUpdate'])->name('sms.template.global');
        Route::get('sms-template/index', [SmsTemplateController::class, 'index'])->name('sms.template.index');
        Route::get('sms-template/edit/{id}', [SmsTemplateController::class, 'edit'])->name('sms.template.edit');
        Route::post('sms-template/update/{id}', [SmsTemplateController::class, 'update'])->name('sms.template.update');
        Route::post('email-template/send-test-sms', [SmsTemplateController::class, 'sendTestSMS'])->name('sms.template.sendTestSMS');

        // SEO
        Route::get('seo', [FrontendController::class, 'seoEdit'])->name('seo');


        // Frontend
        Route::name('frontend.')->prefix('frontend')->group(function () {

            Route::get('templates', [FrontendController::class, 'templates'])->name('templates');
            Route::post('templates', [FrontendController::class, 'templatesActive'])->name('templates.active');

            Route::get('frontend-sections/{key}', [FrontendController::class, 'frontendSections'])->name('sections');
            Route::post('frontend-content/{key}', [FrontendController::class, 'frontendContent'])->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', [FrontendController::class, 'frontendElement'])->name('sections.element');
            Route::post('remove', [FrontendController::class, 'remove'])->name('remove');

            // Page Builder
            Route::get('manage-pages', [PageBuilderController::class, 'managePages'])->name('manage.pages');
            Route::post('manage-pages', [PageBuilderController::class, 'managePagesSave'])->name('manage.pages.save');
            Route::post('manage-pages/update', [PageBuilderController::class, 'managePagesUpdate'])->name('manage.pages.update');
            Route::post('manage-pages/delete', [PageBuilderController::class, 'managePagesDelete'])->name('manage.pages.delete');
            Route::get('manage-section/{id}', [PageBuilderController::class, 'manageSection'])->name('manage.section');
            Route::post('manage-section/{id}', [PageBuilderController::class, 'manageSectionUpdate'])->name('manage.section.update');
        });
    });
});




/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/


Route::name('user.')->group(function () {
    Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthLoginController::class, 'login']);
    Route::get('logout', [AuthLoginController::class, 'logout'])->name('logout');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->middleware('regStatus');

    Route::get('password/reset', [AuthForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AuthForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/code-verify', [AuthForgotPasswordController::class, 'codeVerify'])->name('password.code_verify');
    Route::post('password/reset', [AuthResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset/{token}', [AuthResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/verify-code', [AuthForgotPasswordController::class, 'verifyCode'])->name('password.verify-code');
});

Route::name('user.')->prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('authorization', [AuthorizationController::class, 'authorizeForm'])->name('authorization');
        Route::get('resend-verify', [AuthorizationController::class, 'sendVerifyCode'])->name('send_verify_code');
        Route::post('verify-email', [AuthorizationController::class, 'emailVerification'])->name('verify_email');
        Route::post('verify-sms', [AuthorizationController::class, 'smsVerification'])->name('verify_sms');
        Route::post('verify-g2fa', [AuthorizationController::class, 'g2faVerification'])->name('go2fa.verify');

        Route::middleware(['checkStatus'])->group(function () {
            Route::get('dashboard', [UserController::class, 'home'])->name('home');

            Route::get('profile-setting', [UserController::class, 'profile'])->name('profile-setting');
            Route::post('profile-setting', [UserController::class, 'submitProfile']);
            Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
            Route::post('change-password', [UserController::class, 'submitPassword']);

            //2FA
            Route::get('twofactor', [UserController::class, 'show2faForm'])->name('twofactor');
            Route::post('twofactor/enable', [UserController::class, 'create2fa'])->name('twofactor.enable');
            Route::post('twofactor/disable', [UserController::class, 'disable2fa'])->name('twofactor.disable');
            Route::get('login/history', [UserController::class, 'userLoginHistory'])->name('login.history');


            //plan
            Route::get('/plan', [PlanController::class, 'planIndex'])->name('plan.index');
            Route::post('/plan', [PlanController::class, 'planStore'])->name('plan.purchase');
            Route::get('/referral-log', [UserController::class, 'referralCom'])->name('referral.log');

            Route::get('/binary-log', [PlanController::class, 'binaryCom'])->name('binary.log');
            Route::get('/binary-summery', [PlanController::class, 'binarySummery'])->name('binary.summery');
            Route::get('/bv-log', [PlanController::class, 'bvlog'])->name('bv.log');
            Route::get('/referrals', [PlanController::class, 'myRefLog'])->name('my.ref');
            Route::get('/tree', [PlanController::class, 'myTree'])->name('my.tree');
            Route::get('/tree/{user}', [PlanController::class, 'otherTree'])->name('other.tree');
            Route::get('/tree/search', [PlanController::class, 'otherTree'])->name('other.tree.search');

            //balance transfer
            Route::get('/transfer', [UserController::class, 'indexTransfer'])->name('balance.transfer');
            Route::post('/transfer', [UserController::class, 'balanceTransfer'])->name('balance.transfer.post');
            Route::post('/search-user', [UserController::class, 'searchUser'])->name('search.user');

            //PTC
            Route::get('ptc',  [ControllersPtcController::class, 'index'])->name('ptc.index');
            Route::get('ptc-show/{hash}',  [ControllersPtcController::class, 'show'])->name('ptc.show');
            Route::post('ptc-confirm/{hash}',  [ControllersPtcController::class, 'confirm'])->name('ptc.confirm');
            Route::get('ptc-clicks',  [ControllersPtcController::class, 'clicks'])->name('ptc.clicks');


            //Report
            Route::get('report/deposit/log', [UserReportController::class, 'depositHistory'])->name('report.deposit');
            Route::get('report/invest/log', [UserReportController::class, 'investLog'])->name('report.invest');
            Route::get('report/transactions/log', [UserReportController::class, 'transactions'])->name('report.transactions');
            Route::get('report/withdraw/log', [UserReportController::class, 'withdrawLog'])->name('report.withdraw');
            Route::get('report/referral/commission', [UserReportController::class, 'refCom'])->name('report.refCom');
            Route::get('report/binary/commission', [UserReportController::class, 'binaryCom'])->name('report.binaryCom');



            // Deposit
            Route::any('/deposit', [PaymentController::class, 'deposit'])->name('deposit');
            Route::post('deposit/insert', [PaymentController::class, 'depositInsert'])->name('deposit.insert');
            Route::get('deposit/preview', [PaymentController::class, 'depositPreview'])->name('deposit.preview');
            Route::get('deposit/confirm', [PaymentController::class, 'depositConfirm'])->name('deposit.confirm');
            Route::get('deposit/manual', [PaymentController::class, 'manualDepositConfirm'])->name('deposit.manual.confirm');
            Route::post('deposit/manual', [PaymentController::class, 'manualDepositUpdate'])->name('deposit.manual.update');
            Route::get('deposit/history', [UserController::class, 'depositHistory'])->name('deposit.history');

            // Withdraw
            Route::get('/withdraw', [UserController::class, 'withdrawMoney'])->name('withdraw');
            Route::post('/withdraw', [UserController::class, 'withdrawStore'])->name('withdraw.money');
            Route::get('/withdraw/preview', [UserController::class, 'withdrawPreview'])->name('withdraw.preview');
            Route::post('/withdraw/preview', [UserController::class, 'withdrawSubmit'])->name('withdraw.submit');
            Route::get('/withdraw/history', [UserController::class, 'withdrawLog'])->name('withdraw.history');
        });
    });
});

Route::post('/check/referral', [SiteController::class, 'CheckUsername'])->name('check.referral');

Route::post('/get/user/position', [SiteController::class, 'userPosition'])->name('get.user.position');

Route::post('subscriber', [SiteController::class, 'subscriberStore'])->name('subscriber.store');

Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'contactSubmit'])->name('contact.send');
Route::get('/change/{lang?}', [SiteController::class, 'changeLanguage'])->name('lang');

Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/blog/details/{slug}/{id}', [SiteController::class, 'singleBlog'])->name('singleBlog');
Route::get('/terms-conditions', [SiteController::class, 'terms'])->name('terms');

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/{slug}', [SiteController::class, 'pages'])->name('pages');

Route::get('placeholder-image/{size}', [SiteController::class, 'placeholderImage'])->name('placeholderImage');
Route::get('links/{slug}', [SiteController::class, 'links'])->name('links');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
