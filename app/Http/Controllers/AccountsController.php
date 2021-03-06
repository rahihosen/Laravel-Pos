<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;


class AccountsController extends Controller
{

	protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;

        $admin_data = Auth::user();

        if(! isset( Auth::user()->id)) {
            header("Location: ".$this->url->to('/'));
			exit();
        }

        $features = 7;
		
		$admin_role = $admin_data->admin_role;
		
		$all_roles = DB::table('admin_role')->where('role_id', 1)->first();
		
		$roles[1] = $all_roles->admin_role_features;
		$roles[2] = $all_roles->manager_role_features;
		$roles[3] = $all_roles->salesman_role_features;
		
		$get_features = explode(",",$roles[$admin_role]);
		
		if(!in_array($features,$get_features)){
			
			header("Location: ".$this->url->to('/home?error=1'));
			exit();
			
		}
		
    }

    //=== Account all Functions ... ===//

    // account list
    public function accountsList()
    {

		
		$all_accounts = DB::table('accounts as accounts')
            ->leftJoin('admin as admin_created', 'accounts.account_created_by', '=', 'admin_created.id')
            ->leftJoin('admin as admin_updated', 'accounts.account_updated_by', '=', 'admin_updated.id')
			->select(
                'accounts.account_id as aid',
                'accounts.account_name as name',
                'accounts.account_branch as branch',
                'accounts.account_no as no',
                'accounts.account_type as type',
                'admin_created.name as created_admin_name',
                'admin_updated.name as updated_admin_name',
                'accounts.account_created_date as created_date',
                'accounts.account_created_time as created_time',
                'accounts.account_updated_date as updated_date',
                'accounts.account_updated_time as updated_time'
            )
			->orderBy('aid', 'DESC')
            ->paginate(10);
            
            
            
            $data = DB::table('investment_table')
            ->join('accounts', 'investment_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'investment_table.balance_created_by', '=', 'admin.id', 'left')
            ->orderBy('investment_id', 'DESC')
            ->paginate(10);

        $accounts_list = view('admin.pages.accounts_list')->with('all_accounts', $all_accounts)->with('balances', $data);

        return view('admin_master')->with('admin_main_content', $accounts_list);
    }

    // create a new account
    public function addAccount(Request $request)
    {
		

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['account_name'] = $request->account_name;
        $data['account_branch'] = $request->branch_name;
        $data['account_no'] = $request->account_no;
        $data['account_type'] = $request->account_type;

        $data['account_created_by'] = Auth::user()->id;
        $data['account_created_date'] = date('Y-m-d');
        $data['account_created_time'] = date('H:i:s');

        DB::table('accounts')->insert($data);

        Session::put('message', 'Account Information Save successfully!!!');

        return Redirect::to('/accounts-list');

    }

    // Update account information
    public function updateAccount(Request $request)
    {
		
		
        date_default_timezone_set("Asia/Dhaka");

        $account_id = $request->account_id;

        $data = array();

        $data['account_name'] = $request->account_name;
        $data['account_branch'] = $request->branch_name;
        $data['account_no'] = $request->account_no;
        $data['account_type'] = $request->account_type;

        $data['account_updated_by'] = Auth::user()->id;
        $data['account_updated_date'] = date('Y-m-d');
        $data['account_updated_time'] = date('H:i:s');

        DB::table('accounts')->where('account_id', $account_id)->update($data);

        Session::put('message', 'Update Account Information successfully!!!');

        return Redirect::to('/accounts-list');
    }




    //=== All Deposits Functions .. ===//

    // Deposits list
    public function balanceList() {

		
        $data = DB::table('investment_table')
            ->join('accounts', 'investment_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'investment_table.balance_created_by', '=', 'admin.id', 'left')
            ->orderBy('investment_id', 'DESC')
            ->paginate(10);

        $balance_list = view('admin.pages.balance_list')->with('balances', $data);

        return view('admin_master')->with('balance_list', $balance_list);
		
    }

    // Save balance 
    public function addBalance(Request $request)
    {
		
        date_default_timezone_set("Asia/Dhaka");

        $data = array();
		
        $data2 = array();
		
		
		$data2['account_id'] = $request->account_id;
        $data2['ammount'] = $request->ammount;
        $data2['note'] = $request->note;

        $data2['balance_created_by'] = Auth::user()->id;
        $data2['balance_created_date'] = date('Y-m-d');
        $data2['balance_created_time'] = date('H:i:s');

        $deposit_id = DB::table('investment_table')->insertGetId($data2);
		
		$data['balance_type'] = 1;
		
		$data['deposit_id'] = $deposit_id;

        $data['account_id'] = $request->account_id;
        $data['ammount'] = $request->ammount;
        $data['note'] = $request->note;

        $data['balance_created_by'] = Auth::user()->id;
        $data['balance_created_date'] = date('Y-m-d');
        $data['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data);

        Session::put('message', 'Account Balance Save successfully!!!');

        return Redirect::to('/balance-list');

    }
	
	
    public function searchDeposits( Request $request ) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
        $select_account = $request->select_account;
		
		if($select_account == 0){
			$data = DB::table('investment_table')
					->join('accounts', 'investment_table.account_id', '=', 'accounts.account_id', 'left')
					->join('admin', 'investment_table.balance_created_by', '=', 'admin.id', 'left')
					->whereBetween('balance_created_date', [$start_date, $end_date])
					->orderBy('investment_id', 'DESC')
					->get();

		}else{
			$data = DB::table('investment_table')
					->join('accounts', 'investment_table.account_id', '=', 'accounts.account_id', 'left')
					->join('admin', 'investment_table.balance_created_by', '=', 'admin.id', 'left')
					->whereBetween('balance_created_date', [$start_date, $end_date])
					->where('investment_table.account_id', $select_account)
					->orderBy('investment_id', 'DESC')
					->get();
		}


        $ren_data = '';
		
        $tot_amnt = 0;
		
		$tot_blnc = count($data);

        foreach ($data as $balance) {
			
			$tot_amnt += $balance->ammount;

            $ren_data .= '<tr class="even pointer">
								<td class="text-center">'.$balance->account_name.'</td>
								<td class="text-center">'.$balance->account_branch.'</td>
								<td class="text-center">'.$balance->account_no.'</td>
								<td class="text-center">'.$balance->ammount.'</td>
								<td class="text-center">'.$balance->note.'</td>
								<td class="text-center">'.$balance->name.'</td>
                                <td class="text-center">'.$balance->balance_created_date.' / '.$balance->balance_created_time.'</td>
                                <td class="text-center">
                                    <button
                                        class="btn btn-danger btn-xs del"
                                        value="'.$balance->investment_id.'"

                                        ><i class="fa fa-trash"></i>
                                    </button>
                                </td>
							</tr>';
        }

        $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total '.$tot_blnc.'</b></td>
						<td colspan="2"></td>
						<td class="text-center"><b>'.$tot_amnt.'</b></td>
						<td colspan="4"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
    }


    public function deldeposit (Request $request)
    {
        $e = $request->id;

        DB::table('investment_table')->where('investment_id', $e)->delete();

        echo '1';
    }
	
	
	//=== balanceTransfer.. ===//

    // balanceTransfer
	
	
    public function searchTransfers( Request $request ) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $data = DB::table('transfer_table as transfer')			
				->leftJoin('accounts as accounts_from', 'transfer.transfer_from', '=', 'accounts_from.account_id')
				->leftJoin('accounts as accounts_to', 'transfer.transfer_to', '=', 'accounts_to.account_id')
				->leftJoin('admin as admin_created', 'transfer.transfer_created_by', '=', 'admin_created.id')
				->select(
					'transfer.transfer_id as tid',
					'transfer.ammount as ammount',
					'transfer.note as note',
					'admin_created.name as created_admin_name',
					'accounts_from.account_name as tfrom',
					'accounts_to.account_name as tto',
					'transfer.transfer_created_date as transfer_date',
					'transfer.transfer_created_time as transfer_time'
				)
				->whereBetween('transfer_created_date', [$start_date, $end_date])
				->orderBy('tid', 'DESC')
				->get();

        $ren_data = '';

        foreach ($data as $transfers) {

            $ren_data .= '<tr class="even pointer">
							<td class="text-center">'.$transfers->tfrom.'</td>
							
							<td class="text-center">'.$transfers->ammount.'</td>
							
							<td class="text-center">'.$transfers->tto.'</td>
							
							<td class="text-center">'.$transfers->note.'</td>
							
							<td class="text-center">'.$transfers->created_admin_name.'</td>
							
                            <td class="text-center">'.$transfers->transfer_date.' / '.$transfers->transfer_time.'</td>

                            <td class="text-center">
                                <button
                                    class="btn btn-danger btn-xs del"
                                    value="'.$transfers->tid.'"

                                    ><i class="fa fa-trash"></i>
                                </button>
                            </td>
							
						</tr>';
        }

        if ($ren_data == "") {
			echo 1;
        } else {
            echo $ren_data;
        }
    }
	
    public function balanceTransfer()
    {

        $data = DB::table('transfer_table as transfer')			
            ->leftJoin('accounts as accounts_from', 'transfer.transfer_from', '=', 'accounts_from.account_id')
            ->leftJoin('accounts as accounts_to', 'transfer.transfer_to', '=', 'accounts_to.account_id')
            ->leftJoin('admin as admin_created', 'transfer.transfer_created_by', '=', 'admin_created.id')
			->select(
                'transfer.transfer_id as tid',
                'transfer.ammount as ammount',
                'transfer.note as note',
                'admin_created.name as created_admin_name',
                'accounts_from.account_name as tfrom',
                'accounts_to.account_name as tto',
                'transfer.transfer_created_date as transfer_date',
                'transfer.transfer_created_time as transfer_time'
            )
			->orderBy('tid', 'DESC')
            ->paginate(10);

        $transfer_list = view('admin.pages.transfer')->with('transfer', $data);

        return view('admin_master')->with('admin_main_content', $transfer_list);
		
    }

    public function saveTransfer(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();
		
        $data2 = array();
		
        $data3 = array();
		
		
		$data['transfer_from'] = $request->account_id_1;
        $data['transfer_to'] = $request->account_id_2;
        $data['ammount'] = $request->ammount;
        $data['note'] = $request->note;

        $data['transfer_created_by'] = Auth::user()->id;
        $data['transfer_created_date'] = date('Y-m-d');
        $data['transfer_created_time'] = date('H:i:s');

        $transfer_id = DB::table('transfer_table')->insertGetId($data);
		
		
		
		$data2['balance_type'] = 7;

        $data2['transfer_id'] = $transfer_id;
		
        $data2['account_id'] = $request->account_id_1;
        $data2['ammount'] = $request->ammount;
        $data2['note'] = $request->note;

        $data2['balance_created_by'] = Auth::user()->id;
        $data2['balance_created_date'] = date('Y-m-d');
        $data2['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data2);
		
		
		
		$data3['balance_type'] = 8;

        $data3['transfer_id'] = $transfer_id;
		
        $data3['account_id'] = $request->account_id_2;
        $data3['ammount'] = $request->ammount;
        $data3['note'] = $request->note;

        $data3['balance_created_by'] = Auth::user()->id;
        $data3['balance_created_date'] = date('Y-m-d');
        $data3['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data3);
		

        Session::put('message', 'Transfer Successfull.');

        return Redirect::to('/balance-transfer');

    }


    public function delTransfer (Request $request)
    {
        $e = $request->id;

        DB::table('transfer_table')->where('transfer_id', $e)->delete();

        echo '1';
    }
	
	
	//=== Withdraw .. ===//

    // Withdraw list
	
    public function withdraw()
    {
        $data = DB::table('withdraw_table')
            ->join('accounts', 'withdraw_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'withdraw_table.withdraw_created_by', '=', 'admin.id', 'left')
            ->orderBy('withdraw_id', 'DESC')
            ->paginate(10);

        $withdraw_list = view('admin.pages.withdraw')->with('withdraws', $data);

        return view('admin_master')->with('admin_main_content', $withdraw_list);
		
    }

    // Save Withdraw 
    public function saveWithdraw(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();
		
        $data2 = array();

        $data['balance_type'] = 4;

        $data['account_id'] = $request->account_id;
        $data['ammount'] = $request->ammount;
        $data['note'] = $request->note;

        $data['balance_created_by'] = Auth::user()->id;
        $data['balance_created_date'] = date('Y-m-d');
        $data['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data);
		
		
		$data2['account_id'] = $request->account_id;
        $data2['ammount'] = $request->ammount;
        $data2['note'] = $request->note;

        $data2['withdraw_created_by'] = Auth::user()->id;
        $data2['withdraw_created_date'] = date('Y-m-d');
        $data2['withdraw_created_time'] = date('H:i:s');

        DB::table('withdraw_table')->insert($data2);
		

        Session::put('message', 'Withdraw Successfull !!!');

        return Redirect::to('/withdraw');

    }
	
	
	
	public function searchWithdraws( Request $request ) {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $data = DB::table('withdraw_table')
				->join('accounts', 'withdraw_table.account_id', '=', 'accounts.account_id', 'left')
				->join('admin', 'withdraw_table.withdraw_created_by', '=', 'admin.id', 'left')
				->whereBetween('withdraw_created_date', [$start_date, $end_date])
				->orderBy('withdraw_id', 'DESC')
				->get();

        $ren_data = '';

        foreach ($data as $withdraw) {

            $ren_data .= '<tr class="even pointer">
								<td class="text-center">'.$withdraw->account_name.'</td>
								<td class="text-center">'.$withdraw->account_branch.'</td>
								<td class="text-center">'.$withdraw->account_no.'</td>
								<td class="text-center">'.$withdraw->ammount.'</td>
								<td class="text-center">'.$withdraw->note.'</td>
								<td class="text-center">'.$withdraw->name.'</td>
								<td class="text-center">'.$withdraw->withdraw_created_date.' / '.$withdraw->withdraw_created_time.'</td>
								
							</tr>';
        }

        if ($ren_data == "") {
			echo 1;
        } else {
            echo $ren_data;
        }
    }
	
	
	
	
    
    //=== All Loan Functions .... ===//

    // Loan list
	
	
	
	public function searchLoans( Request $request ) {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $data = DB::table('loans_table')
				->join('accounts', 'loans_table.account_id', '=', 'accounts.account_id', 'left')
				->join('admin', 'loans_table.loan_created_by', '=', 'admin.id', 'left')
				->whereBetween('loan_created_date', [$start_date, $end_date])
				->orderBy('loan_id', 'DESC')
				->get();

        $ren_data = '';
        $tot_amnt = 0;
        $tot_due = 0;
        $tot_loans = count($data);

        foreach ($data as $loan) {
			
			$data = DB::table('refund_table')->where('loan_id', $loan->loan_id)->sum('refund_ammount');

			$result = ($loan->loan_ammount) - $data;
			
			$tot_amnt += $loan->loan_ammount;
			$tot_due += $result;

            $ren_data .= '<tr class="even pointer">

							<td class="text-center">'.$loan->loan_id.'</td>
							<td class="text-center">'.$loan->loan_description.'</td>
							<td class="text-center">'.$loan->loan_ammount.'</td>
							<td class="text-center">'.$result.'</td>
							<td class="text-center">'.$loan->account_name.'</td>
							<td class="text-center">'.$loan->name.'</td>
							<td class="text-center">'.$loan->loan_created_date.'</td>

							<td class="text-center hide_print_sec">

								<button
									class="btn btn-primary btn-xs refund"
									
									value="'.$loan->loan_id.'"
									refundAmmount="'.$result.'"

									><i class="fa fa-edit"></i> Refund 
								</button>

								<button
									class="btn btn-info btn-xs view_refund"

									value="'.$loan->loan_id.'"
									><i class="fas fa-eye"></i> View
								</button>
							</td>
						</tr>';
        }

         $total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total '.$tot_loans.'</b></td>
						<td></td>
						<td class="text-center"><b>'.$tot_amnt.'</b></td>
						<td class="text-center"><b>'.$tot_due.'</b></td>
						<td colspan="3"></td>
						<td class="hide_print_sec"></td>
					</tr>';
		
        if($ren_data == ""){
            echo 1;
        }else{
            echo $ren_data.$total_all;
        }
    }
	
    public function loanList()
    {

        $all_loans = DB::table('loans_table')
            ->join('accounts', 'loans_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'loans_table.loan_created_by', '=', 'admin.id', 'left')
            ->orderBy('loan_id', 'DESC')
            ->paginate(10);

        $loan_list = view('admin.pages.loan_list')->with('loans', $all_loans);

        return view('admin_master')->with('admin_main_content', $loan_list);
    }

    // Save Loan
    public function saveLoan(Request $request)
    {
		
        date_default_timezone_set("Asia/Dhaka");

        $data = array();
        $data2 = array();

        $data['account_id'] = $request->account_id;
        $data['loan_ammount'] = $request->loan_ammount;
        $data['loan_description'] = $request->loan_description;

        $data['loan_created_by'] = Auth::user()->id;
        $data['loan_created_date'] = date('Y-m-d');
        $data['loan_created_time'] = date('H:i:s');
		
        $loan_id = DB::table('loans_table')->insertGetId($data);


        // save data for balance table
        $data2['balance_type'] = 2;

        $data2['loan_id'] = $loan_id;
		
        $data2['account_id'] = $request->account_id;
        $data2['ammount'] = $request->loan_ammount;
        $data2['note'] = $request->loan_description;

        $data2['balance_created_by'] = Auth::user()->id;
        $data2['balance_created_date'] = date('Y-m-d');
        $data2['balance_created_time'] = date('H:i:s');


        DB::table('balance_table')->insert($data2);

        Session::put('message', 'Loan Create successfully!!!');

        return Redirect::to('/loan-list');

    }

    // Refund Loan
    public function refundLoan(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['loan_id'] = $request->loan_id;
        $data['account_id'] = $request->account_id;
        $data['refund_ammount'] = $request->refund_ammount;
        $data['refund_note'] = $request->refund_note;

        $data['refund_created_by'] = Auth::user()->id;
        $data['refund_created_date'] = date('Y-m-d');
        $data['refund_created_time'] = date('H:i:s');

        DB::table('refund_table')->insert($data);
		
		
		// save data for balance table
        $data2['balance_type'] = 3;

        $data2['loan_id'] = $request->loan_id;
        $data2['account_id'] = $request->account_id;
        $data2['ammount'] = $request->refund_ammount;
        $data2['note'] = $request->refund_note;

        $data2['balance_created_by'] = Auth::user()->id;
        $data2['balance_created_date'] = date('Y-m-d');
        $data2['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data2);

        Session::put('message', 'Refund Successfully Done!!!');

        return Redirect::to('/loan-list');

    }

    // View Refund Loan
    public function viewRefund(Request $request)
    {

        $rt = $request->loan_id;

        $refunds = DB::table('refund_table')
            ->join('accounts', 'refund_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'refund_table.refund_created_by', '=', 'admin.id', 'left')
            ->where('loan_id', $rt)
            ->get();

        $ren_data = '';
        foreach ($refunds as $refunds) {

            $ren_data .= '<tr class="even pointer">

                            <td class="text-center">' . $refunds->refund_created_date . ' / ' . $refunds->refund_created_time . '</td>
                            <td class="text-center">' . $refunds->name . '</td>
                            <td class="text-center">' . $refunds->account_name . '</td>
                            <td class="text-center">' . $refunds->refund_note . '</td>
                            <td class="text-center">' . $refunds->refund_ammount . '</td>
                            
                        </tr>';

        }
        echo $ren_data;

    }


    //=== Transactions All Functions .  ===//

    // Transaction List 
    public function transactionList(Request $request) {


        $data = DB::table('balance_table')
            ->join('accounts', 'balance_table.account_id', '=', 'accounts.account_id', 'left')
            ->join('admin', 'balance_table.balance_created_by', '=', 'admin.id', 'left')
            ->where('status', 1)
            ->orderBy('balance_id', 'DESC')
            ->paginate(20);

        $transaction_list = view('admin.pages.transaction_list')->with('transactions', $data);

        return view('admin_master')->with('transaction_list', $transaction_list);
		
    }
	
    public function transactionSearch( Request $request ) 
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;
		
        $select_type = $request->select_type;
		
		if($select_type == 0){
			
			$data = DB::table('balance_table')
					->join('accounts', 'balance_table.account_id', '=', 'accounts.account_id', 'left')
					->join('admin', 'balance_table.balance_created_by', '=', 'admin.id', 'left')
					->where('status', 1)
					->whereBetween('balance_created_date', [$start_date, $end_date])
					->orderBy('balance_id', 'DESC')
					->get();
					
		}else{
			
			$data = DB::table('balance_table')
					->join('accounts', 'balance_table.account_id', '=', 'accounts.account_id', 'left')
					->join('admin', 'balance_table.balance_created_by', '=', 'admin.id', 'left')
					->where('balance_type', $select_type)
					->where('status', 1)
					->whereBetween('balance_created_date', [$start_date, $end_date])
					->orderBy('balance_id', 'DESC')
					->get();
			
		}
		
        

        $ren_data = $transaction_type = '';

        foreach ($data as $transaction) {
			
			if($transaction->balance_type==1){

				$transaction_type = '<span class="label label-success">Deposit</span>';

			}
			if ($transaction->balance_type==2){

				$transaction_type = '<span class="label label-warning">Loan</span>';

			}
			if ($transaction->balance_type==3){

				$transaction_type = '<span class="label label-info">Loan Refunds</span>';

			}
			if ($transaction->balance_type==4){

				$transaction_type = '<span class="label label-primary">Withdraw</span>';

			}
			if ($transaction->balance_type==5){

				$transaction_type = '<span class="label label-danger">Expense (Office)</span>';

			}
			if ($transaction->balance_type==6){

				$transaction_type = '<span class="label label-default">Income</span>';

			}
			if ($transaction->balance_type==7){

				$transaction_type = '<span class="label label-dark">Balance Transfer (Withdraw)</span>';

			}
			if ($transaction->balance_type==8){

				$transaction_type = '<span class="label label-dark">Balance Transfer (Deposit)</span>';

			}
			if ($transaction->balance_type == 9){

				$transaction_type = '<span class="label label-danger">Expense (Supply/Purchase)</span>';
			}

            $ren_data .= '<tr class="even pointer">
			
							<td class="text-center">'.$transaction->account_name.'</td>
							<td class="text-center">'.$transaction->account_branch.'</td>
							<td class="text-center">'.$transaction->account_no.'</td>
							<td class="text-center">'.$transaction->ammount.'</td>
							<td class="text-center">'.$transaction->note.'</td>
							
							<td class="text-center">'.$transaction_type.'</td>
							
							<td class="text-center">'.$transaction->name.'</td>
							<td class="text-center">'.$transaction->balance_created_date.' / '.$transaction->balance_created_time.'</td>
							
						</tr>';
        }

        if ($ren_data == "") {
			echo 1;
        } else {
            echo $ren_data;
        }
    }


    //=== All Expenses Funcitons . ===//
    
    // Expenses list
    public function expensesList()
    {

        $data = DB::table('expenses')
            ->join('admin', 'expenses.expenses_created_by', '=', 'admin.id', 'left')
            ->join('accounts', 'expenses.account_id', '=', 'accounts.account_id', 'left')
            ->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
            ->join('expenses_sub_head', 'expenses.expenses_sub_head_id', '=', 'expenses_sub_head.expenses_sub_head_id', 'left')
            ->orderBy('expenses_id', 'DESC')
            ->paginate(10);
            
            
            
             $data1 = DB::table('expenses_head')
            ->join('admin', 'expenses_head.expenses_head_created_by', '=', 'admin.id', 'left')
            ->orderBy('expenses_head_id', 'DESC')
            ->get();

        $data2 = DB::table('expenses_sub_head')
            ->join('expenses_head', 'expenses_sub_head.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
            ->join('admin', 'expenses_sub_head.expenses_sub_head_created_by', '=', 'admin.id', 'left')
            ->orderBy('expenses_sub_head_id', 'DESC')
            ->paginate(10);

        $expen_list = view('admin.pages.expenses_list')->with('all_expenses', $data)->with('expenses_setting', $data1)
                            ->with('expenses_sub_setting', $data2);

        return view('admin_master')->with('expen_list', $expen_list);

    } 

    // expenses sub head drop down
    public function dropDownSubHead(Request $request)
    {

        $search_val = $request->search_val;

        $expenses_sub_head = DB::table('expenses_sub_head')
            ->where('expenses_head_id', 'like', '%' . $search_val . '%')
            ->get();

        $ren_data = '';

        foreach ($expenses_sub_head as $expenses) {

            $ren_data .= '<option value="' . $expenses->expenses_sub_head_id . '" required="required">' . $expenses->expenses_sub_head_name . '</option>';
        }

        echo $ren_data;

    }

    // save expenses
    public function saveExpenses(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['account_id'] = $request->account_id;
        $data['expenses_head_id'] = $request->expenses_head_id;
        $data['expenses_sub_head_id'] = $request->expenses_sub_head_id;
        $data['expenses_ammount'] = $request->expenses_ammount;
        $data['expenses_note'] = $request->expenses_note;

        $data['expenses_created_by'] = Auth::user()->id;
        $data['expenses_created_date'] = date('Y-m-d');
        $data['expenses_created_time'] = date('H:i:s');

        $expense_id = DB::table('expenses')->insertGetId($data);
		
		// save data for balance table
		
        $data2['balance_type'] = 5;

        $data2['expense_id'] = $expense_id;
		
        $data2['account_id'] = $request->account_id;
        $data2['ammount'] = $request->expenses_ammount;
        $data2['note'] = $request->expenses_note;

        $data2['balance_created_by'] = Auth::user()->id;
        $data2['balance_created_date'] = date('Y-m-d');
        $data2['balance_created_time'] = date('H:i:s');

        DB::table('balance_table')->insert($data2);

        Session::put('message', 'Expenses Information Saved Successfully!!!');

        return Redirect::to('/expenses-list');

    }

    // Search sales reports
    public function searchExpenses(Request $request)
    {

        $start_date = $request->dt_from;
        $end_date = $request->dt_to;

        $expenses = DB::table('expenses')
            ->join('admin', 'expenses.expenses_created_by', '=', 'admin.id', 'left')
            ->join('accounts', 'expenses.account_id', '=', 'accounts.account_id', 'left')
            ->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
            ->join('expenses_sub_head', 'expenses.expenses_sub_head_id', '=', 'expenses_sub_head.expenses_sub_head_id', 'left')
            ->whereBetween('expenses_created_date', [$start_date, $end_date])
            ->get();

        $ren_data = "";
        $tot_expns = count($expenses);
        $tot_amnt = 0;

        foreach ($expenses as $expenses) {
			
			$tot_amnt += $expenses->expenses_ammount;

            $ren_data .= '<tr class="even pointer">
                            <td class="text-center">' . $expenses->expenses_created_date . ' / ' . $expenses->expenses_created_time . '</td>
                            <td class="text-center">' . $expenses->expenses_ammount . '</td>
                            <td class="text-center">' . $expenses->expenses_note . '</td>
                            <td class="text-center">' . $expenses->expenses_head_name . '</td>
                            <td class="text-center">' . $expenses->expenses_sub_head_name . '</td>
                            <td class="text-center">' . $expenses->account_name . '</td>
                            <td class="text-center">' . $expenses->name . '</td>
                            <td class="text-center">
                                <button
                                    class="btn btn-danger btn-xs del"
                                    value="'.$expenses->expenses_id.'"

                                    ><i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>';
        }

		
		$total_all = '<tr style="background-color:#555;color:#fff;">
						<td class="text-center"><b>Total '.$tot_expns.'</b></td>
						<td class="text-center"><b>'.$tot_amnt.'</b></td>
						<td colspan="6"></td>
					</tr>';
		
        if($ren_data == ""){
            echo "<tr><td colspan='8' class='text-center'>Nothing Found.</td></tr>";
        }else{
            echo $ren_data.$total_all;
        }

    }


    public function delExpenses (Request $request)
    {
        $e = $request->id;

        DB::table('expenses')->where('expenses_id', $e)->delete();

        echo '1';
    }


    //=== All Expenses Settings Functions ..... ===//

    // Expenses settings list
    public function expensesSettingsList()
    {

        $data = DB::table('expenses_head')
            ->join('admin', 'expenses_head.expenses_head_created_by', '=', 'admin.id', 'left')
            ->orderBy('expenses_head_id', 'DESC')
            ->get();

        $data2 = DB::table('expenses_sub_head')
            ->join('expenses_head', 'expenses_sub_head.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
            ->join('admin', 'expenses_sub_head.expenses_sub_head_created_by', '=', 'admin.id', 'left')
            ->orderBy('expenses_sub_head_id', 'DESC')
            ->paginate(10);

        $expen_setting_list = view('admin.pages.expenses_settings_list')
                            ->with('expenses_setting', $data)
                            ->with('expenses_sub_setting', $data2);

        return view('admin_master')->with('expen_setting_list', $expen_setting_list);
    }

    // Expenses head save
    public function saveExpensesHead(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['expenses_head_name'] = $request->expenses_head_name;

        $data['expenses_head_created_by'] = Auth::user()->id;
        $data['expenses_head_created_date'] = date('Y-m-d');
        $data['expenses_head_created_time'] = date('H:i:s');

        DB::table('expenses_head')->insert($data);

        Session::put('message', 'Expenses Hade Name Save successfully!!!');

        return Redirect::to('/expenses-settings-list');

    }

    // Expenses head Update
    public function updateExpensesHead(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $head_id = $request->expenses_head_id;

        $data = array();

        $data['expenses_head_name'] = $request->expenses_head_name;

        $data['expenses_head_updated_by'] = Auth::user()->id;
        $data['expenses_head_updated_date'] = date('Y-m-d');
        $data['expenses_head_updated_time'] = date('H:i:s');

        DB::table('expenses_head')->where('expenses_head_id', $head_id)->update($data);

        Session::put('message', 'Update Expenses Information successfully!!!');

        return Redirect::to('/expenses-settings-list');
    }


    // Expenses Sub Head Save
    public function saveExpensesSubHead(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $data = array();

        $data['expenses_head_id'] = $request->expenses_head_id;
        $data['expenses_sub_head_name'] = $request->expenses_sub_head_name;

        $data['expenses_sub_head_created_by'] = Auth::user()->id;
        $data['expenses_sub_head_created_date'] = date('Y-m-d');
        $data['expenses_sub_head_created_time'] = date('H:i:s');

        DB::table('expenses_sub_head')->insert($data);

        Session::put('message', 'Expenses Sub Hade Name Save Successfully!!!');

        return Redirect::to('/expenses-settings-list');

    }

    // Expanses Sub Head Update
    public function updateExpensesSubHead(Request $request)
    {

        date_default_timezone_set("Asia/Dhaka");

        $sub_head_id = $request->expenses_sub_head_id;

        $data = array();

        $data['expenses_head_id'] = $request->expenses_head_id;
        $data['expenses_sub_head_name'] = $request->expenses_sub_head_name;

        $data['expenses_sub_head_updated_by'] = Auth::user()->id;
        $data['expenses_sub_head_updated_date'] = date('Y-m-d');
        $data['expenses_sub_head_updated_time'] = date('H:i:s');

        DB::table('expenses_sub_head')->where('expenses_sub_head_id', $sub_head_id)->update($data);

        Session::put('message', 'Update Expenses Sub Head Information successfully!!!');

        return Redirect::to('/expenses-settings-list');

    }
	
	
	// income statement
	
    public function incomeStatement() 
    {
        
        $customer_pre_due = DB::table('customer')->sum('credit_limit');
        $buyer_pre_due = DB::table('buyers')->sum('previous_due');
        $total_wast = DB::select("select sum(`purchase_price`*`wastage_quantity`) as pw from `wastage`")[0];
        $total_purchase = DB::select("select sum(`total_ammount_payable`) as tap, sum(`purchase_total`) as ot, sum(`after_discount`) as ad, sum(`transport`) as trns FROM `purchase` where `purchase_status`=1")[0];
        $total_order = DB::select("select sum(`total_amount_payable`) as tap, sum(`order_total`) as ot, sum(`after_discount`) as ad FROM `order` where `order_status`=1")[0];
        
        $total_expense = DB::table('expenses')
						->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
						->select('expenses_head.expenses_head_name as head_name', DB::raw('SUM(expenses.expenses_ammount) as exp_amnt'))
						->groupBy('expenses_head.expenses_head_name')
						->get();
					   
		
        $income_statement = view('admin.pages.income_statement')
                            ->with('total_wast', $total_wast)
                            ->with('total_purchase', $total_purchase)
                            ->with('total_order', $total_order)
                            ->with('total_expense', $total_expense);

        return view('admin_master')->with('admin_main_content', $income_statement);
		
    }
	
	
	public function statementSearch( Request $request ) 
    {

        $start_date = $request->date_from;
        $end_date = $request->date_to;
        
        $customer_pre_due = DB::table('customer')->sum('credit_limit');
        $buyer_pre_due = DB::table('buyers')->sum('previous_due');
        $total_wast = DB::select("select sum(`purchase_price`*`wastage_quantity`) as pw from `wastage` where (wastage_created_date between '$start_date' AND '$end_date') ")[0];
        $total_purchase = DB::select("select sum(`total_ammount_payable`) as tap, sum(`purchase_total`) as ot, sum(`after_discount`) as ad, sum(`transport`) as trns FROM `purchase` where `purchase_status`=1 and (purchase_created_date between '$start_date' AND '$end_date') ")[0];
        $total_order = DB::select("select sum(`total_amount_payable`) as tap, sum(`order_total`) as ot, sum(`after_discount`) as ad FROM `order` where `order_status`=1 and (order_created_date between '$start_date' AND '$end_date') ")[0];
        
        $total_wast_bal = DB::select("select sum(`purchase_price`*`wastage_quantity`) as pw from `wastage` where wastage_created_date < '$start_date' ")[0];
        $total_purchase_bal = DB::select("select sum(`total_ammount_payable`) as tap, sum(`purchase_total`) as ot, sum(`after_discount`) as ad, sum(`transport`) as trns FROM `purchase` where `purchase_status`=1 and purchase_created_date < '$start_date' ")[0];
        $total_order_bal = DB::select("select sum(`total_amount_payable`) as tap, sum(`order_total`) as ot, sum(`after_discount`) as ad FROM `order` where `order_status`=1 and order_created_date < '$start_date' ")[0];
        
        $total_expense = DB::table('expenses')
						->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
						->select('expenses_head.expenses_head_name as head_name', DB::raw('SUM(expenses.expenses_ammount) as exp_amnt'))
						->whereBetween('expenses.expenses_created_date', [$start_date, $end_date])
						->groupBy('expenses_head.expenses_head_name')
						->get();
		
		$total_expense_bal = DB::table('expenses')
						->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
						->select('expenses_head.expenses_head_name as head_name', DB::raw('SUM(expenses.expenses_ammount) as exp_amnt'))
						->where('expenses.expenses_created_date','<', $start_date)
						->groupBy('expenses_head.expenses_head_name')
						->get();
					   
		
        $income_statement = view('admin.pages.income_statement')
                            ->with('total_wast', $total_wast)
                            ->with('total_purchase', $total_purchase)
                            ->with('total_order', $total_order)
                            ->with('total_expense', $total_expense)
                            ->with('total_wast_bal', $total_wast_bal)
                            ->with('total_purchase_bal', $total_purchase_bal)
                            ->with('total_order_bal', $total_order_bal)
                            ->with('total_expense_bal', $total_expense_bal);

        return view('admin_master')->with('admin_main_content', $income_statement);
        
		/*$customer_pre_due = DB::table('customer')->sum('credit_limit');
        
        $buyer_pre_due = DB::table('buyers')->sum('previous_due');
        
        
        
		$total_purchase = DB::table('purchase')->whereBetween('purchase_created_date', [$start_date, $end_date])->sum('total_ammount_payable');
		
        $total_order = DB::table('order')->where('order_status',1)->whereBetween('order_created_date', [$start_date, $end_date])->sum('total_amount_payable');
		
        $total_expense = DB::table('expenses')
						->join('expenses_head', 'expenses.expenses_head_id', '=', 'expenses_head.expenses_head_id', 'left')
						->select('expenses_head.expenses_head_name as head_name', DB::raw('SUM(expenses.expenses_ammount) as exp_amnt'))
						->whereBetween('expenses.expenses_created_date', [$start_date, $end_date])
						->groupBy('expenses_head.expenses_head_name')
						->get();
						
		
		
        
		$exp_sum = 0;
		
		$ad_exp = $ren_data = '';
		
		foreach($total_expense as $total_expense){
			
			$exp_sum += $total_expense->exp_amnt;
			
			$ad_exp .= '<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$total_expense->head_name.'</td>
				<td>'.$total_expense->exp_amnt.'</td>
			</tr>';
		
		}
		
		$income = $total_order - $total_purchase - $exp_sum;
		
		$inc_loss = '';
		
		if($income >= 0){
			
			$inc_loss = 'Income';
			
		}else{
			$inc_loss = 'Loss';
		}

		$ren_data .= '<tr>
						<th colspan="2">Revenue</th>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Sales</td>
						<td>'.$total_order.'</td>
					</tr>
					
					<tr>
						<th colspan="2">Operation Expense</th>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Purchase</td>
						<td>'.$total_purchase.'</td>
					</tr>
					
					<tr>
						<th colspan="2">Administrative Expense</th>
					</tr>
					
					'.$ad_exp.'
					
					<tr class="total_border">
					
						<th class="text-right">Net '.$inc_loss.'</th>
						<th class="text-right">'.abs($income).'</th>
						
					</tr>';
					
					
        echo $ren_data;*/
		
    }
	
	
	
	
	// balance sheet
	
	
    public function balanceSheet() 
    {
		
		$all_accounts = DB::table('accounts')->where('account_type', 1)->get();
		
		$in_acc_cash = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->sum('refund_ammount');
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->sum('loan_ammount');
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			
			
			$in_acc_cash += $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		$all_accounts = DB::table('accounts')->where('account_type', 2)->get();
		
		$in_acc_bank = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->sum('refund_ammount');
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->sum('loan_ammount');
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			
			
			$in_acc_bank += $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		
		$all_accounts = DB::table('accounts')->where('account_type', 3)->get();
		
		$in_acc_bkash = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->sum('refund_ammount');
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->sum('loan_ammount');
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->sum('amount');
			
			
			
			$in_acc_bkash += $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		
		$customer_pre_due = DB::table('customer')->sum('credit_limit');
		
		$buyer_pre_due = DB::table('buyers')->sum('previous_due');
		
		
		
		$customer_extra_payment = DB::table('customer_extra_payment')->sum('amount');
			
		$supplier_extra_payment = DB::table('supplier_extra_payment')->sum('amount');
		
		
		
		
		$acc_receivable = DB::table('order')->where('order_status',1)->sum('total_amount_payable') + $customer_pre_due - $customer_extra_payment - DB::table('pament_details')->where('status',1)->sum('amount');
		
		$acc_payable = DB::table('purchase')->sum('total_ammount_payable') + $buyer_pre_due - $supplier_extra_payment - DB::table('purchase_payment_details')->sum('pur_ammount');
		
		
		
		$loans = DB::table('loans_table')->sum('loan_ammount') - DB::table('refund_table')->sum('refund_ammount');
		
		$invest = DB::table('investment_table')->sum('ammount');
		
		
		
		
		$total_purchase = DB::table('purchase')->sum('total_ammount_payable') + $buyer_pre_due;
		
        $total_order = DB::table('order')->where('order_status',1)->sum('total_amount_payable') + $customer_pre_due;
		
        $total_expense = DB::table('expenses')->sum('expenses_ammount');
        
        
        
		
		$income = $total_order - $total_purchase - $total_expense;
		
        $balance_sheet = view('admin.pages.balance_sheet')
                            ->with('income', $income)
                            ->with('invest', $invest)
                            ->with('loans', $loans)
                            ->with('acc_payable', $acc_payable)
                            ->with('acc_receivable', $acc_receivable)
                            ->with('in_acc_bkash', $in_acc_bkash)
                            ->with('in_acc_bank', $in_acc_bank)
                            ->with('in_acc_cash', $in_acc_cash);

        return view('admin_master')->with('admin_main_content', $balance_sheet);
		
    }
	
	public function balanceSheetSearch( Request $request ) {
		
		$start_date = $request->dt_from;
        $end_date = $request->dt_to;
		
		$all_accounts = DB::table('accounts')->where('account_type', 1)->get();
		
		$in_acc_cash = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->whereBetween('balance_created_date', [$start_date, $end_date])->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->whereBetween('pur_payment_created_date', [$start_date, $end_date])->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->whereBetween('refund_created_date', [$start_date, $end_date])->sum('refund_ammount');
			
			
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->whereBetween('expenses_created_date', [$start_date, $end_date])->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->whereBetween('loan_created_date', [$start_date, $end_date])->sum('loan_ammount');
			
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			
			$in_acc_cash += $invested + $order_payment + $transfer_in + $loan_in - $purchase_payment + $customer_extra_payment - $supplier_extra_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		$all_accounts = DB::table('accounts')->where('account_type', 2)->get();
		
		$in_acc_bank = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->whereBetween('balance_created_date', [$start_date, $end_date])->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->whereBetween('pur_payment_created_date', [$start_date, $end_date])->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->whereBetween('refund_created_date', [$start_date, $end_date])->sum('refund_ammount');
			
			
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->whereBetween('expenses_created_date', [$start_date, $end_date])->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->whereBetween('loan_created_date', [$start_date, $end_date])->sum('loan_ammount');
			
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			
			
			$in_acc_bank += $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		
		$all_accounts = DB::table('accounts')->where('account_type', 3)->get();
		
		$in_acc_bkash = 0;
		
		foreach($all_accounts as $account){
			
			$invested = DB::table('investment_table')->where('account_id', $account->account_id)->whereBetween('balance_created_date', [$start_date, $end_date])->sum('ammount');
			
			$order_payment = DB::table('pament_details')->where('account_id', $account->account_id)->where('status',1)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$purchase_payment = DB::table('purchase_payment_details')->where('account_id', $account->account_id)->whereBetween('pur_payment_created_date', [$start_date, $end_date])->sum('pur_ammount');
			
			$loan_refund = DB::table('refund_table')->where('account_id', $account->account_id)->whereBetween('refund_created_date', [$start_date, $end_date])->sum('refund_ammount');
			
			
			
			$transfer_out = DB::table('transfer_table')->where('transfer_from', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$transfer_in = DB::table('transfer_table')->where('transfer_to', $account->account_id)->whereBetween('transfer_created_date', [$start_date, $end_date])->sum('ammount');
			
			$expenses = DB::table('expenses')->where('account_id', $account->account_id)->whereBetween('expenses_created_date', [$start_date, $end_date])->sum('expenses_ammount');
			
			$loan_in = DB::table('loans_table')->where('account_id', $account->account_id)->whereBetween('loan_created_date', [$start_date, $end_date])->sum('loan_ammount');
			
			
			
			$customer_extra_payment = DB::table('customer_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			$supplier_extra_payment = DB::table('supplier_extra_payment')->where('account_id', $account->account_id)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
			
			$in_acc_bkash += $invested + $order_payment + $transfer_in + $loan_in + $customer_extra_payment - $supplier_extra_payment - $purchase_payment - $loan_refund - $transfer_out - $expenses;
			

		}
		
		
		
		$customer_pre_due = DB::table('customer')->sum('credit_limit');
		
		$buyer_pre_due = DB::table('buyers')->sum('previous_due');
		
		
		
		$customer_extra_payment = DB::table('customer_extra_payment')->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
			
		$supplier_extra_payment = DB::table('supplier_extra_payment')->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
		
		
		
		
		$acc_receivable = DB::table('order')->where('order_status',1)->whereBetween('order_created_date', [$start_date, $end_date])->sum('total_amount_payable') + $customer_pre_due - $customer_extra_payment - DB::table('pament_details')->where('status',1)->whereBetween('created_date', [$start_date, $end_date])->sum('amount');
		
		$acc_payable = DB::table('purchase')->whereBetween('purchase_created_date', [$start_date, $end_date])->sum('total_ammount_payable') + $buyer_pre_due - $supplier_extra_payment - DB::table('purchase_payment_details')->whereBetween('pur_payment_created_date', [$start_date, $end_date])->sum('pur_ammount');
		
		
		
		$loans = DB::table('loans_table')->whereBetween('loan_created_date', [$start_date, $end_date])->sum('loan_ammount') - DB::table('refund_table')->whereBetween('refund_created_date', [$start_date, $end_date])->sum('refund_ammount');
		
		$invest = DB::table('investment_table')->whereBetween('balance_created_date', [$start_date, $end_date])->sum('ammount');
		
		
		
		$total_purchase = DB::table('purchase')->whereBetween('purchase_created_date', [$start_date, $end_date])->sum('total_ammount_payable') + $buyer_pre_due;
		
        $total_order = DB::table('order')->where('order_status',1)->whereBetween('order_created_date', [$start_date, $end_date])->sum('total_amount_payable') + $customer_pre_due;
		
        $total_expense = DB::table('expenses')->whereBetween('expenses_created_date', [$start_date, $end_date])->sum('expenses_ammount');
        
        
        
		
		$income = $total_order - $total_purchase - $total_expense;
		
		$inc_loss = '';
		
		if($income >= 0){
			
			$inc_loss = 'Income';
			
		}else{
			$inc_loss = 'Loss';
		}
		
		
		$ret_data = '';
		
		$ret_data = '<tr>
						<th colspan="2">Assets</th>
					</tr>
					
					<tr>
						<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Current Assets</b></td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash</td>
						<td>'.$in_acc_cash.'</td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank</td>
						<td>'.$in_acc_bank.'</td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bkash Personal</td>
						<td>'.$in_acc_bkash.'</td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts Receivable</td>
						<td>'.$acc_receivable.'</td>
					</tr>
					
					<tr>
						<th class="text-right">Total Assets</th>
						<th class="text-right">'.($in_acc_cash+$in_acc_bank+$in_acc_bkash+$acc_receivable).'</th>
					</tr>
					
					<tr>
						<th colspan="2">Liabilities</th>
					</tr>
					
					<tr>
						<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Liabilities</b></td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accounts Payable</td>
						<td>'.$acc_payable.'</td>
					</tr>
					
					<tr>
						<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Long Term Liabilities</b></td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loans</td>
						<td>'.$loans.'</td>
					</tr>
					
					<tr>
						<td colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner\'s Equity</b></td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Invested Capital</td>
						<td>'.$invest.'</td>
					</tr>
					
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net '.$inc_loss.'</td>
						<td>'.abs($income).'</td>
						
					</tr>
					
					<tr>
						<th class="text-right">Total Liabilities</th>
						<th class="text-right">'.($acc_payable+$loans+$invest+$income).'</th>
					</tr>';
		
		echo $ret_data;
		
		
    }
    
    
    
    public function accountHeadReport(){
		$all_accounts = DB::table('accounts as accounts')
            ->leftJoin('admin as admin_created', 'accounts.account_created_by', '=', 'admin_created.id')
            ->leftJoin('admin as admin_updated', 'accounts.account_updated_by', '=', 'admin_updated.id')
			->select(
                'accounts.account_id as aid',
                'accounts.account_name as name'
            )
			->orderBy('aid', 'DESC')
            ->paginate(10);

        $accounts_list = view('admin.pages.accountsheadreport_list')->with('all_accounts', $all_accounts);
        return view('admin_master')->with('admin_main_content', $accounts_list);
    }
    
    
    
    
    
    
    
    
    
    
    
   
    
}