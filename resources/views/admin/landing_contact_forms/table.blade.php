<div class="table-responsive">
    <table class="table" id="landingContactForms-table">
        <thead>
            <tr>
                <th>Full Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Source</th>
        <th>Note</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($landingContactForms as $landingContactForm)
            <tr>
                <td>{{ $landingContactForm->full_name }}</td>
            <td>{{ $landingContactForm->phone }}</td>
            <td>{{ $landingContactForm->email }}</td>
            <td>{{ $landingContactForm->source }}</td>
            <td>{{ $landingContactForm->note }}</td>
                <td>
                    {!! Form::open(['route' => ['landingContactForms.destroy', $landingContactForm->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('landingContactForms.show', [$landingContactForm->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('landingContactForms.edit', [$landingContactForm->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
