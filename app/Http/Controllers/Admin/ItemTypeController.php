<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\itemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTypeController extends Controller
{
    public function index()
    {
        $page_title = 'Item type';
        $empty_message = 'No Item Type Created Yet.';
        $items = itemType::latest()->paginate(getPaginate());
        return view('admin.items.types.index', compact('page_title', 'empty_message', 'items'));
    }

    public function create()
    {
        $page_title = 'Create item type';
        return view('admin.items.types.create', compact('page_title'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);

        DB::beginTransaction();
        try {
            $itemType = itemType::create($data);
            DB::commit();
            $notify[] = ['success', 'New item Type has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data!Try Again'];
        }
        return redirect()->route('admin.item_types.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Item Type';
        $item = itemType::findOrFail($id);
        return view('admin.items.types.edit', compact('page_title', 'item'));
    }


    public function update(Request $request, $id)
    {
        $itemType = itemType::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);
        DB::beginTransaction();
        try {

            $data['status'] = isset($request->status) ? 1 : 0;
            $itemType->update($data);
            DB::commit();
            $notify[] = ['success', 'item Type has been update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.item_types.index')->withNotify($notify);
    }
}
