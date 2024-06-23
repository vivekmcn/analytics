<form action="{{ route('admin.rolepermissions.update') }}" id="rolepermissions" method="post">
    @csrf
    <input type="hidden" name="role_id" value="{{ $id }}" />
    @foreach($permissions as $controller => $controllerpermissions)
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ $controller }}</h3>
      </div>
      <div class="card-body">
        @foreach($controllerpermissions as $permission)
        <div class="form-group">
          <div class="form-check">
            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}" {{ !empty($permission->role_id)?"checked":"" }} />
            <label class="form-check-label">{{ $permission->name }}</label>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endforeach
    <div class="card-footer">
      <button type="submit" class="btn btn-info">Update</button>
      <a class="btn btn-default float-right" href="{{ route('admin.roles') }}">Cancel</a>
    </div>
</form>