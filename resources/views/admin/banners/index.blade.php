@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Banners</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('banners.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                @include('admin.banners.table')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
		$(document).ready(function() {
			$('.confirm_approval').on('click', function () {
				console.log(1111);
				$(this).next('.inlineEdit').show();
			});
			$(".approval_cancel").on('click', function () {
				$('.inlineEdit').css('display','none');
			});
		});

		function update_status(row_id){
			var status = $("#confirm_"+row_id).val();
			$.ajax({
				url: "/admin/updateStatus",
				type: "POST",
				data: {id:row_id,stat:status, _token: "{{ csrf_token() }}"}
			}).done(function(msg) {
				var dataRs = jQuery.parseJSON(msg);
				if(dataRs.result=='1'){
					if(confirm("Update status success")){
						history.go(0);
						$('.inlineEdit').css('display','none');
					}else{
						history.go(0);
					}

				}else{
					alert('Can not update status');
				}
			});
		}
    </script>
@endsection