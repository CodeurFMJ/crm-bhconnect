<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Message;
use App\Models\Proforma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagingController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'to' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        // Send email using Laravel Mail (simplified/plain)
        Mail::raw($validated['body'], function ($message) use ($validated) {
            $message->to($validated['to'])->subject($validated['subject']);
        });

        $log = Message::create([
            'client_id' => $validated['client_id'] ?? null,
            'user_id' => $request->user()->id,
            'channel' => 'email',
            'to' => $validated['to'],
            'subject' => $validated['subject'],
            'body' => $validated['body'],
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return response()->json($log, 201);
    }

    public function sendWhatsapp(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'to' => 'required|string',
            'body' => 'required|string',
        ]);

        // Placeholder for WhatsApp provider integration (e.g., Twilio API)
        $providerMessageId = 'mock-' . uniqid();

        $log = Message::create([
            'client_id' => $validated['client_id'] ?? null,
            'user_id' => $request->user()->id,
            'channel' => 'whatsapp',
            'to' => $validated['to'],
            'body' => $validated['body'],
            'provider_message_id' => $providerMessageId,
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return response()->json($log, 201);
    }

    public function sendProforma(Request $request, Client $client, Proforma $proforma)
    {
        $validated = $request->validate([
            'to' => 'required|email',
            'body' => 'nullable|string',
        ]);

        $subject = 'Proforma ' . $proforma->number . ' - ' . $client->first_name . ' ' . $client->last_name;
        $body = $validated['body'] ?? 'Veuillez trouver ci-joint la proforma.';

        Mail::raw($body . "\n\nTotal: " . number_format($proforma->total, 2) . ' ' . $proforma->currency, function ($message) use ($validated, $subject) {
            $message->to($validated['to'])->subject($subject);
        });

        $proforma->update(['status' => 'sent', 'sent_at' => now()]);

        $log = Message::create([
            'client_id' => $client->id,
            'user_id' => $request->user()->id,
            'mailable_type' => Proforma::class,
            'mailable_id' => $proforma->id,
            'channel' => 'email',
            'to' => $validated['to'],
            'subject' => $subject,
            'body' => $body,
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return response()->json(['proforma' => $proforma, 'message' => $log]);
    }
}



