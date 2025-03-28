<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    public function index() {
        $users = User::orderByDesc('points')->get();
        $winner = Winner::latest()->first(); // Fetch the most recent winner
        return view('leaderboard', compact('users', 'winner'));
    }
    
    

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'address' => 'required|string|max:255'
        ]);

        $user = User::create($validated);

        // Generate QR Code using goqr.me API
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($user->address);
        $qrImage = Http::get($qrUrl)->body();
        
        // Store QR code locally
        $qrPath = "public/qrcodes/{$user->id}.png";
        Storage::put($qrPath, $qrImage);

        return redirect('/');
    }

    public function updatePoints($id, Request $request) {
        $user = User::findOrFail($id);
        $request->increment ? $user->increment('points') : $user->decrement('points');
        return redirect('/');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        
        // Delete QR code if it exists
        $qrPath = "public/qrcodes/{$user->id}.png";
        if (Storage::exists($qrPath)) {
            Storage::delete($qrPath);
        }
        
        $user->delete();
        return redirect('/');
    }
}
