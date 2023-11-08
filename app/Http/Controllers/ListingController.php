<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    // show all listings
    public function index()
    {

        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(5);

        // also use this
        // $listings = DB::table('listings')->where('tags', 'like',  '%' . request('tag') . '%')->get();

        // DB::table('listings')->where('title', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%')
        // ->orWhere('tags', 'like',  '%' . request('search') . '%');

        return view('listings.index', [
            'listings' => $listings
        ]);
    }

    // show single listings
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listings' => $listing
        ]);
    }

    // show  listings form
    public function create()
    {
        return view('listings.create');
    }

    // store  listings form
    public function store(Request $request)
    {

        $formFields =   $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => 'required',
            'website' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {

        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Access');
        }

        $formFields =   $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => 'required',
            'website' => 'required',
            'description' => 'required',
            'tags' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing update successfully!');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Access');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing delete successfully!');
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
