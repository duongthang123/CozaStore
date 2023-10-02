<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $silder;

    public function __construct(SliderService $silder)
    {
        $this->silder = $silder;
    }

    public function create()
    {
        return view('admin.slider.add',[
            'title' => 'Thêm Silder mới',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'thumb' => 'required',
        ]);

        $this->silder->insert($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.slider.list', [
            'title' => 'Danh sách Silder mới nhất',
            'sliders' => $this->silder->get(),
        ]);
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'thumb' => 'required',
        ]);

        $result = $this->silder->update($request, $slider);
        if($result)
        {
            return redirect('/admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->silder->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Xóa silder thành công',
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
