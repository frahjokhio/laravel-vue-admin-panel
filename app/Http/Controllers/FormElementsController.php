<?php

namespace App\Http\Controllers;

use App\Http\Model\FormElements;
use Illuminate\Http\Request;
use App\Http\Requests\FormElementRequest;
use Image,Storage;

class FormElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allelements = FormElements::orderBy('id', 'desc')->paginate(10);
        return request()->json( 200, $allelements );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormElementRequest $request)
    {

        $input = $request->only('textfield', 'selectfiled', 'textarea','filefield');
        
        if( isset($input['filefield']) ){
            if ( $this->crop( $input['filefield'] ) ) {
                $input['filefield'] = $input['filefield']->hashName();
            }
        }

        $record = FormElements::create( $input );
        if($record){
            return $this->index();
        }
    }

    private function crop($file, $extensions = ['jpeg', 'png', 'gif', 'bmp', 'svg'] ) {

        list($name, $ext) = explode('.', $file->hashName());
        
        if (in_array($file->guessExtension(), $extensions)) {
            
            $image = Image::make($file);
            $width = $image->width();
            $height = $image->height();

            $store = Storage::put(config('app.files.users.folder_name').'/'.$name.'@3x.'.$ext, $image->stream());
            $store = Storage::put(config('app.files.users.folder_name').'/'.$name.'@2x.'.$ext, $image->resize($width / 1.5, $height / 1.5)->stream());
            $store = Storage::put(config('app.files.users.folder_name').'/'.$name.'.'.$ext, $image->resize($width / 3, $height / 3)->stream());

            /*Storage::disk('public')->put(config('app.files.users.folder_name').'/'.$name.'@3x.'.$ext, $image->stream());
            Storage::disk('public')->put(config('app.files.users.folder_name').'/'.$name.'@2x.'.$ext, $image->resize($width / 1.5, $height / 1.5)->stream());
            Storage::disk('public')->put(config('app.files.users.folder_name').'/'.$name.'.'.$ext, $image->resize($width / 3, $height / 3)->stream());*/
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormElements  $formElements
     * @return \Illuminate\Http\Response
     */
    public function show(FormElements $formElements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormElements  $formElements
     * @return \Illuminate\Http\Response
     */
    public function edit(FormElements $formElements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormElements  $formElements
     * @return \Illuminate\Http\Response
     */
    public function update(FormElementRequest $request, FormElements $formElements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormElements  $formElements
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormElements $formElements)
    {
        //
    }
}
