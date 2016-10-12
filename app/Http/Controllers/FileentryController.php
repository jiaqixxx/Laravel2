<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Fileentry;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Repositories\FileRepository;

class FileentryController extends Controller
{
    protected $files;
    public function __construct(FileRepository $files){
        $this->middleware('auth');
        $this->files = $files;
    }
    
    /*public function index(Request $request){
        $files = Fileentry::all();
        return view('file.index', compact('files'));
    }*/

    public function index(Request $request){
        return view('file.index', [
            'files' => $this->files->GetFile($request->user()),
        ]);
    }

    public function store(Request $request){
        if ($request->hasFile('file_field')) {
            $files = $request->file('file_field');
            foreach ($files as $file){
                $extension = $file->getClientOriginalExtension();
                Storage::disk('uploads')->put($file->getFilename() . '.' . $extension, File::get($file));
                $entry = new Fileentry();
                $entry->mime = $file->getClientMimeType();
                $entry->original_filename = $file->getClientOriginalName();
                $entry->filename = $file->getFilename() . '.' . $extension;
                $entry->user_id = $request->user()->id;
                $entry->save();
            }
            return redirect('list_file');
        }else{
            return redirect('list_file');
        }
    }

    public function dropzone_store(Request $request){
        if ($request->hasFile('file_field1')){
            $file = $request->file('file_field1');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('uploads')->put($file->getFilename() . '.' . $extension, File::get($file));
            $entry = new Fileentry();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename() . '.' . $extension;
            $entry->user_id = $request->user()->id;
            $entry->save();
            return redirect('list_file');
        }else{
            return redirect('list_file');
        }
    }

    public function delete($id){
        $filename = Fileentry::findOrFail($id)->filename;
        Fileentry::findOrFail($id)->delete();
        Storage::disk('uploads')->delete($filename);
        return redirect('list_file');
    }

    public function download($id){
        $file = Fileentry::findOrFail($id);
        $filename = $file->filename;
        $filepath = public_path('uploads')."/".$filename;
        return response()->download($filepath);
    }
}
