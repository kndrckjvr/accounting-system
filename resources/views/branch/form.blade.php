<div class="form-group">
    <label for="branch_name">Name</label>
    <input type="text" name="name" id="name" class="form-control{{ ($errors->has('name')) ? ' is-invalid' : '' }}" value="{{ old('name') ?? $branch->name }}" />
    @if($errors->has('name'))
    <span class="invalid-feedback">
        {{$errors->first('name')}}
    </span>
    @endif
</div>