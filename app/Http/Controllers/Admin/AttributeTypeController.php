<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\attributeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeTypeController extends Controller
{
    public function index()
    {
        $page_title = 'Attribute Type';
        $empty_message = 'No Attribute Type Created Yet.';
        $items = attributeType::latest()->paginate(getPaginate());
        return view('admin.items.attribute_types.index', compact('page_title', 'empty_message', 'items'));
    }

    public function create()
    {
        $page_title = 'Create Attribute Type';
        return view('admin.items.attribute_types.create', compact('page_title'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);

        DB::beginTransaction();
        try {
            $attributeType = attributeType::create($data);
            DB::commit();
            $notify[] = ['success', 'New Attribute Type has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.attribute_types.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Attribute Type';
        $item = attributeType::findOrFail($id);
        return view('admin.items.attribute_types.edit', compact('page_title', 'item'));
    }


    public function update(Request $request, $id)
    {
        $Itemunit = attributeType::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'status'=>'',
        ]);
        DB::beginTransaction();
        try {
            $Itemunit->update($data);
            DB::commit();
            $notify[] = ['success', 'item Attribute Type been update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.attribute_types.index')->withNotify($notify);
    }
}
