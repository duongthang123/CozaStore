<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function get()
    {
        return Product::with('menu')->orderbyDesc('id')->paginate(10);
    }

    protected function isValidPrice($request)
    {
        if($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price'))
        {
            Session::flash('error', 'Giá khuyến mại phải nhỏ hơn giá gốc!');
            return false;
        }

        if($request->input('price_sale') != 0 && $request->input('price') == 0)
        {
            Session::flash('error', 'Hãy nhập giá gốc');
            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isvalidPrice = $this->isValidPrice($request);
        if($isvalidPrice == false) return false;

        try {
            $request->except('_token');

            Product::create($request->all());

            Session::flash('success', 'Thêm Sản Phẩm Mới Thành Công');

        }catch(\Exception $e) {
            Session::flash('error', 'Thêm Sản Phẩm Thất Bại');
            return false;
        }

        return true;
    }

    public function update($request, $product)
    {
        $isvalidPrice = $this->isValidPrice($request);
        if($isvalidPrice == false) return false;

        try {
            $product->fill($request->input());
            $product->save();

            Session::flash('success', 'Cập nhật sản phẩm thành công');
        }catch(\Exception $e) {
            Session::flash('error', 'Có lỗi khi cập nhật');
            return false;
        }

        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if($product)
        {
            $product->delete();
            return true;

        }
        return false;
    }
}