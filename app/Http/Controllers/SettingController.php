<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $all_sites = Website::get();
        return view('settings.sites.index', compact('all_sites'));
    }

    public function add_website()
    {
        return view('settings.sites.create');
    }

    public function store_website(Request $request)
    {
        $this->validate($request,[
           'site_title' => 'required',
           'site_url' => 'required',
           'wordpress_username' => 'required',
           'wordpress_password' => 'required',
        ]);

        $website = new Website();
        $website->site_title = $request->site_title;
        $website->site_url = $request->site_url;
        $website->wordpress_username = $request->wordpress_username;
        $website->wordpress_password = $request->wordpress_password;
        $website->save();

        return redirect()->back()->with('success', 'Website Added Successfully');

    }

    public function edit_website($id)
    {
        $website = Website::find($id);
        return view('settings.sites.edit', compact('website'));
    }

    public function update_website(Request $request, $id)
    {
        $this->validate($request,[
            'site_title' => 'required',
            'site_url' => 'required',
            'wordpress_username' => 'required',
            'wordpress_password' => 'required',
        ]);

        $website = Website::find($id);
        $website->site_title = $request->site_title;
        $website->site_url = $request->site_url;
        $website->wordpress_username = $request->wordpress_username;
        $website->wordpress_password = $request->wordpress_password;
        $website->save();

        return redirect()->back()->with('success', 'Website Updated Successfully');
    }

}
