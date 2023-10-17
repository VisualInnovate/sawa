<?php

namespace App\Http\Controllers\Api;

use App\Models\SitePage;
use App\Models\SiteSettings as SiteSettingsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingsController extends Controller
{
    public function index_pages(Request $request)
    {
        $pages = SitePage::all();

        return response()->json([
            'pages' => $pages,
        ], 200);
    }

    public function store_page(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['required', 'image'],
            'description' => ['required', 'string'],
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $name = time() . '.' . $extension;
        $request->image->move(public_path() . '/images/',  $name);
        $image = '/images/' . $name;

        $page = SitePage::create([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
        ]);

        return response()->json([
            'pages' => $page,
        ], 200);
    }

    public function update_page(SitePage $page, Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['nullable',],
            'description' => ['required', 'string'],
        ]);

        if ($request->file('image')) {

            if (!empty($page->image)) {
                $currentImage = public_path() . $page->image;

                if (file_exists($currentImage)) {
                    unlink($currentImage);
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $request->image->move(public_path() . '/images/',  $name);
            $image = '/images/' . $name;
        }

        $page->update([
            'title' => $request->title ?? $page->title,
            'image' => $image ?? $page->image,
            'description' => $request->description ?? $page->description,
        ]);

        return response()->json([
            'pages' => $page->fresh(),
        ], 200);
    }

    public function index_settings(Request $request)
    {
        $settings = SiteSettingsModel::first();

        if ($settings != null) {
            $settings->logo =  $settings->logo  ?  url($settings->logo)  : null;
            $settings->cover = $settings->cover ?   url($settings->cover) : null;
        }

        return response()->json([
            'settings' => $settings,
        ], 200);
    }

    public function update_settings(Request $request)
    {

        $logo_image = null;
        $cover_image = null;

        $request->validate([
            "name" => ["required", "string"],
            "number_1" => ["required", "string"],
            "number_2" => ["required", "string"],
            "address" => ["required", "string"],
            "email" => ["required", "string"],
            "description" => ["required", "string"],
            "logo" => ["nullable", "image"],
            "cover" => ["nullable", "image"],
            "social_links" => ["required", "string"],
        ]);

        $setting = SiteSettingsModel::first();

        if ($request->file('logo')) {

            if (!empty($setting->logo)) {
                $currentImage = public_path() . $setting->logo;

                if (file_exists($currentImage)) {
                    unlink($currentImage);
                }
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $request->logo->move(public_path() . '/images/',  $name);
            $logo_image = '/images/' . $name;
        }

        if ($request->file('cover')) {

            if (!empty($setting->cover)) {
                $currentImage = public_path() . $setting->cover;

                if (file_exists($currentImage)) {
                    unlink($currentImage);
                }
            }

            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $request->cover->move(public_path() . '/images/',  $name);
            $cover_image = '/images/' . $name;
        }


        if ($setting != null) {

            $setting->update([
                "name" => $request->name,
                "number_1" => $request->number_1,
                "number_2" => $request->number_2,
                "address" => $request->address,
                "email" => $request->email,
                "logo" => $logo_image ?? null,
                "cover" => $cover_image ?? null,
                "description" => $request->description,
                "social_links" => $request->social_links,
            ]);

            $setting = $setting->fresh();

            $setting->logo =  $setting->logo  ?  url($setting->logo)  : null;
            $setting->cover = $setting->cover ?   url($setting->cover) : null;

            return response()->json([
                'settings' => $setting,
            ], 200);
        }

        $setting = SiteSettingsModel::create([
            "name" => $request->name,
            "number_1" => $request->number_1,
            "number_2" => $request->number_2,
            "address" => $request->address,
            "email" => $request->email,
            "logo" => $logo_image ?? null,
            "cover" => $cover_image ?? null,
            "description" => $request->description,
            "social_links" => $request->social_links,
        ]);

        return response()->json([
            'settings' => $setting,
        ], 200);
    }
}
