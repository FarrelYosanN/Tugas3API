<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json(['people' => $people]);
    }

    public function store(CreatePersonRequest $request)
    {
        $person = Person::create($request->validated());
        return response()->json(['message' => 'Person created successfully', 'person' => $person], 201);
    }

    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());
        return response()->json(['message' => 'Person updated successfully', 'person' => $person]);
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json(['message' => 'Person deleted successfully']);
    }
}
