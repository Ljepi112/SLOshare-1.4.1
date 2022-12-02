<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\TypeControllerTest
 */
class TypeController extends Controller
{
    /**
     * Display All Types.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $types = Type::all()->sortBy('position');

        return \view('Staff.type.index', ['types' => $types]);
    }

    /**
     * Show Type Create Form.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.type.create');
    }

    /**
     * Store A New Type.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $type = new Type();
        $type->name = $request->input('name');
        $type->slug = Str::slug($type->name);
        $type->position = $request->input('position');

        $v = \validator($type->toArray(), [
            'name'     => 'required',
            'slug'     => 'required',
            'position' => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.types.index')
                ->withErrors($v->errors());
        }

        $type->save();

        return \to_route('staff.types.index')
            ->withSuccess('Vnesite uspešno dodano');
    }

    /**
     * Type Edit Form.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $type = Type::findOrFail($id);

        return \view('Staff.type.edit', ['type' => $type]);
    }

    /**
     * Edit A Type.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $type = Type::findOrFail($id);
        $type->name = $request->input('name');
        $type->slug = Str::slug($type->name);
        $type->position = $request->input('position');

        $v = \validator($type->toArray(), [
            'name'     => 'required',
            'slug'     => 'required',
            'position' => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.types.index')
                ->withErrors($v->errors());
        }

        $type->save();

        return \to_route('staff.types.index')
            ->withSuccess('Vnesite uspešno spremenjeno');
    }

    /**
     * Delete A Type.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return \to_route('staff.types.index')
            ->withSuccess('Vnesite uspešno izbrisano');
    }
}
