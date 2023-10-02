<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request)
    {
        try {

            Slider::create($request->input());
            Session::flash('success', 'Thêm Silder mới thành công');
        
        }catch(\Exception $e) {
            Session::flash('error', 'Thêm Silder mới lỗi!');
            return false;
        }

        return true;
    }

    public function get()
    {
        return Slider::orderbyDesc('id')->paginate(15);
    }

    public function show()
    {
        return Slider::where('active', 1)->orderbyDesc('sort_by')->get();

    }

    public function update($request, $slider)
    {
        try {

            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật silder thành công');

        }catch(\Exception $e) {
            Session::flash('error', 'Cập nhật silder lỗi');
            return false;
        }

        return true;
        
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider)
        {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }
}