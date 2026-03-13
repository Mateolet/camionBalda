<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    // POST /api/contacto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'empresa' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:50'],
            'mail' => ['required', 'email', 'max:255'],
            'contacto' => ['required', 'string', 'max:5000'],
        ]);

        $toAddress = config('mail.contact_to.address', config('mail.from.address'));
        $toName = config('mail.contact_to.name', config('mail.from.name'));

        Mail::to([$toAddress => $toName])
            ->send(new ContactoMail($validated));

        return response()->json(['ok' => true], 202);
    }
}
