<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;



class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::orderBy('order')->get();
        return Inertia::render('Slides/Index', [
            "slides" => $slides
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Slides/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'text' => "required",
            'order' => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $imagePath = $request->file('image')->store('slides', 'public');


        Slide::create([
            "text" => $request->text,
            "order" => $request->order,
            'image' => $imagePath,
        ]);
        return redirect()->route("slides.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = Slide::find($id);
        return Inertia::render("Slides/Edit", [
            "slide" => $slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'text' => 'required|string|max:255',
            'order' => 'required|integer|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $slide = Slide::find($id);
        $slide->text = $request->text;
        $slide->order = $request->order;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
            $imagePath = $request->file('image')->store('slides', 'public');
            $slide->image = $imagePath;
        }

        $slide->save();

     return redirect()->route('slides.index')->with('success', 'Slide updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slide = Slide::find($id);

        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route("slides.index");
    }
}
