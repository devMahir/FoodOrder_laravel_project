<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Carbon\carbon;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str::of($request->name)->slug('_');

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'_'.$currentDate.'_'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('uploads/item')) {
                mkdir('uploads/item',0777,true);
            }
            $image->move('uploads/item',$imagename);
        }else {
            $imagename = 'default.png';
        }

        $item = new Item();
        $item -> category_id = $request -> category;
        $item -> name = $request -> name;
        $item -> description = $request -> description;
        $item -> price = $request -> price;
        $item -> image = $imagename;
        $item -> save();
        return redirect()->route('item.index')->with('successMsg','Slider Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str::of($request->name)->slug('_');
        $item = Item::find($id);
        
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'_'.$currentDate.'_'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('uploads/item')) {
                mkdir('uploads/item',0777,true);
            }
            unlink('uploads/item/'.$item->image);
            $image->move('uploads/item',$imagename);
        }else {
            $imagename = $item->image;
        }

        $item -> category_id = $request -> category;
        $item -> name = $request -> name;
        $item -> description = $request -> description;
        $item -> price = $request -> price;
        $item -> image = $imagename;
        $item -> save();
        return redirect()->route('item.index')->with('successMsg','Slider Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (file_exists('uploads/item/'.$item->image)) {
            unlink('uploads/item/'.$item->image);
        }
        $item -> delete();
        return redirect()->back()->with('successMsg','Item successfully Deleted');
    }
}
