<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //returns all the items in the database and orders by DESCENDING order by the column created. 
        //So the newest created item will be at the top of the list.
        return Item::orderBy('created_at', 'DESC')->get();
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
        //save a new item to database
        $newItem=new Item;//new model
        $newItem->name = $request->weather["name"];//set the name var to name that is in the object returned
        $newItem->weather = $request->weather["weather"];
        $newItem->save();

        return $newItem;
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
        $existingitem = Item::find($id);//find the item that is in the URL
        if($existingitem){
            $existingitem->weather = $request->weather['weather']; //is completed true? if it is set it in the database to true otherwise set to false
          
            $existingitem->save();
            return $existingitem;
        }

        return "Item not found";//if no existing item is not found
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingitem=Item::find($id);

        if($existingitem){
            $existingitem->delete();
            return "Item successfully deleted";
        }

        return "item not found";
    }

    public function moreInfo($id){
        $existingitem=Item::find($id);
        if($existingitem){
        return $existingitem;
        }
    }
}
