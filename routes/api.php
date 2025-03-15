<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload-file', function (Request $request) {
    $request->validate([
        'user_id' => 'required|integer',
        'description' => 'required|string',
        'file' => 'required|file|max:2048' // 2MB file limit
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/' . $request->user_id, $filename, 'public'); // Save in user-specific folder

        return response()->json([
            'message' => 'File uploaded successfully',
            'user_id' => $request->user_id,
            'description' => $request->description,
            'file_path' => $path
        ], Response::HTTP_OK);
    }

    return response()->json(['message' => 'No file uploaded'], Response::HTTP_BAD_REQUEST);
});
