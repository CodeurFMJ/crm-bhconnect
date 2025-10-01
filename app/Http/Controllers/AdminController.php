<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'employee')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,employee',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,employee',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if ($validated['password']) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function activityLogs(Request $request)
    {
        $query = LoginLog::with('user')->orderBy('logged_at', 'desc');
        
        // Filtres
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('logged_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('logged_at', '<=', $request->date_to);
        }
        
        $logs = $query->paginate(20);
        $users = User::where('role', 'employee')->get();
        
        return view('admin.activity-logs', compact('logs', 'users'));
    }

    public function userActivity($userId)
    {
        $user = User::findOrFail($userId);
        
        $logs = LoginLog::where('user_id', $userId)
            ->orderBy('logged_at', 'desc')
            ->paginate(20);
        
        // Statistiques
        $stats = [
            'total_logins' => $logs->where('action', 'login')->count(),
            'total_logouts' => $logs->where('action', 'logout')->count(),
            'last_login' => $user->lastLogin(),
            'last_logout' => $user->lastLogout(),
            'is_online' => $user->isCurrentlyOnline(),
            'login_today' => LoginLog::where('user_id', $userId)
                ->where('action', 'login')
                ->today()
                ->count(),
            'login_this_week' => LoginLog::where('user_id', $userId)
                ->where('action', 'login')
                ->thisWeek()
                ->count(),
            'login_this_month' => LoginLog::where('user_id', $userId)
                ->where('action', 'login')
                ->thisMonth()
                ->count(),
            'total_online_time_today' => $user->getFormattedOnlineTimeToday(),
            'current_session_duration' => $user->getCurrentSessionDuration(),
        ];
        
        return view('admin.user-activity', compact('user', 'logs', 'stats'));
    }

    public function onlineUsers()
    {
        $users = User::where('role', 'employee')->get()->filter(function ($user) {
            return $user->isCurrentlyOnline();
        });
        
        return view('admin.online-users', compact('users'));
    }
}
