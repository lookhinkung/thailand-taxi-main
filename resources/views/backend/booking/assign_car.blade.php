<form action="" method="POST">
    @csrf
    <table class="table">
        <tr>
            <th>Car Number</th>
            <th>Action</th>
        </tr>
        @foreach ($car_numbers as $car_number)
            
        
        <tr>
            <td> {{$car_number->car_no}} </td>
            <td>
                <a href=" {{route('assign_car_store',[$booking->id,$car_number->id])}} " class="text-primary">
                    <i class="lni lni-circle-plus"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</form>