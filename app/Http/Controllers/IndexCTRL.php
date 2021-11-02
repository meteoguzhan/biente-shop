<?php

namespace App\Http\Controllers;

use App\Libraries\BienteShopApi\BienteShopApi;
use App\Models\Product;
use App\Models\User;

class IndexCTRL extends Controller
{
    public function bienteApiGet()
    {
        $bienteShopApi = new BienteShopApi();
        $result = $bienteShopApi->getProducts();
        if (!$result) {
            abort(500, 'Api Error.');
        }

        foreach ($result as $items) {
            foreach ($items as $productId => $product) {
                $is_user = User::find($product->userId);
                if (!$is_user) {
                    $new_user = new User();
                    $new_user->id = $product->userId;
                    $new_user->save();
                }

                $is_product = Product::find($productId);
                if (!$is_product) {
                    $new_product = new Product();
                    $new_product->id = $productId;
                    $new_product->user_id = $product->userId;
                    $new_product->status = $product->status;
                    $new_product->title = $product->productMainInfos[0]->title;
                    $new_product->description = $product->productMainInfos[0]->description;
                    $new_product->stock_count = $product->stockCount;
                    $new_product->save();
                }
            }
        }

        return response('İşlem Başarılı', 200);
    }

    public function bienteApiPost()
    {
        $products = Product::where('status', 1)->where('stock_count', '>', 0)->where('user_id', 129423874)->get();
        $items = [];
        foreach ($products as $product) {
            $item = new \stdClass;
            $item->externalId = $product->id;
            $item->productTitle = $product->title;
            $item->description = $product->description;
            $items[] = $item;
        }

        $bienteShopApi = new BienteShopApi();
        $result = $bienteShopApi->postProducts(['items' => $items]);
        if (!$result) {
            abort(500, 'Api Error.');
        }

        return response('İşlem Başarılı', 200);
    }

    public function productsOfUsers(User $users)
    {
        return $users->with('products')->get();
    }
}
