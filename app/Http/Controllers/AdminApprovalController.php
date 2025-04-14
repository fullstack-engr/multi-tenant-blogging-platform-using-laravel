<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserApproval;
use Illuminate\Http\Request;

class AdminApprovalController extends Controller
{
    public function __invoke(User $user)
    {
        if ($user->status !== 'pending' || $user->is_admin) {
            abort(403, 'Invalid approval request');
        }

        $user->update(['status' => 'approved']);

        UserApproval::create([
            'user_id' => $user->id,
            'approved_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'User approved successfully.');
    }
}
