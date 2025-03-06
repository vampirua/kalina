<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.form');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:255',
        ]);

        // Створення нового запису в базі даних
        Contact::create($validated);

        // Перенаправлення з повідомленням про успіх
        return redirect()->route('contact.form')->with('success', 'Message sent!');
    }
}
