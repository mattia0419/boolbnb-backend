<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreApartmentRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $user = Auth::user();

        $apartments = Apartment::where('user_id', '=', $user->id)->paginate(10);

        return view('admin.apartments.index', compact('apartments', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $apartment = new Apartment();
        $apartment->user_id = $user->id;

        $apartment->fill($data);
        $apartment->save();

        $cover_image_path = Storage::put("uploads/apartments/{$apartment->id}/cover_img", $data['cover_img']);
        $apartment->cover_img = $cover_image_path;
        $apartment->save();

        if (Arr::exists($data, "services")) {

            $apartment->services()->attach($data["services"]);
        }
        return redirect()->route("admin.apartments.index", $apartment);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $service_ids = $apartment->services->pluck('id')->toArray();
        return view('admin.apartments.edit', compact('apartment', 'services', 'service_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        $apartment->update($data);
        if ($request->hasFile('cover_img')) {
            if ($apartment->cover_img) {
                Storage::delete($apartment->cover_img);
            }

            $image_path = Storage::put("uploads/apartments/{$apartment->id}/cover_img", $data["cover_img"]);
            $apartment->cover_img = $image_path;
        }

        $apartment->save();

        if (Arr::exists($data, "services"))
            $apartment->services()->sync($data["services"]);

        return redirect()->route("admin.apartments.show", compact("apartment"));

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
    }
}