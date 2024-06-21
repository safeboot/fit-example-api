<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\ForceJsonResponse::class)->group(function () {

    Route::get('/ping', function () {

        return response()->json([

            'success'   =>  true,
            'data'      =>  'pong'

        ]);

    });

    Route::get('/cars', function (Request $request) {

        $cars = \App\Models\Car::query();

        if ($request->has('brand')) {
            $cars->whereHas('brand', function ($query) use ($request) {
                $query->where('name', $request->get('brand'));
            });
        }

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

    });

    Route::get('/brands', function () {

        return response()->json([

            'success'   =>  true,
            'data'      =>  \App\Models\Brand::all()->map(function ($brand) {

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

    });

    Route::post('/brands', function (Request $request) {

        try {

            $validated = $request->validate([

                'name'      =>  'required',
                'country'   =>  'required'

            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([

                'success'   =>  false,
                'data'      =>  [
                    'message'   =>  'Validation error.',
                    'errors'    =>  collect($e->errors())->mapWithKeys(fn ($errors, $key) => [$key => $errors[0]])
                ]

            ]);

        }

        try {

            \App\Models\Brand::create([

                'name'      =>  $validated['name'],
                'country'   =>  $validated['country']

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success'   =>  false,
                'data'      =>  [
                    'message'   =>  'Could not create brand.',
                    'error'     =>  $e->getMessage()
                ]

            ]);

        }

        return response()->json([

            'success'   =>  true,
            'data'      =>  [
                'id'        =>  \App\Models\Brand::latest()->first()->id,
                'message'   =>  'Brand created successfully.'
            ]

        ]);

    });

    Route::post('/cars', function (Request $request) {

        try {

            $validated = $request->validate([

                'model'     =>  'required',
                'year'      =>  'required|integer',
                'price'     =>  'required|numeric',
                'brand_id'  =>  'required|exists:brands,id'

            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([

                'success'   =>  false,
                'data'      =>  [
                    'message'   =>  'Validation error.',
                    'errors'    =>  collect($e->errors())->mapWithKeys(fn ($errors, $key) => [$key => $errors[0]])
                ]

            ]);

        }

        try {

            \App\Models\Car::create([

                'model'     =>  $validated['model'],
                'year'      =>  $validated['year'],
                'price'     =>  $validated['price'],
                'brand_id'  =>  $validated['brand_id']

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success'   =>  false,
                'data'      =>  [
                    'message'   =>  'Could not create car.',
                    'error'     =>  $e->getMessage()
                ]

            ]);

        }

        return response()->json([

            'success'   =>  true,
            'data'      =>  [
                'id'        =>  \App\Models\Brand::latest()->first()->id,
                'message'   =>  'Brand created successfully.'
            ]

        ]);

    });


});
