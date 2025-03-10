<?php

namespace App\Http\Controllers;

use App\Models\TicketModel as Ticket;
use App\Models\User;
use App\Models\TicketImage;
use App\Models\TicketStatusLog;
use App\Models\clientModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;



class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select('ticket_models.*', 'assigned_user.name as assigned_user_name', 'created_by_user.name as created_by_user_name','project_status.status_name as project_status_name')
                  ->join('users as assigned_user', 'ticket_models.assigned_user', '=', 'assigned_user.id')
                  ->join('users as created_by_user', 'ticket_models.created_by', '=', 'created_by_user.id')
                  ->join('project_status','project_status.id','=','ticket_models.project_status')
                  ->orderBy('id', 'desc')
                  ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users =   User::where('is_delete', 0)->get();
        $projectStatuses = DB::table('project_status')->get();
        $countries = DB::table('countries')->get();
        $memberships = clientModel::where('memberships',1)->get();
        return view('tickets.create', compact('users','projectStatuses','countries','memberships'));
    }

    public function store(Request $request)
    {

        if($request->client_type == 'membership'){

            $validator = Validator::make($request->all(), [
                'client_type' => 'required',
                // Conditional Validation
                'client_id' => 'required',
                // General Project Details
                'project_name' => 'required|string|max:255',
                'project_type' => 'required|string|max:255',
                'project_description' => 'required|string',
                'project_status' => 'required|string|max:255',
                'assigned_user' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()]);
            }

        }else{
            
            $validator = Validator::make($request->all(), [
                'client_type' => 'required',
                // Conditional Validation
                'client_name' => 'required|string|max:255',
                'client_contact_info' => 'required|email|max:255',
                'client_contact_number' => 'required|string|max:20',
                // General Project Details
                'project_name' => 'required|string|max:255',
                'project_type' => 'required|string|max:255',
                'project_description' => 'required|string',
                //  Project Cost Details
                'project_status' => 'required|string|max:255',
                'assigned_user' => 'required|exists:users,id',
                'country' => 'required|exists:countries,id',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()]);
            }
        }


        DB::beginTransaction();

        try {
                $lastTicket = Ticket::orderBy('id', 'desc')->first();
                if ($lastTicket) {
                    $lastTicketNumber = intval(substr($lastTicket->ticket_number, 4)) + 1;
                    $ticket_number = 'FF' . str_pad($lastTicketNumber, 6, '0', STR_PAD_LEFT);
                } else {
                    $ticket_number = 'FF_000001';
                }

                $ticketImages = [];

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $key => $image) {
                        $fileName = time() . $key . '.' . $image->extension();
                        $path = $image->move(public_path('uploads'), $fileName);
                        $ticketImages[] = $fileName;
                    }
                }

                $ticket = new Ticket();
                $ticket->client_type = $request->client_type;
                $ticket->client_id = $request->client_id;
                $ticket->work_expectation_days = $request->work_expectation_days;
                $ticket->ticket_number = $ticket_number;

                if(!empty($request->client_id)){
                    $client = clientModel::where('id', $request->client_id)->first();
                    $ticket->client_name = $client->name;
                    $ticket->client_contact_info = $client->email;
                    $ticket->client_contact_number = $client->phone;
                    $ticket->company_name = $client->company_name;
                }else{
                    $ticket->client_name = $request->client_name;
                    $ticket->client_contact_info = $request->client_contact_info;
                    $ticket->client_contact_number = $request->client_contact_number;
                    $ticket->company_name = $request->company_name;
                }
                $ticket->project_name = $request->project_name;
                $ticket->project_type = $request->project_type;
                $ticket->project_description = $request->project_description;
                $ticket->project_cost = $request->project_cost;
                $ticket->work_expectation_days = $request->work_expectation_days;

                $ticket->payment_method = $request->payment_method;
                $ticket->project_status = $request->project_status;
                $ticket->assigned_user = $request->assigned_user;
                $ticket->images = (count($ticketImages) > 0) ? json_encode($ticketImages) : null;
                $ticket->created_by = session('loginId');
                $ticket->country = $request->country;
                $ticket->save();
                $lastTicketId = $ticket->id;


                TicketStatusLog::create([
                    'session_id' => session('loginId'),
                    'ticket_id' => $ticket->id,
                    'status' => $request->project_status,
                    'remarks' => 'Ticket created',
                    'created_at' => now(),
                ]);

                $checkUserAlready = clientModel::where('email', $request->client_contact_info)->first();

                if ($checkUserAlready == null) {
                    $client = new clientModel();
                    $client->name = $request->client_name;
                    $client->email = $request->client_contact_info;
                    $client->phone = $request->client_contact_number;
                    $client->country = $request->country;
                    $client->password = Str::random(6) . substr(str_shuffle('!@#$%^&*()1234567890'), 0, 4);
                    $client->save();
                }else{
                    $client = clientModel::where('email', $request->client_contact_info)->first();
                }

                $ticketInfo =  Ticket::select('client_name','client_contact_info','project_cost','ticket_number','work_expectation_days')->where('id', $lastTicketId)->first();
                

                Mail::send('emails.ticketCreate', ['clientName' => $ticketInfo->client_name,
                                                'clientEmail' => $ticketInfo->client_contact_info,
                                                'clientPassword' => $client->password,
                                                'ticketNumber' => $ticketInfo->ticket_number,
                                                'login_url' => url('/login') , 
                                                'logo_url'=> asset('assets/images/logo.png') 
                                                ], function ($message) use ($ticketInfo) {
                    $message->to($ticketInfo->client_contact_info);
                    $message->subject('Ticket Created Successfully');
                });
                
                if(!empty($request->project_cost) && $request->client_type == 'non-membership' && !empty($request->work_expectation_days)){
                        // send mail for payment 
                        Mail::send('emails.paymentRequest', ['ticketInfo' => $ticketInfo,
                                                    'login_url' => url('/login') , 
                                                    'logo_url'=> asset('assets/images/logo.png') 
                                                    ], function ($message) use ($ticketInfo) {
                        $message->to($ticketInfo->client_contact_info);
                        $message->subject('Issue Analysis & Payment Request');
                    });

                }

                if(empty($request->project_cost) && empty($request->work_expectation_days)){
                    Mail::send('emails.issueAnylsis', ['ticketInfo' => $ticketInfo,
                                'login_url' => url('/login') , 
                                'logo_url'=> asset('assets/images/logo.png') 
                    ], function ($message) use ($ticketInfo) {
                        $message->to($ticketInfo->client_contact_info);
                        $message->subject('Issue Analysis in Progress');
                    });
                }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Data submitted successfully.', 'redirect' => url('tickets')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        $users =   User::where('is_delete', 0)->get();
        $countries = DB::table('countries')->get();
        $projectStatuses = DB::table('project_status')->get();


        return view('tickets.edit', compact('ticket','users','projectStatuses', 'countries'));
    }

    public function update(Request $request, $id)
    {

        if($request->client_type == 'membership'){

            $validator = Validator::make($request->all(), [
                'client_type' => 'required',
                // Conditional Validation
                'client_id' => 'required',
                // General Project Details
                'project_name' => 'required|string|max:255',
                'project_type' => 'required|string|max:255',
                'project_description' => 'required|string',
                'project_status' => 'required|string|max:255',
                'assigned_user' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()]);
            }

        }else{
            
            $validator = Validator::make($request->all(), [
                'client_type' => 'required',
                // Conditional Validation
                'client_name' => 'required|string|max:255',
                'client_contact_info' => 'required|email|max:255',
                'client_contact_number' => 'required|string|max:20',
                // General Project Details
                'project_name' => 'required|string|max:255',
                'project_type' => 'required|string|max:255',
                'project_description' => 'required|string',
                //  Project Cost Details
                'project_status' => 'required|string|max:255',
                'assigned_user' => 'required|exists:users,id',
                'country' => 'required|exists:countries,id',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()]);
            }
        }

    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $ticket = Ticket::findOrFail($id);
        $ticketOldInfo = Ticket::where('id', $id)->first();

        if(!empty($ticket->client_id)){
            $client = clientModel::where('id', $request->client_id)->first();
            $ticket->client_name = $client->name;
            $ticket->client_contact_info = $client->email;
            $ticket->client_contact_number = $client->phone;
            $ticket->company_name = $client->company_name;
        }else{
            $ticket->client_name = $request->client_name;
            $ticket->client_contact_info = $request->client_contact_info;
            $ticket->client_contact_number = $request->client_contact_number;
            $ticket->company_name = $request->company_name;
        }
        
        $ticket->project_name = $request->project_name;
        $ticket->project_type = $request->project_type;
        $ticket->project_description = $request->project_description;
        $ticket->project_cost = $request->project_cost;
        $ticket->project_status = $request->project_status;
        $ticket->assigned_user = $request->assigned_user;
        $ticket->work_expectation_days = $request->work_expectation_days;
        $ticket->country = $request->country;
        $deleteImages =   (isset($request->deleteImages) && !empty($request->deleteImages)) ? explode(',', $request->deleteImages): [];

        if (count($deleteImages) > 0) {
            $images = json_decode($ticket->images);
            foreach ($deleteImages as $deleteImage) {
            // $key = array_search($deleteImage,$images);
                //  unset($images[$key]);
                foreach($images as $key=>$imageName){
                    if($key == $deleteImage){
                        unset($images[$key]);
                        break;
                    }
                }

            }
            $ticket->images = (count($images) > 0) ? json_encode($images) : null;
        }



        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $image) {
            $fileName = time().'.'.$image->extension();  
            $path = $image->move(public_path('uploads'), $fileName);
            $newImages[] = $fileName;
            }
            $existingImages = json_decode($ticket->images, true) ?? [];
            $ticket->images = json_encode(array_merge($existingImages, $newImages));
        }


        $update = $ticket->save();

        if ($update) {

            TicketStatusLog::create([
                'session_id' => session('loginId'),
                'ticket_id' => $id,
                'status' => $request->project_status,
                'remarks' => 'Ticket Update',
                'updated_at' => now(),
            ]);


         

            $ticketInfo = Ticket::select('client_name','client_contact_info','project_cost','ticket_number','work_expectation_days')->where('id', $id)->first();
            
            if(!empty($request->project_cost) 
              && $request->client_type == 'non-membership' 
              && !empty($request->work_expectation_days) ){   // send mail for payment 
                Mail::send('emails.paymentRequest', ['ticketInfo' => $ticketInfo,
                                            'login_url' => url('/login') , 
                                            'logo_url'=> asset('assets/images/logo.png') 
                                            ], function ($message) use ($ticketInfo) {
                $message->to($ticketInfo->client_contact_infio);
                $message->subject('Issue Analysis & Payment Request');
            });}



            return response()->json(['success' => true, 'message' => 'Data updated successfully.', 'redirect' => url('tickets')]);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }

    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail(Crypt::decrypt($id));
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    public function view($id)
    {
        $ticket = Ticket::select('ticket_models.*', 'assigned_user.name as assigned_user_name', 'created_by_user.name as created_by_user_name', 'project_status.status_name as project_status_name', 
                                'countries.country_name as country_name')
                  ->join('users as assigned_user', 'ticket_models.assigned_user', '=', 'assigned_user.id')
                  ->join('users as created_by_user', 'ticket_models.created_by', '=', 'created_by_user.id')
                  ->join('project_status','project_status.id','=','ticket_models.project_status')
                  ->leftjoin('countries','countries.id','=','ticket_models.country')
                  ->where('ticket_models.id', Crypt::decrypt($id))
                  ->firstOrFail();

        $ticketLogs = TicketStatusLog::where('ticket_id', $ticket->id)->orderBy('id', "asc")->get();
        $projectStatuses = DB::table('project_status')->get();

        return view('tickets.view', compact('ticket', 'projectStatuses' ,'ticketLogs'));
    }

    public function changeStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->project_status = $request->project_status;
        $ticket->save();

        $log = new TicketStatusLog();
        $log->session_id = session('loginId');
        $log->ticket_id = $ticket->id;
        $log->status = $request->project_status;
        $log->remarks = $request->remarks;
        $log->created_at = now();
        $log->save();

        return redirect()->route('tickets.view', Crypt::encrypt($id))->with('success', 'Ticket status updated successfully.');
    }
}
