@extends("layouts.app")
@section("content")
@include('commons.errors')
<div class="row">
    <div class="col-md-4 col-lg-3  mb-4">
        <form class="card mb-4" action="{{ route('update',$product) }}" method="post">
            @method('patch')
            @csrf
            <div class="card-header">商品追加</div>
            <dl class="search-box card-body mb-0">
                <dt>カテゴリ</dt>
                <dd>
                    <select name="category_id" class="form-select">
                        <option value=""></option>
                        @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"{{ old('category_id',$product->category_id) == $category->id ? ' selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </dd>
                <dt>メーカー</dt>
                <dd>
                    <input type="text" name="maker" class="form-control" placeholder="メーカー" value="{{old('maker',$product->maker)}}">
                </dd>
                <dt>商品名</dt>
                <dd>
                    <input type="text" name="name" class="form-control" placeholder="商品名" value="{{old('name',$product->name)}}">
                </dd>
                <dt>価格</dt>
                <dd>
                     <input type="text" name="price" class="form-control" placeholder="円" value="{{old('price',$product->price)}}">

                </dd>
            </dl>
            <div class="card-footer">
                <button type="submit" class="btn w-100 btn-success">変更</button>
            </div>
        </form>
        <form onsubmit="return confirm('ログアウトしますか？')" action="{{-- {{ route('logout') }} --}}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-dark">ログアウト</button>
        </form>
    </div>

</div>
@endsection
