<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\package;
use App\Models\SponsoreCommissionPlan;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $items = package::latest()->paginate(getPaginate());
        $page_title = 'Packages';
        $empty_message = 'No Package Created Yet.';
        return view('admin.items.packages.index', compact('items', 'page_title', 'empty_message'));
    }
    public function create()
    {
        $page_title = 'New Package';
        $commition_plans = SponsoreCommissionPlan::where('status', 1)->get();
        return view('admin.items.packages.create', compact('commition_plans', 'page_title'));
    }

    public function AddAttribute()
    {
        $attributetypes = attributeType::where('status', 1)->get();
        return view('admin.items.products.add_attribute', compact('attributetypes'))->render();
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => '',
            'unit_id' => 'required',
            'name' => 'required',
            'sku' => '',
            'cost_price' => 'required',
            'sale_price' => 'required',
            'discount_price' => '',
            'tax' => '',
            'short_description' => '',
            'image' => [
                'required',
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])
            ],

        ]);

        DB::beginTransaction();
        try {

            $path = imagePath()['product']['path'];
            $size = imagePath()['product']['size'];
            if ($request->hasFile('image')) {
                try {
                    $filename = uploadImage($request->image, $path, $size);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Image could not be uploaded.'];
                    return back()->withNotify($notify);
                }
            }

            $input_form = [];
            if ($request->has('attribute_type')) {
                for ($a = 0; $a < count($request->attribute_type); $a++) {

                    $arr = array();
                    $arr['attribute_type'] = strtolower(str_replace(' ', '_', $request->attribute_type[$a]));
                    $arr['attribute_value'] = $request->attribute_value[$a];
                    $input_form[$arr['attribute_type']] = $arr;
                }
            }
            if ($request->discount_price == '') {
                $data['discount_price'] = 0.00;
            }

            $data['status'] = isset($request->status) ? 1 : 0;
            $data['image'] = $filename;
            $data['user_data'] = $input_form;
            $product = product::create($data);

            DB::commit();
            $notify[] = ['success', 'New Product has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data!Try Again'];
        }
        return redirect()->route('admin.products.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Product';
        $categories = itemCategory::where('status', 1)->get();
        $units = Itemunit::where('status', 1)->get();
        $attributetypes = attributeType::where('status', 1)->get();
        $item = product::findOrFail($id);
        return view('admin.items.products.edit', compact('page_title', 'item', 'categories', 'units', 'attributetypes'));
    }


    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);
        $data = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => '',
            'unit_id' => 'required',
            'name' => 'required',
            'sku' => '',
            'cost_price' => 'required',
            'sale_price' => 'required',
            'discount_price' => '',
            'tax' => '',
            'short_description' => '',
            'image' => [
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])
            ],

        ]);

        DB::beginTransaction();
        try {
            $filename = $product->image;

            $path = imagePath()['product']['path'];
            $size = imagePath()['product']['size'];
            if ($request->hasFile('image')) {
                try {
                    $filename = uploadImage($request->image, $path, $size);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Image could not be uploaded.'];
                    return back()->withNotify($notify);
                }
            }

            $input_form = [];
            if ($request->has('attribute_type')) {
                for ($a = 0; $a < count($request->attribute_type); $a++) {

                    $arr = array();
                    $arr['attribute_type'] = str_replace(' ', '_', $request->attribute_type[$a]);
                    $arr['attribute_value'] = $request->attribute_value[$a];
                    $input_form[$arr['attribute_type']] = $arr;
                }
            }
            if ($request->discount_price == '') {
                $data['discount_price'] = 0.00;
            }

            $data['status'] = isset($request->status) ? 1 : 0;
            $data['image'] = $filename;
            $data['user_data'] = $input_form;
            $product->update($data);

            DB::commit();
            $notify[] = ['success', 'Product has been Update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data!Try Again'];
        }
        return redirect()->route('admin.products.index')->withNotify($notify);
    }
}
