<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd(
        //     Product::get(),
        //     Product::paginate(20),
        // );
        $query = Product::select('id','category_id', 'name', 'maker','price');

        if ($request->category_id) {
            $query->where('category_id', '=', $request->category_id);
        }

        if ($request->keyword) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('maker', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->min_price && !$request->max_price) {
            $query->where('price', '>=', $request->min_price);
        } else if (!$request->min_price && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        } else if ($request->min_price && $request->max_price) {
            $query->where('price', '>=', $request->min_price)
                ->where('price', '<=', $request->max_price);
        }

        if ($request->sort == '') {
            $query->orderby('created_at', 'desc');
        } else if ($request->sort == 'price_asc') {
            $query->orderby('price', 'asc');
        } else if ($request->sort == 'price_desc') {
            $query->orderby('price', 'desc');
        }

        $products = $query->get();

        $products = $query->paginate(20);

        $data = [
            "products" => $products,
        ];
        return view("products.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $data = ['product' => $product];
        return view('products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'maker' => 'required|max:50',
            'name' => 'required|max:50',
            'price' => 'required|max:50',
        ]);
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->maker = $request->maker;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('top');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = ['product' => $product];
        return view('products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'maker' => 'required|max:50',
            'name' => 'required|max:50',
            'price' => 'required|max:50',
        ]);
        $product->category_id = $request->category_id;
        $product->maker = $request->maker;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return redirect(route('top', $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('top'));
    }

    public function search(Request $request){

        // $query = Product::select('category_id','name', 'price');

        // if($request->category_id){
        //     $query->where('category_id', '=', $request->category_id);
        // }

        // if($request->keyword){
        //     $query->where('name','LIKE','%'.$request->keyword. '%');
        // }

        // if($request->min_price && !$request->max_price){
        //     $query->where('price', '>=', $request->min_price);
        // }
        // else if (!$request->min_price && $request->max_price) {
        //     $query->where('price', '<=', $request->max_price);
        // }
        // else if($request->min_price && $request->max_price) {
        //     $query->where('price', '>=', $request->min_price)
        //         ->where('price', '<=', $request->max_price);
        // }

        // if($request->sort == ''){
        //     $query->orderby('created_at', 'desc');
        // }
        // else if($request->sort == 'price_asc'){
        //     $query->orderby('price','asc');
        // }
        // else if($request->sort == 'price_desc'){
        //     $query->orderby('price','desc');
        // }

        // $product = $query->get();

    }
}
