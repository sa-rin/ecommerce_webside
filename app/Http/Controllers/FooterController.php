<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{
    // 1) Create form
    public function create()
    {
        return view('footer');
    }

    // 2) Store
    public function store(Request $request)
    {
        $request->validate([
            'CompanyName' => 'nullable|string|max:255',
            'Address' => 'nullable|string|max:255',
            'Phone' => 'nullable|string|max:50',
            'Email' => 'nullable|email|max:255',
            'Facebook' => 'nullable|string|max:255',
            'Telegram' => 'nullable|string|max:255',
            'Youtube' => 'nullable|string|max:255',
            'Copyright' => 'nullable|string|max:255',
            'IsActive' => 'nullable|boolean',
        ]);

        Footer::create([
            'CompanyName' => $request->CompanyName,
            'Address' => $request->Address,
            'Phone' => $request->Phone,
            'Email' => $request->Email,
            'Facebook' => $request->Facebook,
            'Telegram' => $request->Telegram,
            'Youtube' => $request->Youtube,
            'Copyright' => $request->Copyright,
            'IsActive' => $request->IsActive ?? 1,
        ]);

        return redirect()->route('footer.list')->with('success', 'Footer created successfully.');
    }

    // 3) List
    public function list()
    {
        $Footers = Footer::orderBy('id', 'desc')->get();
        return view('footer_list', compact('Footers'));
    }

    // 4) Show edit
    public function showEdit($id)
    {
        $Footer = Footer::findOrFail($id);
        return view('footerEdit', compact('Footer'));
    }

    // 5) Update
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'CompanyName' => 'nullable|string|max:255',
            'Address' => 'nullable|string|max:255',
            'Phone' => 'nullable|string|max:50',
            'Email' => 'nullable|email|max:255',
            'Facebook' => 'nullable|string|max:255',
            'Telegram' => 'nullable|string|max:255',
            'Youtube' => 'nullable|string|max:255',
            'Copyright' => 'nullable|string|max:255',
            'IsActive' => 'nullable|boolean',
        ]);

        $Footer = Footer::findOrFail($request->id);

        $Footer->update([
            'CompanyName' => $request->CompanyName,
            'Address' => $request->Address,
            'Phone' => $request->Phone,
            'Email' => $request->Email,
            'Facebook' => $request->Facebook,
            'Telegram' => $request->Telegram,
            'Youtube' => $request->Youtube,
            'Copyright' => $request->Copyright,
            'IsActive' => $request->IsActive ?? 1,
        ]);

        return redirect()->route('footer.list')->with('success', 'Footer updated successfully.');
    }

    // 6) Delete
    public function delete($id)
    {
        $Footer = Footer::findOrFail($id);
        $Footer->delete();

        return redirect()->route('footer.list')->with('success', 'Footer deleted successfully.');
    }
}

