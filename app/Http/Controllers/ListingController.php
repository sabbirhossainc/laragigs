<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create From
    public function create()
    {
        return view('listings.create');
    }

    // Show Listing Data
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->file('logo'));
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // relation foreignkey---
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        // Session::flash('message', 'Listing Created');

        return redirect('/')->with('success', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        // dd($listing->description);
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'

        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        // Session::flash('message', 'Listing Created');

        return back()->with('success', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();
        return redirect('/')->with('success', 'Listing deleted successfully');
    }

    // Manage Listing
    public function manage()
    {
        return view('listings.manage',['listings' => auth()->user()->listings()->get()]);
    }
}
