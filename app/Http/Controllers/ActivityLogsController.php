<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLogs;
use App\Models\Staff;
use App\Models\User;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $activity_logs = ActivityLogs::latest()->get();
        
        return view('admin.user.viewActivityLog', compact('activity_logs'));
    }

    public static function log($id, $description)
    {
        $userID = User::findOrFail($id);

        ActivityLogs::create([
            'userID' => $id,
            'description' => $description,
        ]);
    }
}
