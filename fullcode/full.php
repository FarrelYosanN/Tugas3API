<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Http\FormRequest;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json(['people' => $people]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $person = Person::create($request->all());
        return response()->json(['message' => 'Person created successfully', 'person' => $person], 201);
    }

    public function update(Request $request, Person $person)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $person->update($request->all());
        return response()->json(['message' => 'Person updated successfully', 'person' => $person]);
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return response()->json(['message' => 'Person deleted successfully']);
    }
}

class CreatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ];
    }
}

class UpdatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'age' => 'nullable|integer',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ];
    }
}

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Person::create([
                'name' => 'Person ' . $i,
                'age' => rand(20, 50),
                'email' => 'person' . $i . '@example.com',
                'address' => 'Address ' . $i . ', City',
            ]);
        }
    }
}

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
