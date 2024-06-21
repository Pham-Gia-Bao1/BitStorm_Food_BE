<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FoodController extends Controller
{
    public function index()
    {
        if (request()->has('asc')) {
            if (request()->asc == 'true') {
                $foods = Food::orderBy('price')->orderBy('name')->paginate(20);
            } elseif (request()->asc == 'false') {
                $foods = Food::orderBy('price', 'DESC')->orderBy('name')->paginate(20);
            }
        } else {
            $foods = Food::paginate(20);
        }
        return response()->json($foods);
    }

    public function filter($type)
    {
        $foods = Food::where('type', '=', $type);

        if (request()->has('asc')) {
            if (request()->asc == 'true') {
                $foods = $foods->orderBy('price');
            } elseif (request()->asc == 'false') {
                $foods = $foods->orderBy('price', 'DESC');
            }
        }
        return response()->json($foods->paginate(12));
    }

    public function sortByPrice($type)
    {
        if ($type) {
            $foods = Food::orderBy('price')->paginate(12);
        } else {
            $foods = Food::orderByDesc('price')->paginate(12);
        }

        return response()->json($foods);
    }

    public function adminIndex()
    {
        $foods = Food::orderBy('id', 'desc')->paginate(10);
        return response()->json($foods);
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food);
    }

    public function getForUpdate($id)
    {
        $food = Food::findOrFail($id);
        return response()->json($food);
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return response()->json(['message' => 'Food deleted successfully']);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $food = Food::create($request->all());
        return response()->json($food, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $food = Food::findOrFail($id);
        $food->update($request->all());

        return response()->json($food);
    }
}
