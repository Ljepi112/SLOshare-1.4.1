<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\ChatBotControllerTest
 */
class ChatBotController extends Controller
{
    /**
     * Display a listing of the Bots resource.
     */
    public function index($hash = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $bots = Bot::oldest('position')->get();

        return \view('Staff.chat.bot.index', [
            'bots' => $bots,
        ]);
    }

    /**
     * Show the form for editing the specified Bot resource.
     */
    public function edit(Request $request, int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $user = $request->user();
        $bot = Bot::findOrFail($id);

        return \view('Staff.chat.bot.edit', [
            'user'           => $user,
            'bot'            => $bot,
        ]);
    }

    /**
     * Update the specified Bot resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = $request->user();
        $bot = Bot::findOrFail($id);

        if ($request->has('command') && $request->input('command') == $bot->command) {
            $v = \validator($request->all(), [
                'name'     => 'required|min:3|max:255',
                'command'  => 'required|alpha_dash|min:3|max:255',
                'position' => 'required',
                'color'    => 'required',
                'icon'     => 'required',
                'emoji'    => 'required',
                'help'     => 'sometimes|max:9999',
                'info'     => 'sometimes|max:9999',
                'about'    => 'sometimes|max:9999',
            ]);
        } else {
            $v = \validator($request->all(), [
                'name'     => 'required|min:3|max:255',
                'command'  => 'required|alpha_dash|min:3|max:255|unique:bots',
                'position' => 'required',
                'color'    => 'required',
                'icon'     => 'required',
                'emoji'    => 'required',
                'help'     => 'sometimes|max:9999',
                'info'     => 'sometimes|max:9999',
                'about'    => 'sometimes|max:9999',
            ]);
        }

        $error = null;
        $success = null;
        $redirect = null;

        if ($v->passes()) {
            $bot->name = $request->input('name');
            $bot->slug = Str::slug($request->input('name'));
            $bot->position = $request->input('position');
            $bot->color = $request->input('color');
            $bot->icon = $request->input('icon');
            $bot->emoji = $request->input('emoji');
            $bot->about = $request->input('about');
            $bot->info = $request->input('info');
            $bot->help = $request->input('help');
            $bot->command = $request->input('command');
            $bot->save();
            $success = 'Bot je bil posodobljen';
        }

        if ($success === null) {
            $error = 'Zahteve ni mogoče obdelati';
            if ($v->errors()) {
                $error = $v->errors();
            }

            return \to_route('staff.bots.edit', ['id' => $id])
                ->withErrors($error);
        }

        return \to_route('staff.bots.edit', ['id' => $id])
            ->withSuccess($success);
    }

    /**
     * Remove the specified Bot resource from storage.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $bot = Bot::where('is_protected', '=', 0)->findOrFail($id);
        $bot->delete();

        return \to_route('staff.bots.index')
            ->withSuccess('Začela se je vojna med ljudmi proti strojem! Ljudje: 1 in Boti: 0');
    }

    /**
     * Disable the specified Bot resource in storage.
     */
    public function disable(int $id): \Illuminate\Http\RedirectResponse
    {
        $bot = Bot::findOrFail($id);
        $bot->active = 0;
        $bot->save();

        return \to_route('staff.bots.index')
            ->withSuccess('Bot je onemogočen');
    }

    /**
     * Enable the specified Bot resource in storage.
     */
    public function enable(int $id): \Illuminate\Http\RedirectResponse
    {
        $bot = Bot::findOrFail($id);
        $bot->active = 1;
        $bot->save();

        return \to_route('staff.bots.index')
            ->withSuccess('Bot je omogočen');
    }
}
