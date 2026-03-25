<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
class SliderController extends Controller
{
    //
     public function create()
    {
        return view('slider');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'nullable|string|max:255',
            'SubTitle' => 'nullable|string|max:255',
            'Link' => 'nullable|string|max:255',
            'SortOrder' => 'nullable|integer',
            'IsActive' => 'nullable|boolean',
            'SliderImage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('SliderImage')) {
            $file = $request->file('SliderImage');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img/slider'), $fileName);
        }

        Slider::create([
            'Title' => $request->Title,
            'SubTitle' => $request->SubTitle,
            'Link' => $request->Link,
            'SortOrder' => $request->SortOrder ?? 0,
            'IsActive' => $request->IsActive ?? 1,
            'SliderImage' => $fileName,
        ]);

        return redirect()->route('slider.list')->with('success','Slider created successfully.');
    }

    public function list()
    {
        $Sliders = Slider::orderBy('SortOrder','asc')->orderBy('id','desc')->get();
        return view('slider_list', compact('Sliders'));
    }

    public function showEdit($id)
    {
        $Slider = Slider::findOrFail($id);
        return view('sliderEdit', compact('Slider'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'Title' => 'nullable|string|max:255',
            'SubTitle' => 'nullable|string|max:255',
            'Link' => 'nullable|string|max:255',
            'SortOrder' => 'nullable|integer',
            'IsActive' => 'nullable|boolean',
            'SliderImage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $Slider = Slider::findOrFail($request->id);

        $fileName = $Slider->SliderImage;
        if ($request->hasFile('SliderImage')) {
            $file = $request->file('SliderImage');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img/slider'), $fileName);

            if (!empty($Slider->SliderImage)) {
                $oldPath = public_path('img/slider/'.$Slider->SliderImage);
                if (file_exists($oldPath)) @unlink($oldPath);
            }
        }

        $Slider->update([
            'Title' => $request->Title,
            'SubTitle' => $request->SubTitle,
            'Link' => $request->Link,
            'SortOrder' => $request->SortOrder ?? 0,
            'IsActive' => $request->IsActive ?? 1,
            'SliderImage' => $fileName,
        ]);

        return redirect()->route('slider.list')->with('success','Slider updated successfully.');
    }

    public function delete($id)
    {
        $Slider = Slider::findOrFail($id);

        if (!empty($Slider->SliderImage)) {
            $oldPath = public_path('img/slider/'.$Slider->SliderImage);
            if (file_exists($oldPath)) @unlink($oldPath);
        }

        $Slider->delete();
        return redirect()->route('slider.list')->with('success','Slider deleted successfully.');
    }
}
