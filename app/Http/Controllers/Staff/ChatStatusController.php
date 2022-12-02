<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ChatStatus;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\ChatStatusControllerTest
 */
class ChatStatusController extends Controller
{
    /**
     * ChatController Constructor.
     */
    public function __construct(private readonly ChatRepository $chatRepository)
    {
    }

    /**
     * Chat Management.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $chatstatuses = $this->chatRepository->statuses();

        return \view('Staff.chat.status.index', [
            'chatstatuses' => $chatstatuses,
        ]);
    }

    /**
     * Show Form For Creating A New Chat Status.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.chat.status.create');
    }

    /**
     * Store A New Chat Status.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $chatstatus = new ChatStatus();
        $chatstatus->name = $request->input('name');
        $chatstatus->color = $request->input('color');
        $chatstatus->icon = $request->input('icon');

        $v = \validator($chatstatus->toArray(), [
            'name'  => 'required',
            'color' => 'required',
            'icon'  => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.statuses.index')
                ->withErrors($v->errors());
        }

        $chatstatus->save();

        return \to_route('staff.statuses.index')
            ->withSuccess('Stanje klepeta je uspešno dodan');
    }

    /**
     * Chat Status Edit Form.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $chatstatus = ChatStatus::findOrFail($id);

        return \view('Staff.chat.status.edit', ['chatstatus' => $chatstatus]);
    }

    /**
     * Update A Chat Status.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $chatstatus = ChatStatus::findOrFail($id);
        $chatstatus->name = $request->input('name');
        $chatstatus->color = $request->input('color');
        $chatstatus->icon = $request->input('icon');

        $v = \validator($chatstatus->toArray(), [
            'name'  => 'required',
            'color' => 'required',
            'icon'  => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.statuses.index')
                ->withErrors($v->errors());
        }

        $chatstatus->save();

        return \to_route('staff.statuses.index')
            ->withSuccess('Stanje klepeta je uspešno spremenjeno');
    }

    /**
     * Delete A Chat Status.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $chatstatus = ChatStatus::findOrFail($id);
        $chatstatus->delete();

        return \to_route('staff.statuses.index')
            ->withSuccess('Stanje klepeta je uspešno izbrisano');
    }
}
