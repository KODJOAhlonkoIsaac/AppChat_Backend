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
        try {
            $request->validate([
                'file' => 'required|mimes:pdf,doc,docx,png,jpg,jpeg,txt|max:1048',
            ]);
    
            // Code de traitement du fichier
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $mime_type = $file->getClientMimeType();
            $path = $file->storeAs('uploads', $filename, 'public');
            $size = $file->getSize();
            $file_size_mb = $size / (1024 * 1024);
            $file_size = round($file_size_mb, 2);
            $url = Storage::url($path);
    
            $file = new File();
            $file->user_id = $user_id;
            $file->group_id = $group_id;
            $file->file_path = $path;
            $file->file_name = $filename;
            $file->mime_type = $mime_type;
            $file->file_size = $file_size;
            $file->save();
    
            return response()->json([
                'message' => 'File uploaded successfully',
                'filename' => $filename,
                'url' => $url,
                'file' => $file
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation errors occurred.',
                'errors' => $e->errors()
            ], 422);  // Utiliser le code HTTP 422 pour les erreurs de validation
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred.',
                'error' => $e->getMessage()
            ], 500);  // Utiliser le code HTTP 500 pour les erreurs internes du serveur
        }
    }
    
}
