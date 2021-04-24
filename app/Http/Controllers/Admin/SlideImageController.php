<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GambarSlide;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


use App\Authorizable;
use App\Http\Requests\SlideImageRequest;

class SlideImageController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->data['statuses'] = GambarSlide::STATUSES;
    }


    public function index()
    {
        $this->data['slides'] = GambarSlide::orderBy('id', 'ASC')->paginate(10);

        return view('admin.slides.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['slide'] = null;
        return view('admin.slides.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideImageRequest $request)
    {
        $params = $request->except('_token');

        $image = $request->file('image');
        $name = 'image-slide' . '_' . time();
        $fileName = $name . '.' . $image->getClientOriginalExtension();

        $folder = GambarSlide::UPLOAD_DIR . '/images';

        $resizedImage = $this->_resizedImage($image, $fileName, $folder);
        $params['gambar_besar'] = $resizedImage['gambar_besar'];
        $params['gambar_kecil'] = $resizedImage['gambar_kecil'];
        $params['user_id'] = \Auth::user()->id;

        unset($params['image']);

        GambarSlide::create($params);

        return redirect('admin/slides')->with('success-add', 'success');
    }


    private function _resizedImage($image, $fileName, $folder)
    {
        $resizedImage = [];

        $smallImageFilePath = $folder . '/small/' . $fileName;
        $size = explode('x', GambarSlide::SMALL);
        list($width, $height) = $size;

        $smallImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
            $resizedImage['gambar_kecil'] = $smallImageFilePath;
        }

        $extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
        $size = explode('x', GambarSlide::X_LARGE);
        list($width, $height) = $size;

        $extraLargeImageFile = \Image::make($image)->fit($width, $height)->stream();
        if (\Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
            $resizedImage['gambar_besar'] = $extraLargeImageFilePath;
        }

        return $resizedImage;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = GambarSlide::findOrFail($id);

        $this->data['slide'] = $slide;

        return view('admin.slides.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideImageRequest $request, $id)
    {
        $params = $request->except('_token');

        $slide = GambarSlide::findOrFail($id);
        $slide->update($params);

        return redirect('admin/slides')->with('success-edit', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = GambarSlide::findOrFail($id);
        Storage::disk('public')->delete($slide->gambar_besar);
        Storage::disk('public')->delete($slide->gambar_kecil);
        $slide->delete();

        return redirect('admin/slides')->with('success-delete', 'success');
    }
}
