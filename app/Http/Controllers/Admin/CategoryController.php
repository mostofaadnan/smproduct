<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\itemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $page_title = 'Item Category';
        $empty_message = 'No Item Category Created Yet.';
        $items = itemCategory::latest()->paginate(getPaginate());
        return view('admin.items.categories.index', compact('page_title', 'empty_message', 'items'));
    }

    public function create()
    {
        $page_title = 'Create item type';
        $categories=itemCategory::
        where('status',1)
        ->where('parent_id',null)
        ->get();
        return view('admin.items.categories.create', compact('page_title','categories'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
            'parent_id'=>'',
        ]);

        DB::beginTransaction();
        try {
            $itemCategory = itemCategory::create($data);
            DB::commit();
            $notify[] = ['success', 'New item Category has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data!Try Again'];
        }
        return redirect()->route('admin.item_categories.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Item Category';
        $categories=itemCategory::where('status',1)
        ->where('parent_id',null)
        ->get();
        $item = itemCategory::findOrFail($id);
        return view('admin.items.categories.edit', compact('page_title', 'item','categories'));
    }


    public function update(Request $request, $id)
    {
        $itemCategory = itemCategory::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
            'parent_id'=>'',
        ]);
        DB::beginTransaction();
        try {
            $itemCategory->update($data);
            DB::commit();
            $notify[] = ['success', 'item Category has been update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.item_categories.index')->withNotify($notify);
    }

    public function getSubcategory($id)
    {

        $category = itemCategory::with('child')->find($id);
        return response()->json($category);
    }
}
