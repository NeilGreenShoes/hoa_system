<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\AppConfig;

class AppConfigController extends Controller
{
    public function index()
    {
        $appConfig = AppConfig::first();
        return view('admin.app_config.index', compact('appConfig'));
    }

    public function edit()
    {
        $appConfig = AppConfig::first();
        return view('admin.app_config.edit', compact('appConfig'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'primary_color' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'sidebar_color_primary' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'sidebar_color_secondary' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'background_color' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $config = AppConfig::first();

        if ($request->hasFile('app_logo') && $request->file('app_logo')->isValid()) {

            if ($config && $config->app_logo) {
                Storage::disk('public')->delete($config->app_logo);
            }

            $validated['app_logo'] = $request->file('app_logo')->store('app_logos', 'public');
        }

        $config->update([
            'app_name' => $validated['app_name'],
            'primary_color' => $validated['primary_color'],
            'secondary_color' => $validated['secondary_color'],
            'sidebar_color_primary' => $validated['sidebar_color_primary'],
            'sidebar_color_secondary' => $validated['sidebar_color_secondary'],
            'background_color' => $validated['background_color'],
            'app_logo' => $validated['app_logo'] ?? $config->app_logo,
        ]);

        return redirect()
            ->route('admin.app_config.index')
            ->with('message', 'App configuration updated successfully.');
    }
}
