<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Factor;

class FactorController extends Controller
{
    public function getReportExcel()
    {
        $factores = Factor::get();
        // dd($factores);
        \Excel::create('factores', function ($excel) use ($factores) {
            $excel->sheet('factor', function ($sheet) use ($factores) {
                $sheet->fromArray($factores);
            });
            $excel->sheet('address', function ($sheet) use ($factores) {
                $addresses = [];
                foreach($factores as $factor)
                {
                    $addresses[] = $factor->address()->first();
                }
                $addresses = collect($addresses);
                $sheet->fromArray($addresses);
            });
            
            $excel->sheet('product', function ($sheet) use ($factores) {
                $products = [];
                foreach($factores as $factor)
                {
                    foreach( $factor->products()->get() as $product)
                    {
                        $products[] = [
                            'factor_id' => $factor->id,
                            'title' => $product->title,
                            'product_id' => $product->id,
                            'count' => $product->pivot->count,
                            'price' => $product->pivot->price,
                            'discount_price' => $product->pivot->discount_price,
                        ];
                    }
                }
                $products = collect($products);
                $sheet->fromArray($products);
            });
            $excel->sheet('payment', function ($sheet) use ($factores) {
                $payments = [];
                foreach($factores as $factor)
                {
                    foreach( $factor->payments()->get() as $payment)
                    {
                        $payments[] = $payment;
                    }
                }
                $payments = collect($payments);
                $sheet->fromArray($payments);
            });
        })->export('xls');        
    }

    public function index(Request $request)
    {
        $factors = Factor::where('user_id', \Auth::id())
            ->orderBy('updated_at', 'desc')
            ->Paginate(self::PAGE_SIZE);
        $query = $request->fullUrlWithQuery([]);
        
        return view('admin.factor.index', compact('factors','query'));
    }

    public function show($id)
    {
        $factor = Factor::where('user_id', \Auth::id())->where('id',$id)->first();

        if($factor){
            $address = $factor->address;

            return view('admin.factor.show', compact('factor','address') );
        }else{
            return redirect('/admin/factor');
        }
    }
}
