<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {        
        return view('profiles.show', [
            'user'       => $user,
            'activities' => $this->getActivities($user)
        ]);
    }

    protected function getActivities(User $user)
    {
        return $user->activity()->latest()->with('subject')->get()->groupby(function($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
