<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itemunit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $page_title = 'Item type';
        $empty_message = 'No Item Unit Created Yet.';
        $items = Itemunit::latest()->paginate(getPaginate());
        return view('admin.items.units.index', compact('page_title', 'empty_message', 'items'));
    }

    public function create()
    {
        $page_title = 'Create item Unit';
        return view('admin.items.units.create', compact('page_title'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);

        DB::beginTransaction();
        try {
            $Itemunit = Itemunit::create($data);
            DB::commit();
            $notify[] = ['success', 'New item Unit has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.item_units.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Item Unit';
        $item = Itemunit::findOrFail($id);
        return view('admin.items.units.edit', compact('page_title', 'item'));
    }


    public function update(Request $request, $id)
    {
        $Itemunit = Itemunit::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);
        DB::beginTransaction();
        try {
            $Itemunit->update($data);
            DB::commit();
            $notify[] = ['success', 'item Unit has been update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.item_units.index')->withNotify($notify);
    }
}
