@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="card au-card chart-percent-card">
                        <div class="#"><B>USER</B></div>
                        <hr>
                        <div class="card-body">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td>
                                            <label class="au-checkbox">
                                                <input type="checkbox">
                                                <span class="au-checkmark"></span>
                                            </label>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <span class="block-email">{{ $user->email }}</span>
                                        </td>
                                        <td>2018-09-27 02:12</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-primary view-user" data-user-id="{{ $user->id }}"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="user-modal-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="user-modal-label">User Details</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Name:</strong> <span id="user-name"></span></p>
                                            <p><strong>Email:</strong> <span id="user-email"></span></p>
                                            <img src="" alt="Permit" />
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script start -->
<!-- Required dependencies for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function() {
        $('.view-user').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('user-id');
            $.ajax({

                url: '{{ route("admin.getuser", ":id") }}'.replace(':id', userId),
                method: 'GET',
                success: function(response) {
                    var user = response.user;
                    $('#user-modal .modal-body #user-name').text(user.name);
                    $('#user-modal .modal-body #user-email').text(user.email);
                    $('#user-modal').modal('show');
                },
                error: function(xhr) {
                    alert('Error loading user data.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#close-modal').click(function() {
            $('#user-modal').modal('hide');
        });
    });
</script>
@endsection