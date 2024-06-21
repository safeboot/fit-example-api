<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return response()->json([

            'success'   =>  true,
            'data'      =>  Brand::all()->map(function ($brand) {

                return [

                    'id'        =>  $brand->id,
                    'name'      =>  $brand->name,
                    'cars'      =>  $brand->cars->map(function ($car) {

                        return [

                            'id'        =>  $car->id,
                            'model'     =>  $car->model,
                            'year'      =>  $car->year,
                            'price'     =>  $car->price

                        ];

                    })

                ];

            })

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request) {

        $brand = Brand::create($request->validated());

        return response()->json([

            'success'   =>  true,
            'data'      =>  $brand->map(function ($brand) {

                return [

                    'id'        =>  $brand->id,
                    'name'      =>  $brand->name,
                    'country'   =>  $brand->country

                ];

            })

        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
