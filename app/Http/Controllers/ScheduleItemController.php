<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleItem;

class ScheduleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $schedule_id)
    {
        return view('schedule_items.create', compact('schedule_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $schedule_id)
    {
        $request->validate([
            'item_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
        ]);

        // $schedule_item = new ScheduleItem($request->all());
        $schedule_item = new ScheduleItem([
            'item_name' => $request->input('item_name'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
        ]);

        $schedule_item->schedule_id = $schedule_id;
        $schedule_item->save();

        return redirect()->route('schedules.show', $schedule_id)
            ->with('success', 'Schedule item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(ScheduleItem $schedule_item)
    {
        return view('schedule_items.edit', compact('schedule_item'));
    }

    public function update(Request $request, ScheduleItem $schedule_item)
    {
        $request->validate([
            'item_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
        ]);

        $schedule_item->update($request->all());

        return redirect()->route('schedules.show', $schedule_item->schedule_id)
            ->with('success', 'Schedule item updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleItem $schedule_item)
    {
        $schedule_item->delete();
        return redirect()->route('schedules.show', $schedule_item->schedule_id)->with('success', 'Schedule item deleted successfully.');
    }
}
