<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuoStoreRequest;
use App\Http\Requests\MenuoUpdateRequest;
use App\Models\Menuo;

class MenuoController extends Controller
{
    public function index()
    {
        return response()->json(Menuo::all());
    }

    public function show(Menuo $menuo)
    {
        return response()->json($menuo);
    }

    public function store(MenuoStoreRequest $request)
    {
        $menuo = Menuo::create($request->validated());
        return response()->json([
            'message' => 'Created Successfully',
            'data' => $menuo
        ], 201);
    }

    public function update(MenuoUpdateRequest $request, Menuo $menuo)
    {
        $menuo->update($request->validated());
        return response()->json([
            'message' => 'Updated Successfully',
            'data' => $menuo
        ]);
    }

    public function destroy(Menuo $menuo)
    {
        $menuo->delete();
        return response()->json(['message' => 'Deleted Successfully']);
    }
}
