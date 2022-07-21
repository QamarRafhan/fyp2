<div class="col-4 border-tr p-0">
    <h4 >{{$product->title}}</h4>
</div>
<div class="col border-tr p-0">

        @php
        $total_stock=0;
        foreach ($product->stock as $stock){
        echo $stock->quantity.'--'.$stock->price.'<br>';

        $total_stock=$stock->quantity+$total_stock;
        }
        @endphp


</div>

<div class="col border-tr p-0">

        <input type="number" name="products[{{$product->id}}][quaantity]" min=1 max={{$total_stock}} style=" width: 100px;">


</div>
<div class="col border-tr p-0">
    <input type="number" name="products[{{$product->id}}][rate]" style=" width: 100px;">
</div>
<div class="col border-tr p-0">
    <input type="number" name="products[{{$product->id}}][discount]" style=" width: 100px;">

</div>
<div class="col border-tr p-0">
    <input type="number" name="products[{{$product->id}}][tax]" style=" width: 100px;">
</div>