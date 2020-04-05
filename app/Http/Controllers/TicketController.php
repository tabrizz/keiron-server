<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\Ticket as TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tickets = Ticket::orderBy('user_id', 'asc')->get();
        
        return response()->json(['tickets' => TicketResource::collection($tickets)]);

        // return response()->json(['tickets' => $tickets]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ticket = new Ticket();
        $ticket->description = $request->description;
        $ticket->user_id = $request->user_id;
        $ticket->save();

        return response()->json(['success' => 'Ticket creado satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $ticket = Ticket::findOrFail($id);

        return response()->json(['tickets' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ticket = Ticket::findOrFail($id);
        $ticket->taken = $request->taken;
        $ticket->save();

        return response()->json(['success' => 'Ticket actualizado satisfactoriamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['success' => 'Ticket borrado satisfactoriamente']);
    }

    public function byUser($id)
    {
        $tickets = Ticket::where('user_id', $id)->get();

        return response()->json(['tickets' => $tickets]);
    }
}
