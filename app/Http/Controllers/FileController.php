<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request, $user_id, $group_id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg,txt|max:1048',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $mime_type = $file->getClientMimeType();
        // $file->move(public_path('uploads'), $filename);
        $path = $file->storeAs('uploads', $filename, 'public');
        $size = $file->getSize();
        // $file_size_kb = $file_size / 1024; // Conversion en kiloOctets
        $file_size_mb = $size / (1024 * 1024); // Conversion en mégaOctets
        $file_size = round($file_size_mb, 2);// Taille en KB, arrondie à 2 décimales; // Conversion en mégaoctets
        $url = Storage::url($path);

        $file = new File();

        $file->user_id = $user_id;
        $file->group_id = $group_id;

        $file->file_path = $path;
        $file->file_name = $filename;
        $file->mime_type = $mime_type;
        $file->file_size = $file_size;
        // Mail::to($request->email)->send(new accountMail($request->name));
        $file->save();

        return response()->json([
            'message' => 'File uploaded successfully', 
            'filename' => $filename,
            'url' => $url,
            'file' => $file
        ]);
    }
}
