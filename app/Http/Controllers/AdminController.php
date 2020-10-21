<?php

namespace App\Http\Controllers;

use Session;
use App\Tickets;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $tickets = new Tickets();
        $all_tickets = $tickets->ticket_details();
        return view('admin.dashboard')->with('tickets', $all_tickets);
    }

    //create ticket
    public function create_ticket()
    {
        return view('admin.add_ticket');
    }

    // add ticket
    function add_tickets(Request $request)
    {
        $validateData = $request->validate([
            'ticket_name' => 'required|max:255',
            'clearance_lvl' => 'required|numeric|unique:tickets',
        ]);
        $request = $request->all();
        $ticket = new Tickets();
        $ticket->ticket_name = $request['ticket_name'];
        $ticket->clearance_lvl = $request['clearance_lvl'];
        $ticket->save();
        Session::flash('message', 'Ticket Added Successfully'); 
        return redirect('/create-tickets');
    }

    //update ticket details
    function update_ticket(Request $request)
    {
        $ticket = new Tickets();
        $validateData = $request->validate([
            'ticket_name' => 'required|max:255',
            'clearance_lvl' => 'required|numeric|unique:tickets',
            'booked' => 'required',
        ]);
        $request = $request->all();

        $data = array(
            'ticket_name' => $request['ticket_name'],
            'clearance_lvl' => $request['clearance_lvl'],
            'booked' => $request['booked']
        );
        $ticket->update_ticket($request['ticket'], $data);
        return redirect('/admin');
    }

    //delete ticket details
    function delete_ticket(Request $request)
    {
        $request = $request->all();
        $ticket = new Tickets();
        $ticket->delete_ticket($request['ticket']);
        return redirect('/admin');
    }

    //book tickets
    public function book_ticket(Request $request)
    {
        // get all the tickets name and clearance lvl
        $tickets = new Tickets();
        $all_tickets = $tickets->get_all_tickets();
        $clearance_lvl_list = [];
        foreach ($all_tickets as $name) {
            array_push($clearance_lvl_list, $name->clearance_lvl);
        }


        $sum = $request['ticket_num'];
        $original_sum = $sum;
        $n = count($clearance_lvl_list);
        $store_temp_lvls = array();

        //find out the combination of subset that can formed by user input value ($sum)
        $this->printAllSubsetsRec($clearance_lvl_list, $n, $store_temp_lvls, $sum, $original_sum);
    }

    public function printAllSubsetsRec($clearance_lvl_list, $n, $store_temp_lvls, $sum, $original_sum)
    {
        $temp_lvl = [];
        $tickets = new Tickets();
        if ($sum == 0) {
            for ($i = 0; $i < count($store_temp_lvls); $i++) {
                //check if ticket booked or not
                if ($tickets->checkBooked($store_temp_lvls[$i])) {
                    // echo $store_temp_lvls[$i] . ","; 
                    array_push($temp_lvl, $store_temp_lvls[$i]);
                }
            }
            //book ticket
            if (array_sum($temp_lvl) == $original_sum) {
                echo json_encode($temp_lvl);
                for ($j = 0; $j < count($temp_lvl); $j++) {
                    $tickets->book_ticket($temp_lvl[$j]);
                }
                die();
            }

            echo "\n";
            return;
        }
        if ($n == 0) {
            return;
        }

        $this->printAllSubsetsRec($clearance_lvl_list, $n - 1, $store_temp_lvls, $sum, $original_sum);
        array_push($store_temp_lvls, $clearance_lvl_list[$n - 1]);
        $this->printAllSubsetsRec(
            $clearance_lvl_list,
            $n - 1,
            $store_temp_lvls,
            $sum - $clearance_lvl_list[$n - 1],
            $original_sum
        );
    }
}
