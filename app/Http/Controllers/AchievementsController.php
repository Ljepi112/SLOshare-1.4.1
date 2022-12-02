<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\AchievementsControllerTest
 */
class AchievementsController extends Controller
{
    /**
     * Display All Achievements.
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = $request->user();

        $achievements = $user->unlockedAchievements();
        $pending = $user->inProgressAchievements();

        return \view('achievement.index', [
            'route'        => 'achievement',
            'user'         => $user,
            'achievements' => $achievements,
            'pending'      => $pending,
        ]);
    }

    /**
     * Show A Users Achievements.
     */
    public function show(string $username): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = User::where('username', '=', $username)->firstOrFail();

        $achievements = $user->unlockedAchievements();

        return \view('achievement.show', [
            'route'        => 'achievement',
            'user'         => $user,
            'achievements' => $achievements,
        ]);
    }
}
