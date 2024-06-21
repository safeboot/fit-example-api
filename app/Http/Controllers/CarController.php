<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        $cars = \App\Models\Car::query();

        $request->validate(['brand_id' => 'nullable|integer']);

        if ($request->has('brand_id')) {
            $cars->where('brand_id', $request->get('brand_id'));
        }

        return response()->json([

            'success'   =>  true,
            'data'      =>  $cars->get()->map(function ($car) {

                return [

                    'id'        =>  $car->id,
                    'brand'     =>  $car->brand->name,
                    'model'     =>  $car->model,
                    'year'      =>  $car->year,
                    'price'     =>  $car->price,
                    'brand_id'  =>  $car->brand->id

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
    public function store(CarRequest $request) {

        $car = Car::create($request->validated());

        return response()->json([

            'success'   =>  true,
            'data'      =>  $car->map(function ($car) {

                return [

                    'id'        =>  $car->id,
                    'brand'     =>  $car->brand->name,
                    'model'     =>  $car->model,
                    'year'      =>  $car->year,
                    'price'     =>  $car->price,
                    'brand_id'  =>  $car->brand->id

                ];

            })

        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
