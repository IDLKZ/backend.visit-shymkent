<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Toastr;
use function Symfony\Component\Translation\t;

class AdminController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName);
            $msg = 'Изображение успешно добавлено';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function backup(){
        $path = storage_path('backup');
        $files = File::files($path);
        return view("admin.backup.index",compact("files"));
    }

    public function downloadBackup($filename){
        $path = "backup/".$filename;
        if(Storage::disk("storage")->exists($path)){
            return Storage::disk("storage")->download($path);
        };
        return redirect()->back();
    }
    public function deleteBackup($filename){
        $path = "backup/".$filename;
        if(Storage::disk("storage")->exists($path)){
             Storage::disk("storage")->delete($path);
        }
        return redirect()->back();
    }

    public function createBackup(){
        try {
            Artisan::call("backup:run --only-db");
            toastSuccess(__("messages.created"));
        }
        catch (\Exception $e){
            toastSuccess(__("messages.failed"));
        }
        return redirect()->back();
    }
}
