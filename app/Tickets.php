<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
        'ticket_name', 'clearance_lvl',
    ];

    //get ticket name and lvls
    function get_all_tickets()
    {
        return $query = Tickets::select('ticket_name', 'clearance_lvl')->get();
    }

    //get detailed tickets info
    function ticket_details()
    {
        return Tickets::all();
    }

    //update tickets info
    function update_ticket($id, $data)
    {
        return Tickets::where('id', $id)
                        ->update($data);
    }

    // delete ticket info
    function delete_ticket($id)
    {
        return Tickets::where('id', $id)
                        ->delete();
    }

    //check if ticket is booked or not
    function checkBooked($lvl)
    {
        $booked =  Tickets::where('clearance_lvl', $lvl)
            ->where('booked', '0')
            ->first();

        if ($booked === null)
            return 0;
        else
            return 1;
    }

    //book ticket 
    function book_ticket($lvl)
    {
        $book = Tickets::where('clearance_lvl', $lvl)->update(array('booked' => '1'));
        if ($book)
            return 1;
        else
            return 0;
    }
}
