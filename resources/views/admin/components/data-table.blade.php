<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title">Basic Table</h4> -->
                <!-- <p class="card-description"> Add class <code>.table</code></p> -->
                <table class="table" id="{{$table_id}}">
                    <thead>
                        <tr>
                            @foreach($thead as $th)
                                <th>{{$th}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
