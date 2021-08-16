<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index(Request $request) {
        $itemgambar = Image::orderBy('created_at', 'desc')->paginate(20);
        $data = array('title' => 'Data Image',
                    'itemgambar' => $itemgambar);
        return view('image.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $fileupload = $request->file('image');
        $folder = 'assets/images';
        $itemgambar = $this->upload($fileupload, $folder);
        return back()->with('success', 'Image berhasil diupload');
    }

    public function destroy(Request $request, $id) {
        $itemgambar = Image::orderBy('created_at', 'desc')
                            ->first();
        if ($itemgambar) {
            \Storage::delete($itemgambar->url);
            $itemgambar->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }
    
    public function upload($fileupload, $folder) {
        $path = $fileupload->store('public');
        $inputangambar['url'] = $path;
        return Image::create($inputangambar);
    }
}