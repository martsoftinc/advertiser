<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\campaignModel;
use App\Models\AdgroupModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;

class advertiserController extends Controller
{
    //

    public function logout(Request $request)
{
    // Get current user before logout
    $user = Auth::user();
    
    // Logout the user
    Auth::logout();
    
    // Invalidate the session
    $request->session()->invalidate();
    
    // Regenerate CSRF token
    $request->session()->regenerateToken();
    
   
    return redirect()->route('login')->with('success', 'You have been logged out successfully.');
}






    public function index(){
        return view('login');
    }

    public function test(){
        return view('welcome');
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    /* start of advertiser login */
    public function loginrequest(Request $request) 
    {
        
        $request->validate([
        'email' => 'required|email',
        'password' => 'required'
        ]);
        $credentials = $request->only('email','password');
       
        if (Auth::attempt($credentials)) 
        {
        $user = Auth::user(); // Get the authenticated user

            // Invalidate any previous sessions for this user
        //$this->invalidatePreviousSessions($user->id);

        // Update the session with the new user session
       // Session::put('user_id', $user->id); 

            $userRole = Auth::user()->role;

        switch ($userRole) {
            
            case 'advertiser':
                return redirect()->route('advertiser');
                break;
            case 'suspended':
                return redirect()->route('suspended');
                break  ;  
            // Add more cases for other roles as needed
            default:
                return redirect()->route('login');
        }    
        }
       
        return back()->with('loginError', 'Invalid username or password, you can reset your password if forgotten', );      
    }
    /* end of advertiser login */

    /* start of advertiser registration */

    public function registerrequest(Request $request){

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'country' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
        'countries' => 'required|array|min:1',
        'countries.*' => 'exists:countries,id'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    $role = 'advertiser';
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'gender' => $request->input('email'),
        'search_terms' => $request->input('search_terms'),
        'utm_source' => $request->input('utm_source'),
        'utm_campaign' => $request->input('utm_campaign'),
        'utm_medium' => $request->input('utm_meidum'),
        'referrer' => $request->input('referrer'),
        'country' => $request->input('country'),
        'role'=> $role,
        'password' => \Hash::make($request->input('password')),
    ]);
    
    BalanceModel::create([
        'user_id' => $user->id,
        'balance' => 0.00,
    ]);

    return redirect()->route('login')->with('status', 'User registered successfully!');

    
    }
    

    /* end of advertiser registration */


    public function createCampaign()
    {
        $adGroups = AdgroupModel::where('user_id', Auth::id())->get();
        $countries = DB::table('countries')
            ->get();
        return view('campaign.create',compact('adGroups', 'countries'));
    }





//List campaigns
   public function CampaignList(Request $request)
    {
        $user = Auth::user()->id;
        
        // Base query
        $campaigns = campaignModel::where('user_id', $user)
                                  ->with('adGroup');
        
        // Filter by adgroup if provided
        $adgroupFilter = $request->get('adgroup_id');
        if ($adgroupFilter) {
            $campaigns = $campaigns->where('adgroup_id', $adgroupFilter);
        }
        
        $campaigns = $campaigns->paginate(20);
        
        // Fetch user's adgroups for dropdown
        $adgroups = AdgroupModel::where('user_id', $user)->get();
        
        return view('campaign.list', compact('campaigns', 'adgroups', 'adgroupFilter'));
    }



   public function toggleStatus(Request $request, $id)
{
    $campaign = campaignModel::where('id', $id)
                             ->where('user_id', Auth::id())
                             ->firstOrFail();
    
    $status = strtolower($campaign->status);
    
    if (in_array($status, ['approved', 'running'])) {
        $campaign->status = 'paused'; // Or set to 'Stopped' if preferred
    } elseif (in_array($status, ['paused', 'Under Review'])) {
        $campaign->status = 'approved'; // Or 'Running'
    } else {
        return redirect()->back()->with('error', 'Cannot toggle this status.');
    }
    
    $campaign->save();
    
    return redirect()->back()->with('success', 'Campaign status updated.');
}




    // Edit campaigns
    public function editCampaign($id) 
        {
            $edit = campaignModel::find($id);

            if (!$edit) {
                abort(404, 'Campaign not found');
            }

            if ($edit->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            $adGroups = AdgroupModel::where('user_id', Auth::id())->get();
            return view('campaign.edit',compact('edit','adGroups'));
        }


    public function Analytics()
        {
         return view('campaign.analytics');
        }

    public function userdata()
    {
        return view('users');
    }
    public function userlist(Request $request)
    {

        $total_users = DB::table('users')
                    ->where('role','publisher')
                    ->count();
         // find all users credit also know as liability  

        $user_balance = DB::table('credit') 
                        ->sum('credit') ;

        $paid = DB::table('payment_requests')
                        ->where('status','paid') 
                        ->sum('amount') ;
        /*
        $list = DB::table('users')
                    ->where('role','publisher')
                    ->join('payment_requests', 'users.id', '=', 'payment_requests.user_id')
                    ->where('payment_requests.status', 'paid')
                     ->select('users.id', 'users.name', 'users.account_id', DB::raw('SUM(payment_requests.amount) as total_amount'))
                    ->groupBy('users.id', 'users.name', 'users.email', 'users.account_id') // Include all necessary columns in GROUP BY
                    ->paginate(100);
        */
    $sort = $request->get('sort', '');

     $list = DB::table('users')
    ->where('users.role', 'publisher')
    ->leftJoin(DB::raw('(SELECT user_id, SUM(amount) as total_amount FROM payment_requests WHERE status = "paid" GROUP BY user_id) as pr'), 'users.id', '=', 'pr.user_id') // Subquery for correct sum of payment requests
    ->leftJoin('credit', 'users.id', '=', 'credit.user_id')
    ->leftJoin(DB::raw('(SELECT user_id, 
                                COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as today_clicks,
                                COUNT(CASE WHEN DATE(created_at) = CURDATE() - INTERVAL 1 DAY THEN 1 END) as yesterday_clicks,
                                COUNT(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) THEN 1 END) as month_clicks,
                                COUNT(CASE WHEN MONTH(created_at) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN 1 END) as last_month_clicks
                         FROM clicks
                         GROUP BY user_id) as cl'), 'users.id', '=', 'cl.user_id') // Subquery to count distinct clicks by user
    ->select(
        'users.id', 
        'users.name', 
        'users.email', 
        'users.account_id', 
        'pr.total_amount',  // Correctly calculated total amount from the subquery
        'credit.credit as user_credit',  // Fetch the credit column directly
        'cl.today_clicks',   // Correctly calculated today clicks
        'cl.yesterday_clicks', // Yesterday's clicks
        'cl.month_clicks',  // This month's clicks
        'cl.last_month_clicks' // Last month's clicks
    )
    ->groupBy('total_amount','users.id', 'users.name', 'users.email', 'users.account_id', 'credit.credit', 'cl.today_clicks', 'cl.yesterday_clicks', 'cl.month_clicks', 'cl.last_month_clicks'); // Group by necessary columns
    
     // Apply sorting based on the request
    if ($sort == 'clicks') {
        $list = $list->orderBy('cl.month_clicks', 'desc');  // Sort by clicks (descending)
    } 
    
    elseif ($sort == 'paid') {
        $list = $list->orderBy('total_amount', 'desc');   // Sort by user balance (descending)
    }
    
    elseif ($sort == 'balance') {
        $list = $list->orderBy('credit.credit', 'desc');   // Sort by user balance (descending)
    }
    
    
    
    
    $list = $list->paginate(100);


        return view('userlist',compact('total_users','user_balance','paid','list'));
    }


    public function Support()
    {
        return view('support');
    }

    //Show list of ad groups
    public function Adgroup()
    {
       // Get the authenticated user's ID
    $userId = Auth::id();
   
    // Fetch ad groups for the user with the count of associated campaigns
    $adgroup_list = AdgroupModel::where('user_id', $userId)
        ->withCount(['campaigns' => function ($query) /*use ($userId) */ {
           # $query->where('user_id', $userId);
        }])
        ->get();

        return view('campaign.adgroup',compact('adgroup_list'));
    }


    // show adgroup create page
    public function createAdgroup()
    {
       
        return view('campaign.create-adgroup');
    }


    // Store new agroup
    public function storeAdgroup(Request $request)
    {
         $request->validate([
            'adgroup_name' => 'required|string|max:255',
            ]);


        $adgroup = new AdgroupModel([
            'adgroup_name' => $request->input('adgroup_name'),
            'user_id' => Auth::id(),
            'adgroup_id' => $request->input('adgroup_id'),          
        ]);

        $adgroup->save(); 
        return redirect()->back()->with('success', 'Campaign created successfully!');       
        return view('campaign.create-adgroup');
    }



    public function Transaction()
    {
        /*
        $payment_requests = DB::table('payment_requests')
                        ->join('users', 'payment_requests.user_id', '=', 'users.id')
                        ->where('status','pending')
                        ->select('payment_requests.*', 'users.name')
                        ->paginate(10);

        $total = DB::table('payment_requests')
                        ->where('status','pending')
                        ->sum('amount'); 
                        */
        $userId = Auth::id();  

        $balance = DB::table('balance')
                        ->where('user_id',$userId)
                        ->first(); 
        return view('transaction.list',compact('balance'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'utm_source' => 'string|max:255',
            'utm_medium' => 'string|max:255',
            'utm_campaign' => 'string|max:255',
            //'search_terms' => 'string|max:255',
            'landing_page' => 'required|url',
            'final_url' => 'required|url',
            'age_group' => 'required',
            'gender' => 'required',
            'end_date' => 'required|date',
           
            
            
        ]);

        
        
        // Create a new campaign record
        $status = 'Under Review';
        $campaign = new campaignModel([
            'campaign_name' => $request->input('campaign_name'),
            
            'landing_page' => $request->input('landing_page'),
            
            'final_url' => $request->input('final_url'),
            'end_date' => $request->input('end_date'),
            'daily_budget' => $request->input('daily_budget'),
            
            'user_id' => Auth::id(),
            'status' => $status,
            'age_group' => $request->input('age_group'),
            'gender' => $request->input('gender'),
            'cpc' => $request->input('cpc'),
            //'search_terms' => $request->input('search_terms'),
            //'referrer' => $request->input('referrer'),
            'adgroup_id' => $request->input('adgroup_id'),
                     
        ]);

       

         
        

        $campaign->save();
        #$campaign->countries()->attach($request->countries); 

         $validated = $request->validate([
        'countries' => 'required|array|min:1',
        'countries.*' => 'exists:countries,id'
         ]);   
        $countryData = [];
        foreach ($validated['countries'] as $countryId) {
            $countryData[] = [
                'campaign_id' => $campaign->id,
                'country_id' => $countryId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('campaign_country')->insert($countryData);
        
        return redirect()->back()->with('success', 'Campaign created successfully!');              
    }




    // Dashboard
    public function advertiserDashboard()
    {
        $user = Auth::user()->id;
        /*
        $balance  = DB::table('balance')
                    ->where('user_id',$user)
                    ->value('balance'); */

        $today_liability = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::today())
                    ->sum('cost');

        $yesterday_liability = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::yesterday())
                    ->sum('cost');

        $this_month = DB::table('clicks')   
                     ->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)
                    ->sum('cost'); 

        $last_month = DB::table('clicks')   
                     ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->subMonth(), 
                    Carbon::now()->subMonth()->endOfMonth()  
                ])
                    ->sum('cost');                                   


        $today_clicks = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::today())
                    ->count();

        $yesterday_clicks = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::yesterday())
                    ->count();

        $this_month_clicks = DB::table('clicks')   
                      ->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)
                    ->count();                                                  
                    
        return view('dashboard',compact('this_month_clicks','yesterday_clicks','today_clicks','today_liability','yesterday_liability','this_month','last_month'));
    }

    // delete campaign
    public function deletecampaign($id) 
    {
       $item = campaignModel::find($id);

        if (!$item) {
                abort(404, 'Campaign not found');
            }

        if ($item->user_id !== Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

        if ($item) {
            $item->delete();
            return redirect()->route('campaign-list')->with('success', 'Item deleted successfully.');
        }

        return redirect()->route('dashboard')->with('error', 'Item not found.');
    }

    public function EmailCampagnShow(){
        return view('emailcampaigns');
    }

    public function SendCampaignEmails(Request $request){
       {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Retrieve all users with the 'publisher' role
        $publishers = User::where('role', 'publisher')->get();
        
        // Dispatch a job for each publisher to send the email asynchronously
        foreach ($publishers as $publisher) {
            SendEmailJob::dispatch($publisher->email, $request->title, $request->message);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Emails are being sent to all publishers.');
    }
    }



    public function redirectToArticle($id)
{
    $task = Task::findOrFail($id);
    
    // Build the referrer URL, UTM parameters, etc.
    $utmParams = http_build_query([
        'utm_source' => $task->utm_source,
        'utm_medium' => $task->utm_medium,
        'utm_campaign' => $task->utm_campaign,
    ]);

    $referrerUrl = $task->referrer === 'google' ? 
                   "https://www.google.com/search?q=" . urlencode($task->search_terms) . "&$utmParams" :
                   "https://www.{$task->referrer}.com?$utmParams";

    // Redirect to the landing page with referrer as query parameter
    return redirect()->away("{$task->landing_page}?ref=" . urlencode($referrerUrl));
}


// Get users initials
public function getInitialsAttribute()
    {
        $name = trim($this->name);
        
        if (empty($name)) {
            return '??';
        }
        
        $names = explode(' ', $name);
        
        // Single name: take first 2 letters
        if (count($names) === 1) {
            return strtoupper(substr($name, 0, 2));
        }
        
        // Multiple names: take first letter of first and last name
        $initials = strtoupper($names[0][0]);
        
        // Get last non-empty name
        for ($i = count($names) - 1; $i > 0; $i--) {
            if (!empty($names[$i])) {
                $initials .= strtoupper($names[$i][0]);
                break;
            }
        }
        
        return substr($initials, 0, 2);
    }



   
}
