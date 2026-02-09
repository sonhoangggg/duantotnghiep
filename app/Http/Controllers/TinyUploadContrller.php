<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyUploadContrller extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $request->file('file')->store('tinymce', 'public');

        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }
}
