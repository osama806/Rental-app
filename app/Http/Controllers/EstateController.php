<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\RealEstate;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $estates = RealEstate::all();
        $reserves = Reserve::all();
        foreach ($reserves as $reserve) {
            $date = Carbon::parse($reserve->expired_date);
            if (!$date->isFuture()) {
                $reserve->estate->reserved = "no";
                $reserve->save();
            }
        }
        $contracts = Contract::all();
        foreach ($contracts as $contract) {
            $date = Carbon::parse($contract->expired_date);
            if (!$date->isFuture()) {
                $contract->estate->rented = "no";
                $contract->save();
            }
        }
        $data = [
            "estates"       =>      $estates
        ];
        return view(view: "Owner.Estate.index", data: $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: "Owner.Estate.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "broker"            =>      "required|string|max:255",
            "type"              =>      "required|string|max:255",
            "price"             =>      "required|numeric",
            "beds"              =>      "required|numeric",
            "paths"             =>      "required|numeric",
            "address"           =>      "required|string|max:255",
            "state"             =>      "required|string|max:255",
            "locality"          =>      "required|string|max:255",
            "sub_locality"      =>      "required|string|max:255",
            "street"            =>      "required|string|max:255",
        ]);
        $record_create = RealEstate::create([
            "broker"            =>      $request->broker,
            "type"              =>      $request->type,
            "price"             =>      $request->price,
            "beds"              =>      $request->beds,
            "paths"             =>      $request->paths,
            "address"           =>      $request->address,
            "state"             =>      $request->state,
            "locality"          =>      $request->locality,
            "sub_locality"      =>      $request->sub_locality,
            "street"            =>      $request->street_name,
            "owner"             =>      auth()->user()->name,
            "reserved"          =>      "no",
            "rented"            =>      "no"
        ]);
        if (!$record_create) {
            $record_create->delete();
            return redirect()->back()->with("msg", "This information not saved, Because of a problem");
        }
        return redirect()->route("estates.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estate = RealEstate::find($id);
        $data = [
            "estate"        =>      $estate
        ];
        return view(view: "Owner.Estate.show", data: $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $estate = RealEstate::find($id);
        $data = [
            "estate"        =>      $estate
        ];
        return view(view: "Owner.Estate.edit", data: $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $estate = RealEstate::find($id);
        $request->validate([
            "broker"            =>      "required|string|max:255",
            "type"              =>      "required|string|max:255",
            "price"             =>      "required|numeric",
            "beds"              =>      "required|numeric",
            "paths"             =>      "required|numeric",
            "address"           =>      "required|string|max:255",
            "state"             =>      "required|string|max:255",
            "locality"          =>      "required|string|max:255",
            "sub_locality"      =>      "required|string|max:255",
            "street"            =>      "required|string|max:255",
        ]);
        $estate->broker = $request->broker;
        $estate->type = $request->type;
        $estate->price = $request->price;
        $estate->beds = $request->beds;
        $estate->paths = $request->paths;
        $estate->address = $request->address;
        $estate->state = $request->state;
        $estate->locality = $request->locality;
        $estate->sub_locality = $request->sub_locality;
        $estate->street_name = $request->street;
        $estate->save();
        return redirect()->route("estates.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estate = RealEstate::find($id);
        $estate->delete();
        return redirect()->route("estates.index");
    }
}
