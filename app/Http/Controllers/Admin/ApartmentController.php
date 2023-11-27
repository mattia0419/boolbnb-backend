<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\Apartment;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
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

        $cover_image_path = Storage::put("uploads/apartments/{$apartment->id}/cover_img", $data['cover_img']);
        $apartment->cover_img = $cover_image_path;
        $apartment->save();

        if (Arr::exists($data, "services")) {

            $apartment->services()->attach($data["services"]);
        }

        if ($apartment->address) {
            $client = new Client(['verify' => false]);
            $address = urlencode($apartment->address);

            $response = $client->get('https://api.tomtom.com/search/2/geocode/' . $address . '.json', [
                'query' => [
                    'key' => 'EoW1gArKxlBBEKl68AZm1uhfhcLougV4',
                ],
            ]);
            error_log(print_r($response, true));
            $data = json_decode($response->getBody(), true);
            $apartment->latitude = $data['results'][0]['position']['lat'];
            $apartment->longitude = $data['results'][0]['position']['lon'];

            $apartment->save();
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
        $user = Auth::user();
        if ($apartment->user_id == $user->id) {
            $services = Service::all();
            $service_ids = $apartment->services->pluck('id')->toArray();
            return view('admin.apartments.edit', compact('apartment', 'services', 'service_ids'));
        } else {
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        $apartment->update($data);
        if ($request->hasFile('cover_img') && $request->file('cover_img')->isValid()) {
            if ($apartment->cover_img) {
                Storage::delete($apartment->cover_img);
            }

            $image_path = Storage::put("uploads/apartments/{$apartment->id}/cover_img", $data["cover_img"]);
            $apartment->cover_img = $image_path;
        }

        if (Arr::exists($data, "services")) {
            $apartment->services()->sync($data["services"]);
        }

        if ($apartment->address) {
            $client = new Client(['verify' => false]);
            $address = urlencode($apartment->address);

            $response = $client->get('https://api.tomtom.com/search/2/geocode/' . $address . '.json', [
                'query' => [
                    'key' => 'EoW1gArKxlBBEKl68AZm1uhfhcLougV4',
                ],
            ]);
            error_log(print_r($response, true));  // * <--
            $data = json_decode($response->getBody(), true);
            $apartment->latitude = $data['results'][0]['position']['lat'];
            $apartment->longitude = $data['results'][0]['position']['lon'];
            $apartment->save();
        }

        if (!$apartment->address) {
            $apartment->latitude = null;
            $apartment->longitude = null;

            $apartment->save();
        }

        return redirect()->route("admin.apartments.show", compact("apartment"));
        //# *

        // * volendo è possibile toglierlo. o aggiungerlo sotto con catch (\Exception $e) {
        // * Gestisci l'errore in qualche modo, ad esempio registrandolo o restituendo una risposta di errore.
        // * Log::error($e->getMessage());
        // * return response()->json(['error' => 'Errore durante la chiamata API.'], 500);
        // * }     questo punto è possibile inserirllo dove sta l'asterisco.

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        if ($apartment) {
            Storage::delete($apartment);
        }
        $apartment->delete();
        return redirect()->route('admin.apartments.index');

    }
}