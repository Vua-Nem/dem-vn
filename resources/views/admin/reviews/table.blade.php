<div class="table-responsive">
    <table class="table" id="reviews-table">
        <thead>
        <tr>
            <th>Review Image</th>
            <th>Entity Name</th>
            <th>User Name</th>
            <th>Content</th>
            <th>Status</th>
            <th>Type</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <td>
                    @if(!empty($review->reviewImage))
                    <img width="150px"
                         src="{{route("showImageReview", ["fileName" =>$review->id . "/" . $review->reviewImage->file_name])}}">
                    @endif
                </td>
                <td>{{ $review->getProduct->name}}</td>
                <td>{{ $review->getUser->name}}</td>
                <td>{{ $review->content}}</td>
                <td>{{ $review->status }}</td>
                <td>
                    @if($review->status == 0) {{"Disable"}} @endif
                    @if($review->status == 1) {{"Enable"}} @endif
                </td>
                <td>
                    @if($review->type == 2) {{"Category"}}  @endif
                    @if($review->type == 1) {{"Product "}} @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('reviews.show', [$review->id]) }}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                        <a href="{{ route('reviews.edit', [$review->id]) }}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $reviews->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
