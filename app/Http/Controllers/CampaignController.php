<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:csv,txt',
        ]);

        // Store the uploaded file
        $path = $request->file('file')->store('campaign_files');

        // Create a new campaign
        $campaign = new Campaign();
        $campaign->name = $request->input('name');
        $campaign->description = $request->input('description');
        $campaign->file_path = $path;
        $campaign->user_id = Auth::id();
        $campaign->save();

        // Parse the CSV file and extract contact details
        $this->processCsv($path);

        return redirect()->route('campaigns.index')->with('success', 'Campaign created successfully!');
    }

    private function processCsv($path)
    {
        $file = Storage::get($path);
        $lines = explode(PHP_EOL, $file);
        $contacts = [];

        foreach ($lines as $line) {
            $contacts[] = str_getcsv($line);
        }

        // Process contacts
        foreach ($contacts as $contact) {
            // Assuming CSV has 'name' and 'email' columns
            if (isset($contact[0], $contact[1])) {
                // Create a contact or do something with the data
                // For example, save to the database
                // Contact::create(['name' => $contact[0], 'email' => $contact[1]]);
            }
        }
    }
}
