<?php


Auth::routes();

// Route::get('/', function () {

//     return view('auth.login');

// });

Route::get('/', 'AdminLoginController@showLoginForm');

Route::get('/home', 'HomeController@index')->name('home');
 

/// user personal settings

Route::get('/user-settings', 'UserSettingsController@userSettings');

Route::post('/update-user-settings', 'UserSettingsController@updateUserSettings');


//===== All Settings =====//

// basic settings........

Route::get('/edit-settings', 'SettingsController@editSettings');

Route::post('/update-settings', 'SettingsController@updateSettings');



// user access role......

Route::get('/edit-role', 'SettingsController@editRole');

Route::post('/update-role', 'SettingsController@updateRole');



// Table.....

Route::post('/table-up', 'SettingsController@tableEdit');

Route::get('/table-delete/{id}', 'SettingsController@tableDelete');

Route::resource('/table', 'SettingsController');


// Vat......

Route::get('/vat-list', 'SettingsController@vatList');

Route::post('/vat-create', 'SettingsController@vatCreate');

Route::post('/vat-update', 'SettingsController@vatUpdate');




//===== Order Managements =====//

// create sales....

Route::get('/create-sales', 'SalesController@createSales');
Route::get('/search-pro-by-cat', 'SalesController@searchByProCat');
Route::get('/search-pro-by-name', 'SalesController@searchByProName');
Route::get('/search-order-date', 'SalesController@searchOrderDate');
Route::get('/search-order-date2', 'SalesController@searchOrderDate2');
Route::get('/search-order-date-company', 'SalesController@searchOrderDateCompany');


    
// cart functions........   

Route::get('cart/remove/', 'SalesController@removeItem');

Route::get('cart/update', 'SalesController@update');

Route::get('/addTo', 'SalesController@addToCart');

Route::post('/destoryCart', 'SalesController@cartDestory');



// CheckOut.........

Route::post('/save-order', 'SalesController@saveOrder');

Route::get('/order-list', 'SalesController@orderList');

Route::get('/view-order/{id}', 'SalesController@viewOrder');

Route::get('/print-order-page/{id}', 'SalesController@printOrderPage');
Route::get('/view-order-calan/{id}', 'SalesController@OrderViewCalan');



// cancel order.......

Route::get('/cancel-order-list', 'SalesController@cancelOrderList');

Route::get('/cancel-order', 'SalesController@cancelOrder');

Route::get('/return-cancel-order', 'SalesController@ReturnCancelOrder');

Route::get('/search-cancel-order-date', 'SalesController@searchOrderList');



// Payment....
 
Route::post('/add-payment', 'SalesController@addDuePayment');

Route::get('/view-payment', 'SalesController@viewPayment');



//===== Category & Product Managements =====//


// category.....  


Route::get('/categories','ProductController@get_categories');

Route::get('/search-generics', 'ProductController@search_generics');

Route::get('/category-list', 'ProductController@categoryList');

Route::post('/save-category', 'ProductController@saveCategory');

Route::post('/update-category', 'ProductController@updateCategory');

//Route::get('/delete-category/{id}', 'ProductController@deleteCategory');



// Type.....

Route::get('/type-list', 'ProductController@typeList');

Route::post('/save-type', 'ProductController@saveType');

Route::post('/update-type', 'ProductController@updateType');





// product.....

Route::get('/add-product', 'ProductController@addProduct');

Route::post('/save-product', 'ProductController@saveProduct');

Route::post('/save-product2', 'ProductController@saveProduct2');

Route::get('/product-list', 'ProductController@productList');

Route::post('/update-product', 'ProductController@updateProduct');

Route::get('/view-product', 'ProductController@viewProduct');

Route::get('/search-product-list', 'ProductController@searchProductList');

//Route::get('/delete-product/{id}','ProductController@deleteProduct');


    

// Stock.........

Route::get('/out-of-stock', 'StockController@outOfStock');

Route::get('/stock', 'StockController@addStock');

Route::post('/update-stock', 'StockController@updateStock');

Route::get('/stock-list', 'StockController@stockList');

Route::get('/view-stock', 'StockController@viewStock');

Route::get('/search-stock-list', 'StockController@searchStockList');



// wastage........

Route::get('/wastage', 'WastageController@addWastage');

Route::post('/store-wastage', 'WastageController@storeWastage');

Route::post('/store-wastage2', 'WastageController@storeWastage2');

Route::get('/view-wastage', 'WastageController@viewWastage');

Route::get('/search-wastage-list', 'WastageController@searchWastageList');


Route::get('/get-purchase-price-list', 'WastageController@getPurchasePriceList');







//===== Customer Managemets =====//


// customer...........

Route::get('/view-payment-customer', 'CustomerController@viewPayment');
	
Route::get('/all-prescription', 'CustomerController@all_prescription');

Route::post('/add-prescription', 'CustomerController@add_prescription');


Route::get('/customer-list', 'CustomerController@customerList');

Route::get('/customer-group-list', 'CustomerController@customerGroupList');

Route::post('/save-customer', 'CustomerController@saveCustomer');

Route::post('/save-customer-group', 'CustomerController@saveCustomerGroup');

Route::post('/update-customer', 'CustomerController@updateCustomer');

Route::post('/update-customer-group', 'CustomerController@updateCustomerGroup');

Route::get('/view-customer', 'CustomerController@viewCustomer');

Route::get('/view-customer-due-orders', 'CustomerController@viewCustomerDueOrders');

Route::get('/search-customer-list', 'CustomerController@searchCustomerList');

Route::post('/add-payment-customer', 'CustomerController@duePayment');


Route::get('/view-or/{id}', 'CustomerController@viewOrder');

Route::get('/print-or/{id}', 'CustomerController@printOrderPage');


Route::post('/add-extra-payment-customer-2', 'CustomerController@addExtraPayment2');
Route::post('/add-extra-payment-customer', 'CustomerController@addExtraPayment');
Route::get('/view-extra-payment-customer', 'CustomerController@viewExtraPaymentCustomer');

Route::get('/del-ext-payment-cus', 'CustomerController@delExtPaymentCus');


//===== Accounts Managements =====//

// Accounts...
Route::get('/accounts-list', 'AccountsController@accountsList');

Route::post('/save-account', 'AccountsController@addAccount');

Route::post('/update-account', 'AccountsController@updateAccount');


// transfer..

Route::get('/search-transfers', 'AccountsController@searchTransfers');

Route::get('/balance-transfer', 'AccountsController@balanceTransfer');

Route::post('/save-transfer', 'AccountsController@saveTransfer');

Route::get('/del-transfer', 'AccountsController@delTransfer');


// withdraw..

//Route::get('/search-withdraws', 'AccountsController@searchWithdraws');

//Route::get('/withdraw', 'AccountsController@withdraw');

//Route::post('/save-withdraw', 'AccountsController@saveWithdraw');


// deposits..

Route::get('/search-deposits', 'AccountsController@searchDeposits');

Route::get('/balance-list', 'AccountsController@balanceList');

Route::post('/save-balance', 'AccountsController@addBalance');

Route::get('/del-deposit', 'AccountsController@deldeposit');


// Loan....

Route::get('/search-loans', 'AccountsController@searchLoans');

Route::get('loan-list', 'AccountsController@loanList');

Route::post('save-loan', 'AccountsController@saveLoan');

Route::post('add-refund', 'AccountsController@refundLoan');

Route::get('view-refund', 'AccountsController@viewRefund');



// Transaction History.
// Route::get('transaction-list', 'AccountsController@transactionList');

Route::get('transaction-search', 'AccountsController@transactionSearch');

   
// Expenses List
Route::get('expenses-list', 'AccountsController@expensesList');

Route::get('drop-expenses-sub-head', 'AccountsController@dropDownSubHead');

Route::post('save-expenses', 'AccountsController@saveExpenses');

Route::get('search-expenses', 'AccountsController@searchExpenses');

Route::get('/del-expenses', 'AccountsController@delExpenses');

    



// Expenses Settings List.....
Route::get('expenses-settings-list', 'AccountsController@expensesSettingsList');
Route::post('save-expenses-head', 'AccountsController@saveExpensesHead');
Route::post('update-expenses-head', 'AccountsController@updateExpensesHead');
Route::post('save-expenses-sub-head', 'AccountsController@saveExpensesSubHead');
Route::post('update-expenses-sub-head', 'AccountsController@updateExpensesSubHead');



// income statement


Route::get('/income-statement', 'AccountsController@incomeStatement');

Route::get('statement-search', 'AccountsController@statementSearch')->name('statement-search');
Route::get('/account-head-report', 'AccountsController@accountHeadReport');



// balance Sheet

Route::get('/balance-sheet', 'AccountsController@balanceSheet');

Route::get('search-sheet', 'AccountsController@balanceSheetSearch');



    //===== Report's Managements =====//

// for Sales reports....

Route::get('/sales-report', 'ReportsController@salesReport');

Route::get('/search-sales-report', 'ReportsController@searchSalesReport');

Route::get('/view-sold', 'ReportsController@viewSold');

Route::get('/view-wastage-total', 'ReportsController@viewWastage');
Route::get('/search-viewsold', 'ReportsController@searchViewSold');

// for order reports.....

Route::get('/order-report', 'ReportsController@orderReport');

Route::get('/search-order-report', 'ReportsController@searchOrderReport');

Route::get('/view-order-report', 'ReportsController@viewOrderReport');

Route::get('/view-cancelled-order-report', 'ReportsController@viewCancelledOrderReport');

Route::post('/add-payment-order-report', 'ReportsController@duePaymentOrder');


Route::get('/view-payment-ord-rep', 'ReportsController@viewPayment');




// for due reports......

Route::get('/due-report', 'ReportsController@dueReport');

Route::post('/add-payment-report', 'ReportsController@duePayment');

Route::get('/search-due-report', 'ReportsController@searchDueReport');

Route::get('/view-payment-due-rep', 'ReportsController@viewPayment');




//===== Admin Managements =====//

// Admin........

Route::get('/admin-list', 'AdminController@adminList');

Route::post('/save-admin', 'AdminController@saveAdmin');

Route::post('/update-admin', 'AdminController@updateAdmin');
Route::get('/admin-delete/{id}', 'SettingsController@adminDelete');



//===== Purchase Managements =====//

    // buyer
    Route::get('/buyer-list', 'PurchaseController@buyerList');
    Route::post('/save-buyer', 'PurchaseController@saveBuyer');
    Route::post('/update-buyer', 'PurchaseController@updateBuyer');
    Route::get('/search-buyer-list', 'PurchaseController@searchBuyerList');
	
	
    Route::get('/view-buyer-due-orders', 'PurchaseController@searchBuyerDues');
	
    Route::get('/view-buyer-orders', 'PurchaseController@searchBuyerOrders');

    // new Purchase 
    Route::get('/new-purchase', 'PurchaseController@newPurchase');
    Route::get('/search-pros-purchase', 'PurchaseController@searchProPurchase');
    Route::post('/save-purchase-product', 'PurchaseController@purchaseProductSave');
    
        
    // Purchase List
    Route::get('/purchase-list', 'PurchaseController@purchaseList');
    Route::post('/add-purchase-payment', 'PurchaseController@duePurchasePayment');
    Route::get('/view-purchase-payment', 'PurchaseController@viewPurchaseProduct');
	
    //Route::get('/cancel-purchase', 'PurchaseController@cancelPurchase');
    Route::get('/del-purchase', 'PurchaseController@delPurchase');
	
    Route::get('/search-purchase-list', 'PurchaseController@searchPurchaseList');

    Route::get('/view-purchase-invoice', 'PurchaseController@viewPurchaseInvoice');
    Route::get('/view-purchase-invoice-order', 'PurchaseController@viewPurchaseInvoiceOrder');
    Route::get('/view-purchase-invoice-order-list', 'PurchaseController@viewPurchaseInvoiceOrderList');
    Route::get('/view-purchase-invoice-order-ammount', 'PurchaseController@viewPurchaseInvoiceOrderAmmount');
    Route::get('/view-purchase-invoice-order-payment', 'PurchaseController@viewPurchaseInvoiceOrderPayment');
    Route::get('/view-purchase-invoice-order-payment-due', 'PurchaseController@viewPurchaseInvoiceOrderPaymentDue');
    Route::get('/view-pur-invoic-last-pur-pay', 'PurchaseController@viewPurchaseInvoiceLastPayment');

    Route::get('/purchase-extra-data', 'PurchaseController@purchaseExtraData');
    Route::post('/add-extra-payment-supplier', 'PurchaseController@addExtraPayment');
    Route::post('/add-extra-payment-supplier2', 'PurchaseController@addExtraPayment2');

    Route::get('/view-extra-payment-supplier', 'PurchaseController@viewExtraPayment');
    Route::get('/del-ext-payment', 'PurchaseController@delExtraPayment');


    // Cancel Purchase List
   // Route::get('/cancel-purchase-list', 'PurchaseController@cancelPurchaseList');
    //Route::get('/return-cancel-purchase', 'PurchaseController@returnCancelPurchase');
   // Route::get('/search-cancel-purchase-list', 'PurchaseController@searchCancelPurchaseList');


    // Due Purchase List
    Route::get('/due-purchase-list', 'PurchaseController@duePurchaseList');
    Route::post('/add-due-purchase-payment', 'PurchaseController@duePurchasePaymentList');
    Route::get('/search-due-purchase-list', 'PurchaseController@searchDuePurchaseList');
    
    // purchase or add 
     Route::get('/purchase-add', 'PurchaseOraddController@purchaseoradd');
     Route::post('/add-supplier', 'PurchaseOraddController@saveBuyer2');
     Route::post('/save-producto', 'PurchaseOraddController@saveProduct');
    Route::get('/search-product-listNew', 'PurchaseOraddController@searchProductList');
     Route::post('/save-purchase-new', 'PurchaseOraddController@purchaseProductSave');
     
     //expired product 
     Route::get('/expired-product', 'PurchaseOraddController@showExpiredProduct');
     Route::get('/about-app', 'PurchaseOraddController@aboutApp');


     //search order by id
     Route::get('/search-order-id', 'SalesController@searchOrderId');


// sales report for sales person
     Route::get('/totalsales-salesman', 'SalesController@SalesByPerson');
     
     //company statement
     
     
     Route::get('/company-statement', 'SalesController@compnayStatement');
     Route::post('/previous_due_payment', 'CustomerController@previousDuePayment');


      
      
      
      
      

     
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    