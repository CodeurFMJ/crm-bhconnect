<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\PerformanceObjectiveController;
use App\Http\Controllers\Admin\DataImportExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Clients CRUD
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::patch('/clients/{client}/assign', [ClientController::class, 'update'])->name('clients.assign');
    Route::patch('/clients/{client}/status', [ClientController::class, 'update'])->name('clients.status');

    // Appointments (RDV)
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/clients/{client}/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::put('/clients/{client}/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/clients/{client}/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/api/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/api/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');

    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my-tasks');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
    Route::post('/tasks/assign', [TaskController::class, 'assign'])->name('tasks.assign');

    // Notes
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/clients/{client}/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/clients/{client}/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/clients/{client}/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    // Documents
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

    // Proformas
    Route::get('/proformas', [ProformaController::class, 'index'])->name('proformas.index');
    Route::get('/proformas/builder', [ProformaController::class, 'builder'])->name('proformas.builder');
    Route::get('/clients/{client}/proformas/create', [ProformaController::class, 'create'])->name('proformas.create');
    Route::post('/clients/{client}/proformas', [ProformaController::class, 'store'])->name('proformas.store');
    Route::put('/clients/{client}/proformas/{proforma}', [ProformaController::class, 'update'])->name('proformas.update');

    // Messaging
    Route::get('/messages', [MessagingController::class, 'index'])->name('messages.index');
    Route::post('/messages/email', [MessagingController::class, 'sendEmail'])->name('messages.email');
    Route::post('/messages/whatsapp', [MessagingController::class, 'sendWhatsapp'])->name('messages.whatsapp');
    Route::post('/clients/{client}/proformas/{proforma}/send', [MessagingController::class, 'sendProforma'])->name('proformas.send');

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
        
        // Appointment approval
        Route::get('/admin/appointments/pending', [AppointmentController::class, 'pending'])->name('admin.appointments.pending');
        Route::post('/appointments/{appointment}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
        Route::post('/appointments/{appointment}/reject', [AppointmentController::class, 'reject'])->name('appointments.reject');
        Route::post('/appointments/{appointment}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');
        
        // Reporting
        Route::get('/reports/financial', [ReportingController::class, 'financial'])->name('reports.financial');
        
        // Activity Logs
        Route::get('/admin/activity-logs', [AdminController::class, 'activityLogs'])->name('admin.activity-logs');
        Route::get('/admin/users/{user}/activity', [AdminController::class, 'userActivity'])->name('admin.user-activity');
        Route::get('/admin/online-users', [AdminController::class, 'onlineUsers'])->name('admin.online-users');
        
        // Performance Objectives
        Route::resource('admin/performance-objectives', PerformanceObjectiveController::class);
        Route::post('/admin/performance-objectives/{performanceObjective}/toggle', [PerformanceObjectiveController::class, 'toggle'])->name('admin.performance-objectives.toggle');
        
        // Data Import/Export
        Route::get('/admin/data-import-export', [DataImportExportController::class, 'index'])->name('admin.data-import-export.index');
        Route::get('/admin/data-import-export/clients/export', [DataImportExportController::class, 'exportClients'])->name('admin.data-import-export.export-clients');
        Route::get('/admin/data-import-export/appointments/export', [DataImportExportController::class, 'exportAppointments'])->name('admin.data-import-export.export-appointments');
        Route::get('/admin/data-import-export/proformas/export', [DataImportExportController::class, 'exportProformas'])->name('admin.data-import-export.export-proformas');
        Route::get('/admin/data-import-export/tasks/export', [DataImportExportController::class, 'exportTasks'])->name('admin.data-import-export.export-tasks');
        Route::post('/admin/data-import-export/clients/import', [DataImportExportController::class, 'importClients'])->name('admin.data-import-export.import-clients');
        Route::get('/admin/data-import-export/stats', [DataImportExportController::class, 'getExportStats'])->name('admin.data-import-export.stats');
    });
});

// Page principale - redirige vers le login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});
