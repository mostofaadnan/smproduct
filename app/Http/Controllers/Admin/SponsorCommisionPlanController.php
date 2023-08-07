<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SponsoreCommissionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTypeControllerSponsorCommisionPlanController extends Controller
{
    public function index()
    {
        $page_title = 'Sponser Generation Commission Plan';
        $empty_message = 'No Plan Created Yet.';
        $items = SponsoreCommissionPlan::latest()->paginate(getPaginate());
        return view('admin.sponser_commision_plans.index', compact('page_title', 'empty_message', 'items'));
    }

    public function create()
    {
        $page_title = 'Create Sponser Commission Plan';
        return view('admin.sponser_commision_plans.create', compact('page_title'));
    }
    public function addPlan(Request $request)
    {
        $total_generations = $request->total_generations;
        return view('admin.sponser_commision_plans.plan_details', compact('total_generations'))->render();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plan_title' => 'required',
            'sponsore_commission' => 'required|numeric|min:1',
            'total_generation' => 'required|numeric|min:1',
            'commission' => 'required|min:1',
        ]);

        DB::beginTransaction();
        try {
            unset($data['commission']);

            $data['status'] = isset($request->status) ? 1 : 0;
            $SponsoreCommissionPlan = SponsoreCommissionPlan::create($data);

            if (isset($request->commission)) {
                $data_product = [];
                foreach ($request->commission as $key => $commission) {
                    $data_product[] = [
                        'generation' => $request->generation[$key],
                        'commission' => $commission,
                    ];
                }
                $SponsoreCommissionPlan->details()->createMany($data_product);
            }
            DB::commit();
            $notify[] = ['success', 'New Sponsore Commision has been added successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data!Try Again'];
        }
        return redirect()->route('admin.sponsor_generetion_plans.index')->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit Sponser Commission Plan';
        $item = SponsoreCommissionPlan::findOrFail($id);
        return view('admin.sponser_commision_plans.edit', compact('page_title', 'item'));
    }


    public function update(Request $request, $id)
    {
        $SponsoreCommissionPlan = SponsoreCommissionPlan::findOrFail($id);
        $data = $request->validate([
            'plan_title' => 'required',
            'sponsore_commission' => 'required|numeric|min:1',
            'total_generation' => 'required|numeric|min:1',
            'commission' => 'required|min:1',
        ]);

        DB::beginTransaction();
        try {
            unset($data['commission']);

            $data['status'] = isset($request->status) ? 1 : 0;
            $SponsoreCommissionPlan->update($data);

            foreach ($SponsoreCommissionPlan->details as $key => $detail) {
                $detail->delete();
            }

            if (isset($request->commission)) {
                $data_product = [];
                foreach ($request->commission as $key => $commission) {
                    $data_product[] = [
                        'generation' => $request->generation[$key],
                        'commission' => $commission,
                    ];
                }
                $SponsoreCommissionPlan->details()->createMany($data_product);
            }

            DB::commit();
            $notify[] = ['success', 'Sponsore Commision has been update successfully.'];
        } catch (\Exception $e) {
            DB::rollback();
            $notify[] = ['error', 'Error to save this data! Try Again'];
        }
        return redirect()->route('admin.sponsor_generetion_plans.index')->withNotify($notify);
    }
}
