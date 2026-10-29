<?php

namespace Behin\SimpleWorkflow\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploaderController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        // نام یکتای فایل
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // ذخیره در storage/uploads (disk public)
        $path = $file->storeAs('uploads', $fileName, 'public');

        $url = Storage::url($path);

        return response()->json([
            'url' => $url,
        ]);
    }
}
