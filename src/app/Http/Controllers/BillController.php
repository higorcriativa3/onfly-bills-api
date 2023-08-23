<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Notifications\NewBill;
use App\Http\Resources\BillResource;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('list', Bill::class)) {
            abort(403);
        }

        return BillResource::collection($request->user()->bills);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Bill::class)) {
            abort(403);
        }

        try {
            //Validated
            $validated = Validator::make($request->all(), 
            [
                'name' => 'required|max:50',
                'bill_date' => 'required|date|before:tomorrow',
                'description' => 'required|max:191',
                'amount' => 'required|numeric|gt:0',
            ]);

            if($validated->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validated->errors()
                ], 422);
            }
    
            $bill = Bill::create([
                'user_id' => $request->user()->id,
                'name' => $request->name,
                'bill_date' => $request->bill_date,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);
    
            $request->user()->notify(new NewBill());
    
            return new BillResource($bill);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bill $bill)
    {
        if ($request->user()->cannot('view', $bill)) {
            abort(403);
        }

        return new BillResource($bill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        if ($request->user()->cannot('update', $bill)) {
            abort(403);
        }

        $bill->update($request->all());

        return response()->json([
            'message' => 'Updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Bill $bill)
    {
        if ($request->user()->cannot('delete', $bill)) {
            abort(403);
        }

        $bill->delete();

        return response()->json([
            'message' => 'Deleted',
        ], 200);
    }
}
